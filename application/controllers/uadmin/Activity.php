<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Activity extends Uadmin_Controller {
	private $services = null;
	private $current_page = 'uadmin/activity/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Activity_services');
		$this->services = new Activity_services;
		$this->load->model(array(
			'pptk_model',
			'group_model',
			'activity_model',
			'budget_model',
			'physical_model',
			'nomenclature_model',
			'problem_model'
		));
		$this->data["menu_list_id"] = "activity_index";

	}

	public function upload_photo()
	{
		$image_name = ["0", "25", "50", "75", "100"];
		$name = $image_name[$this->input->post('image_index')];

		$activity_id = $this->input->post('activity_id');
		$activity = $this->activity_model->activity( $activity_id )->row();
		// upload photo		
		$this->load->library('upload'); // Load librari upload
		$config = $this->services->get_photo_upload_config($name);

		$this->upload->initialize($config);
		// echo var_dump( $_FILES['images'] ); return;
		// if( $_FILES['image']['name'] != "" )
		if ($this->upload->do_upload("image")) {
			$image		 	= $this->upload->data()["file_name"];

			if ($this->input->post('old_image') != "default.jpg")
				if (!@unlink($config['upload_path'] . $this->input->post('old_image'))) { };

			$images = explode(";", $activity->images);

			$images[$this->input->post('image_index')] = $image;
			$data['images'] 	= implode(";", $images);
		} else {
			// $data['image'] = "default.png";
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->upload->display_errors()));
			redirect(site_url($this->current_page) . "detail/" . $activity->id);
		}

		$data_param["id"] = $this->input->post('activity_id');
		// echo var_dump( $data ); return ;
		if ($this->activity_model->update($data, $data_param)) {
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->activity_model->messages()));
		} else {
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->activity_model->errors()));
		}

		redirect(site_url($this->current_page) . "detail/" . $activity->id);
		// redirect(site_url( "officer/civilization/detail/") . $activity->civilization_id );
	}

	public function index()
	{
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) -  1 ) : 0;
        //pagination parameter
        $pagination['base_url'] = base_url( $this->current_page ) .'/index';
        $pagination['total_records'] = $this->group_model->record_count() ;
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page*$pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0 ) $this->data['pagination_links'] = $this->setPagination($pagination);
		#################################################################3
		$this->load->library('services/Nomenclature_services');
		$this->services = new Nomenclature_services;

		// $table = $this->services->get_table_config( $this->current_page );
		$table = $this->services->nomenclature_table_config( $this->current_page );
		$table[ "rows" ] = $this->nomenclature_model->nomenclatures( $pagination['start_record'], $pagination['limit_per_page'] )->result();
		// $table = $this->load->view('user/activity/data_table', $table, true);
		$table = $this->load->view('templates/tables/plain_table', $table, true);


		#################################################################3
		$year = $this->input->get("year", TRUE );
		$year || $year = date('Y');
		$form_filter["form_data"] = array(
				"year" => array(
						'type' => 'select',
						'label' => "Email",
						'options' => array(
							2019 => "2019",
							2020 => "2020",
							2021 => "2021",
							2022 => "2022",
						),
						'selected' => $year
				),
		);
		$form_filter["form"] = $this->load->view('templates/form/plain_form_horizontal', $form_filter, TRUE);
		$form_filter = $this->load->view('user/activity/sub_package/filter_horizontal', $form_filter, TRUE);
		
		// $this->data[ "contents" ] = $form_filter.$table;
		$this->data[ "contents" ] = $table;
		// return;
		
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "";
		// $this->data["header"] = "Data Per Satuan Kerja Tahun Anggaran 2019";
		$this->data["header"] = "Data Kegiatan";
		$this->data["sub_header"] = '';
		$this->render( "templates/contents/plain_content" );
	}

	public function nomenclature( $nomenclature_id = NULL )
	{
		$code = $this->input->get("code", TRUE );
		$pptk_id = $this->input->get("pptk_id", TRUE );
		$year = $this->input->get("year", TRUE );
		

		$code || $code = "recap";
		$pptk_id || $pptk_id = -1;
		$year || $year = date('Y');
		if( !isset( $nomenclature_id ) )  redirect(site_url(  $this->current_page ));  

		$nomenclature = $this->nomenclature_model->nomenclature( $nomenclature_id )->row();
		#################################################################3
		# filter with activity id
		#################################################################3
		$activity_id = $this->input->get("activity_id", TRUE );
		if( $activity_id != NULL )
		{
			$activity = $this->activity_model->activity( $activity_id )->row();
			if ($activity == NULL) redirect(site_url($this->current_page));

			$year = $activity->year;
		}
		#################################################################3
		$pptks = $this->pptk_model->pptks(  )->result();
		$pptk_select = array();
		$pptk_select [ -1 ] = "seluruh";
		foreach( $pptks as $pptk)
		{
			$pptk_select [ $pptk->id ] = $pptk->name;
		}
		$form_filter["form_data"] = array(
				"code" => array(
						'type' => 'hidden',
						'label' => "Email",
						'value' => $code
				),
				"year" => array(
					'type' => 'select',
					'label' => "Tahun Anggaran",
					'options' => array(
						  	2019 => "2019",
							2020 => "2020",
							2021 => "2021",
							2022 => "2022",
					),
					'selected' => $year ,
				  ),
				"pptk_id" => array(
						'type' => 'select',
						'label' => "Email",
						'options' => $pptk_select,
						'selected'=> $pptk_id
				),
		);
		$pptk_id = ( $pptk_id != -1 ) ? $pptk_id : NULL;
		$form_filter["form"] = $this->load->view('templates/form/plain_form_horizontal', $form_filter, TRUE);
		$form_filter = $this->load->view('user/activity/sub_package/filter_horizontal', $form_filter, TRUE);

		switch( $code )
		{
			case "recap" :
				// die;
				// $this->session->set_flashdata('last_url', site_url('uadmin/activity/nomenclature/').$nomenclature_id  );

				$table = $this->services->get_sub_package_table_config( $this->current_page );
				$table[ "rows" ] = $this->activity_model->activities( 0, NULL, $nomenclature_id, $year , $pptk_id )->result();
				$sum = $this->activity_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id )->row();
				$sum->code = '';
				$sum->title = 'Total';
				$sum->location = '';
				$sum->unit = '';
				$sum->AuFnF = '';
				$sum->AUpLkS = '';
				if( $sum->total != 0 )
					$sum->financial_progress = ( $sum->real_total ) / $sum->total * 100;

				$sum = $this->services->get_sub_package_bold( $sum );
				$table[ "rows" ] []= $sum;
				$table = $this->load->view('user/activity/sub_package/sub_package_table', $table, true);
				$this->data[ "form_filter" ] = $form_filter;
				$this->data[ "contents" ] = $form_filter.$table;

			break;
			case "contractual" :
				$this->data[ "contents" ] = "";
			break;
			case "spse_package" :
				$this->data[ "contents" ] = "";
			break;
			case "chart" :
				
				$months = array('jan' ,'feb' ,'mar' ,'apr' ,'mei' ,'jun' ,'jul' ,'ags' ,'sep' ,'okt' ,'nov' ,'des');
				###############################################
				# BUDGET
				###############################################
				$sum_budget = $this->budget_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id, $status = 0, $rpm_pln = NULL, $activity_id )->row();
				$budget_plan_table = $this->budget_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id, $status = 0, $rpm_pln = NULL, $activity_id  )->row();
				#NORMALIZATION
				$sum_budget = $this->services->get_physical_prefix_sum( $sum_budget );
				$budget_plan_arr = array();
				$plan_table = array();
				foreach( $months as $month )
				{
					$budget_plan_arr []=  $sum_budget->$month ;
					$plan_table []=  $budget_plan_table->$month ;
				}
				#######
				$realization_sum_budget = $this->budget_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id, $status = 1, $rpm_pln = NULL, $activity_id  )->row();
				$realization_sum_budget_table = $this->budget_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id, $status = 1, $rpm_pln = NULL, $activity_id  )->row();

				#NORMALIZATION
				$realization_sum_budget = $this->services->get_physical_prefix_sum( $realization_sum_budget );
				$budget_realization_arr = array();
				$realization_table = array();
				foreach( $months as $month )
				{
					$budget_realization_arr []=  $realization_sum_budget->$month ;
					$realization_table []=  $realization_sum_budget_table->$month ;
				}
				for( $i=0; $i < count( $months ); $i++ )
				{
					if( $sum_budget->total != 0 )
					{
						$budget_plan_arr[ $i ] = $budget_plan_arr[ $i ] / $sum_budget->total * 100 ;
				  		$budget_realization_arr[ $i ] = $budget_realization_arr[ $i ] / $sum_budget->total * 100 ;
					}
				}
				#NORMALIZATION
				$chart1 = array(
					'chart_id'=>"chart1",
					'title'=>"Keuangan",
					'data_sets' => array(
						(object) array(
							'title' => 'Renc. eMon',
							'color' => '"rgba(235,22,22,0.8)"', //merah
							'values'=> $budget_plan_arr,
							'table'=> $plan_table,
						),
						(object) array(
							'title' => 'Real. Keu',
							'color' => '"rgba(65, 193, 65, 1)"', //Hijau
							'values'=> $budget_realization_arr ,
							'table'=> $realization_table ,
						),

					),
				);
				$chart1 = $this->load->view('user/activity/sub_package/line', $chart1, true);
				###############################################
				# PHYSICAL
				###############################################
				$sum_physical = $this->physical_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id, $status = 0, $activity_id )->row();
				$sum_physical_table = $this->physical_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id, $status = 0, $activity_id  )->row();
				$sum_physical = $this->services->get_physical_prefix_sum( $sum_physical );
				$physical_plan_arr = array();
				$physical_plan_table_arr = array();
				foreach( $months as $month )
				{
					$physical_plan_arr []= $sum_physical->$month ;
					$physical_plan_table_arr []= $sum_physical_table->$month ;
				}
				#realization
				$realization_sum_physical = $this->physical_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id,  $status = 1, $activity_id )->row();
				$realization_sum_physical_table = $this->physical_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id,  $status = 1, $activity_id )->row();
				$realization_sum_physical = $this->services->get_physical_prefix_sum( $realization_sum_physical );
				$physical_realization_arr = array();
				$physical_realization_table_arr = array();
				foreach( $months as $month )
				{
					$physical_realization_arr []= $realization_sum_physical->$month ;
					$physical_realization_table_arr []= $realization_sum_physical_table->$month ;
				}
				$chart2 = array(
					'chart_id'=>"chart2",
					'title'=>"Fisik",
					'data_sets' => array(
						(object) array(
							'title' => 'Renc. eMon',
							'color' => '"rgba(235,22,22,0.8)"', //merah
							'values'=> $physical_plan_arr,
							'table'=> $physical_plan_table_arr,

						),
						(object) array(
							'title' => 'Real. Fis',
							'color' => '"rgba(65, 193, 65, 1)"', //Hijau
							'values'=> $physical_realization_arr ,
							'table'=> $physical_realization_table_arr,
						),
					),
				);
				$chart2 = $this->load->view('user/activity/sub_package/line', $chart2, true);

				$activities = $this->activity_model->_fetch_data( 0, NULL, $nomenclature_id, $year , $pptk_id )->result();
				$activity_select [ -1 ] = " Semua Kegiatan  ";
				$activity_id || $activity_id = -1;
				foreach( $activities as $activity )
				{
					$activity_select[ $activity->id ] = "{$activity->title}" ;
				}
				$activity_form["form_data"] = array(
					"code" => array(
						'type' => 'hidden',
						'label' => "Email",
						'value' => $code
					),
					"activity_id" => array(
					  'type' => 'select_search',
					  'label' => "ID",
					  'options' => $activity_select,
					  'selected' => $activity_id,
					),
					
				);
				$activity_form["form"] = $this->load->view('templates/form/plain_form_horizontal', $activity_form, TRUE);
				$activity_form = $this->load->view('user/activity/sub_package/filter_horizontal', $activity_form, TRUE);

				// $activity_form = $this->load->view('templates/form/plain_form', $activity_form , TRUE ) ;
				// echo var_dump( $activity_form ); die;

				// $this->data[ "contents" ] = $form_filter.$chart1."<br>".$chart2;
				$this->data[ "contents" ] = $form_filter.$activity_form.$chart1."<br>".$chart2;
			break;
			case "planning" :
				$table = $this->services->get_planning_table_config( $this->current_page );
				$table[ "rows" ] =  $this->budget_model->planning_budgets( 0, NULL, $nomenclature_id, $year , $pptk_id )->result();
				$table[ "month_header" ] = "Rencana Keuangan (Rp Ribu)";
				$sum = $this->budget_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id )->row();
				$sum->code = '';
				$sum->title = 'Total';
				$sum->AuFnF = '';
				$sum->AUpLkS = '';
				$sum = $this->services->get_planning_bold( $sum );
				$table[ "rows" ] []= $sum;
				$table = $this->load->view('user/activity/sub_package/planning_table', $table, true);
				$this->data[ "contents" ] = $form_filter."<br><h4>Keuangan</h4>".$table;

				$table = $this->services->get_planning_table_config( $this->current_page );
				$table[ "rows" ] =  $this->physical_model->planning_physicals( 0, NULL, $nomenclature_id, $year , $pptk_id )->result();
				$table[ "month_header" ] = "Rencana Fisik";
				$sum = $this->physical_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id )->row();
				$sum->code = '';
				$sum->title = 'Progress';
				$sum->AuFnF = '';
				$sum->AUpLkS = '';
				foreach( $table[ "rows" ] as $row )
				{
					$row = $this->services->get_physical_prefix_sum( $row );	
				}
				$sum = $this->services->get_physical_prefix_sum( $sum );
				$sum = $this->services->get_planning_bold( $sum );
				$table[ "rows" ] []= $sum;
				$table = $this->load->view('user/activity/sub_package/planning_table', $table, true);
				$this->data[ "contents" ] .= "<br><h4>Fisik</h4>".$table;

			break;
			case "realization" :
				$table = $this->services->get_planning_table_config( $this->current_page );
				$table[ "rows" ] =  $this->budget_model->realization_budgets( 0, NULL, $nomenclature_id, $year , $pptk_id )->result();
				$table[ "month_header" ] = "Rencana Keuangan (Rp Ribu)";
				$sum = $this->budget_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id, $status = 1 )->row();
				$sum->code = '';
				$sum->title = 'Total';
				$sum->AuFnF = '';
				$sum->AUpLkS = '';
				$sum = $this->services->get_planning_bold( $sum );
				$table[ "rows" ] []= $sum;
				$table = $this->load->view('user/activity/sub_package/planning_table', $table, true);
				$this->data[ "contents" ] = $form_filter."<br><h4>Keuangan</h4>".$table;

				$table = $this->services->get_planning_table_config( $this->current_page );
				$table[ "rows" ] =  $this->physical_model->realization_physicals( 0, NULL, $nomenclature_id, $year , $pptk_id )->result();
				$table[ "month_header" ] = "Rencana Fisik";
				$sum = $this->physical_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id, $status = 1 )->row();
				$sum->code = '';
				$sum->title = 'Progress';
				$sum->AuFnF = '';
				$sum->AUpLkS = '';
				foreach( $table[ "rows" ] as $row )
				{
					$row = $this->services->get_physical_prefix_sum( $row );	
				}
				$sum = $this->services->get_physical_prefix_sum( $sum );
				$sum = $this->services->get_planning_bold( $sum );
				$table[ "rows" ] []= $sum;
				$table = $this->load->view('user/activity/sub_package/planning_table', $table, true);
				$this->data[ "contents" ] .= "<br><h4>Fisik</h4>".$table;
				
			break;
			case "galleries" :
				$table = $this->services->get_photo_table_config( $this->current_page );
				$table[ "rows" ] = $this->activity_model->_fetch_data( 0, NULL, $nomenclature_id, $year , $pptk_id )->result();
				$table["image_url"] =  base_url("uploads/progress/");
				$table = $this->load->view('user/activity/sub_package/photo_table', $table, true);
				$this->data[ "contents" ] = $form_filter.$table;
			break;
			case "problem" :
				$this->load->library('services/Problem_services');
				$this->services = new Problem_services;

				$table = $this->services->get_problem_table_config_view( $this->current_page );
				$table[ "rows" ] = $this->problem_model->problems( 0, NULL, $nomenclature_id, $year , $pptk_id )->result();
				$table = $this->load->view('templates/tables/plain_table_12', $table, true);
				$this->data[ "contents" ] = $form_filter.$table;
			break;
			default:
				$this->data[ "contents" ] = "";
		}
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["code"] = $code;
		// $this->data["activity_id"] = $nomenclature_id;
		$this->data["tab_url"] = site_url(  ).'/uadmin/activity/nomenclature/'.$nomenclature_id;
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Pelaksanaan Anggaran Per Paket Pekerjaan TA ".$year." <br> ".strtoupper( $nomenclature->name ) ;
		$this->data["header"] = "Data Per Satuan Kerja";
		$this->data["sub_header"] = '';
		$this->render( "user/activity/sub_package/content" );
	}

	public function add(  )
	{
		$this->data["menu_list_id"] = "activity_add";

        $this->form_validation->set_rules( $this->services->get_validation_config() );
        if ($this->form_validation->run() === TRUE  )
        {
			$data['title'] 				= $this->input->post( 'title' );
			$data['nomenclature_id'] 	= $this->input->post( 'nomenclature_id' );
			$data['AuFnF'] 				= $this->input->post( 'AuFnF' );
			$data['quantity'] 			= $this->input->post( 'quantity' );
			$data['unit'] 				= $this->input->post( 'unit' );
			$data['year'] 				= $this->input->post( 'year' );
			$data['ceiling_budget'] 	= $this->input->post( 'ceiling_budget' );
			$data['ceiling_rpm'] 		= $data['ceiling_budget'] ;// $this->input->post( 'ceiling_rpm' );
			$data['ceiling_pln'] 		= 0; //$this->input->post( 'ceiling_pln' );
			$data['location'] 			= $this->input->post( 'location' );
			$data['pptk_id'] 			= $this->input->post( 'pptk_id' );
			$data['latitude'] 			= $this->input->post( 'latitude' );
			$data['longitude'] 			= $this->input->post( 'longitude' );
			$data['images'] 			= "default.jpg;default.jpg;default.jpg;default.jpg;default.jpg";
			$data['no_contract'] 		= $this->input->post( 'no_contract' );
			$data['company_name'] 		= $this->input->post( 'company_name' );
			$data['no_news'] 			= $this->input->post( 'no_news' );
			$data['duration'] 			= $this->input->post( 'duration' );
			$data['status'] 			= $this->input->post( 'status' );
			$data['date'] 				= date("Y-m-d", strtotime( $this->input->post( 'date' ) ));
			$data['pagu_'] 				= $this->input->post( 'pagu_' );
			
			// var_dump($data);die;
			if(  $activity_id = $this->activity_model->create( $data ) )
			{
				$budget_arr = array();
				$sum = 0;
				$budget_arr []= array(
					'activity_id' => $activity_id,
					'nominal' => 0,
					'month' =>  1,
					'year' => $data['year'] ,
					'rpm_pln' => 0 , // 0 = rpm ; 1 = pln 
					'status' => 0 , // 0 = planning ; 1 = realization
				);
				
				foreach( $this->input->post( 'budget[]' ) as $index => $budget )
				{
					if( ! ( $budget == '0' || $budget == '' ) )
					{
						$sum += $budget;
						$budget_arr []= array(
							'activity_id' => $activity_id,
							'nominal' => $budget,
							'month' => $index + 1,
							'year' => $data['year'] ,
							'rpm_pln' => 0 , // 0 = rpm ; 1 = pln 
							'status' => 0 , // 0 = planning ; 1 = realization
						);
					}
				}

				if( $sum != $data['ceiling_budget'] )
				{
					$data_param['id'] 	= $activity_id ;
					$this->activity_model->delete( $data_param );

					$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, 'rencana anggaran tidak sesuai pagu !' ) );
					redirect( site_url( $this->current_page ). 'add/'  );
					return;
				}

				###############################################################
				$physical_arr = array();
				$sum = 0;
				foreach( $this->input->post( 'physical[]' ) as $index => $physical )
				{
					if( ! ( $physical == '0' || $physical == '' ) )
					{
						$sum += $physical;
						$physical_arr []= array(
							'activity_id' => $activity_id,
							'progress' => $physical,
							'month' => $index + 1,
							'year' => $data['year'] ,
							'status' => 0 , // 0 = planning ; 1 = realization
						);
					}	
				}

				if(  $this->physical_model->create_batch( $physical_arr ) &&  $this->budget_model->create_batch( $budget_arr )  )
				{
					$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->activity_model->messages() ) );
					redirect( site_url( $this->current_page ). 'add/'  );
					return;
				}else{
					$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, 'Gagal' ) );
					redirect( site_url( $this->current_page ). 'add/'  );
					return;
				}

				
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->activity_model->errors() ) );
			}
			redirect( site_url( $this->current_page ). 'add/'  );
        }
        else
        {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            if(  !empty( validation_errors() ) || $this->ion_auth->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );

            $form_data = $this->services->get_form_data()[0];
			$form_data = $this->load->view('templates/form/plain_form', $form_data , TRUE ) ;
			
			$form_data_1 = $this->services->get_form_data()[1];
			$form_data_1 = $this->load->view('templates/form/plain_form_6', $form_data_1 , TRUE ) ;
			
			$form_data_3 = $this->services->get_form_data()[3];
            $form_data_3 = $this->load->view('templates/form/plain_form_6', $form_data_3 , TRUE ) ;

			$form_data_4 = $this->services->get_form_data()[4];
			$form_data_4 = $this->load->view('templates/form/plain_form', $form_data_4 , TRUE ) ;

			$this->data[ "contents" ] =  $form_data.$form_data_1.$form_data_3.$form_data_4;
			// $this->data[ "contents" ] .=  $form_data_3.$form_data_1;
			
			$table = $this->services->get_planning_table_config( $this->current_page );
			$table[ "rows" ] =  array();//$this->services->planning_data_test() ;//$this->group_model->groups( $pagination['start_record'], $pagination['limit_per_page'] )->result();
			$table = $this->load->view('user/activity/sub_package/budget_planning_input', $table, true);
			$this->data[ "planning" ] = $table;

			$table = $this->services->get_planning_table_config( $this->current_page );
			$table[ "rows" ] =  array();//$this->services->planning_data_test() ;//$this->group_model->groups( $pagination['start_record'], $pagination['limit_per_page'] )->result();
			$table = $this->load->view('user/activity/sub_package/physical_planning_input', $table, true);
			$this->data[ "physical" ] = '';//$table;

			$alert = $this->session->flashdata('alert');
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "";
			$this->data["header"] = "Tambah Kegiatan";
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
			$this->render( "user/activity/content_form" );
        }
	}

	public function detail( $activity_id = NULL )
	{
		$activity = $this->activity_model->activity( $activity_id )->row();
		if ($activity == NULL) redirect(site_url($this->current_page));

		$form = $this->services->get_form_data( $activity_id );

		if( ($_POST) ) 
		{
			$data['ceiling_budget'] = $form[0]["form_data"]['ceiling_budget']['value'];
			$data['year'] = $form[0]["form_data"]['year']['selected'];
			// echo var_dump( $data ); die;

			##############################################
			# REALIZATION VALIDATION
			##############################################
			$budget_arr = array();
			$sum = 0;
			foreach( $this->input->post( 'budget[]' ) as $index => $budget )
			{
				if( ! ( $budget == '0' || $budget == '' ) )
				{
					$sum += $budget;
					$budget_arr []= array(
						'activity_id' => $activity_id,
						'nominal' => $budget,
						'month' => $index + 1,
						'year' => $data['year'] ,
						'rpm_pln' => 0 , // 0 = rpm ; 1 = pln 
						'status' => 1 , // 0 = planning ; 1 = realization
					);
				}
			}

			###############################################################
			$physical_arr = array();
			$physical_sum = 0;
			foreach( $this->input->post( 'physical[]' ) as $index => $physical )
			{
				if( ! ( $physical == '0' || $physical == '' ) )
				{
					$physical_sum += $physical;
					$physical_arr []= array(
						'activity_id' => $activity_id,
						'progress' => $physical,
						'month' => $index + 1,
						'year' => $data['year'] ,
						'status' => 1 , // 0 = planning ; 1 = realization
					);
				}	
			}
		
			$realization_data_param["activity_id"] = $activity_id;
			$realization_data_param["status"] = 1;// 0 = planning ; 1 = realization
			$this->physical_model->delete( $realization_data_param );
			$this->budget_model->delete( $realization_data_param );

			if(  $this->physical_model->create_batch( $physical_arr ) &&  $this->budget_model->create_batch( $budget_arr )  )
			{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, 'berhasil' ) );
				redirect( site_url( $this->current_page ). 'detail/' . $activity_id  );
				return;
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, 'Gagal' ) );
				redirect( site_url( $this->current_page ). 'detail/' . $activity_id  );
				return;
			}
			##############################################
			# REALIZATION VALIDATION
			##############################################
		}
		if( !isset($activity_id) ) redirect(site_url(  $this->current_page ));  
		$this->data[ "url_back" ] = site_url(  $this->current_page )."nomenclature/".$activity->nomenclature_id ;//( $this->session->flashdata('last_url') ) ? $this->session->flashdata('last_url') : site_url( $this->current_page ) ;
		$this->session->set_flashdata('last_url', $this->data[ "url_back" ]  );

		$form_data = $form[0];
		$form_data = $this->load->view('templates/form/plain_form_readonly', $form_data , TRUE ) ;
		
		$form_data_1 = $form[1];
		$form_data_1 = $this->load->view('templates/form/plain_form_readonly_6', $form_data_1 , TRUE ) ;
		
		$form_data_3 = $form[3];
		$form_data_3 = $this->load->view('templates/form/plain_form_readonly_6', $form_data_3 , TRUE ) ;

		$form_data_4 = $this->services->get_form_data()[4];
		$form_data_4 = $this->load->view('templates/form/plain_form_readonly', $form_data_4 , TRUE ) ;

		$this->data[ "contents" ] =  $form_data;
		$this->data[ "contents" ] .=  $form_data_1.$form_data_3.$form_data_4;

		$this->data[ "planning" ] = "";
		$this->data[ "physical" ] = "";

		$table = $this->services->get_month_table_config( $this->current_page );
		$budget_plan = $this->budget_model->budget_by_activity_id( $activity_id,  0, $activity->year )->row();
		// echo var_dump( $this->db );die;
		$budget_plan->title = 'KEUANGAN ( Ribu )';
		
		$physical_plan = $this->physical_model->physical_by_activity_id( $activity_id,  0, $activity->year )->row();
		$physical_plan = $this->services->get_physical_prefix_sum( $physical_plan );
		$physical_plan->title = 'FISIK';

		$table[ "rows" ] =[ $budget_plan, $physical_plan ] ; //$this->services->get_budget_physical_row( $budget_plan, $budget_plan_pln, $physica_plan );
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "planning_table" ] = $table ;
		#REALISASI REALISASI REALISASI REALISASI
		$table = NULL;
		$table = $this->services->get_month_table_config( $this->current_page );
		$budget_realization = $this->budget_model->budget_by_activity_id( $activity_id,  1, $activity->year )->row();
		$budget_realization->title = 'KEUANGAN ( Ribu )';
		$physical_realization = $this->physical_model->physical_by_activity_id( $activity_id,  1, $activity->year )->row();
		$physical_realization = $this->services->get_physical_prefix_sum( $physical_realization );
		$physical_realization->title = 'FISIK';
		
		$table[ "rows" ] = [ $budget_realization, $physical_realization ] ; //$this->services->get_budget_physical_row( $budget_plan_rpm, $budget_plan_pln, $physica_plan );
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "realization_table" ] = $table ;

		####################################################
		$link_add = 
		array(
			"name" => "Edit",
			"type" => "link",
			"url" => site_url( $this->current_page."edit/".$activity_id  ),
			"button_color" => "primary",	
			"data" => NULL,
		);
		$this->data[ "header_button" ] =  $this->load->view('templates/actions/link', $link_add, TRUE ); 
		####################################################
		# EDIT REALIZATION
		####################################################
		$table = $this->services->get_planning_table_config( $this->current_page );
		$table[ "budget" ] = $budget_realization;
		$physical_realization = $this->physical_model->physical_by_activity_id( $activity_id,  1 )->row();
		$table[ "physical" ] = $physical_realization;
		$table = $this->load->view('user/activity/sub_package/budget_planning_input', $table, true);
		$this->data[ "planning" ] = $table;

		####################################################
		# EDIT REALIZATION
		####################################################
		####################################################
		# PHOTO
		####################################################
		$activity = $this->activity_model->activity( $activity_id )->row();
		$this->data["image_url"] =  base_url("uploads/progress/");
		$this->data["activity"] =  $activity;

		$images = explode(";", $activity->images);
		$images_arr = array();
		$image_url = $this->services->get_photo_upload_config("")["image_path"];
		foreach ($images as $i => $image) :
			// echo $image_url; die;
			$edit_photo = array(
				"name" => "Ganti Gambar",
				"modal_id" => "edit_photo_" . $i,
				"button_color" => "primary",
				"url" => site_url($this->current_page . "upload_photo/"),
				"form_data" => array(

					"image" => array(
						'type' => 'file',
						'label' => "Foto",
						'value' => "",
					),
					"name" => array(
						'type' => 'hidden',
						'label' => "name",
						'value' => substr($image, 0, strpos($image, ".")),
					),
					"activity_id" => array(
						'type' => 'hidden',
						'label' => "activity_id",
						'value' => $activity->id,
					),
					"image_index" => array(
						'type' => 'hidden',
						'label' => "image_index",
						'value' => $i,
					),
					"old_image" => array(
						'type' => 'hidden',
						'label' => "old_image",
						'value' => $image,
					),
					'data' => NULL
				),
			);

			$edit_photo_html = $this->load->view('templates/actions/modal_form_multipart', $edit_photo, true);
			$images_arr[] = (object) array(
				"image_url" 		=> $image_url . $image,
				"edit_photo_html" 	=> $edit_photo_html,
			);
		endforeach;
		$this->data["images_arr"] =  $images_arr;
		####################################################
		# PHOTO
		####################################################
		####################################################
		# DELETE
		####################################################
		$modal_add = array(
			"name" => "Hapus",
			"modal_id" => "add_civilization_",
			"button_color" => "danger",
			"url" => site_url($this->current_page . "delete/"),
			"param" => "id",
			"form_data" => array(
				"id" => array(
					'type' => 'hidden',
					'label' => "id",
				  ),
			),
			"title" => "Kegiatan",
        	"data_name" => "title",
			'data' => $activity
		);

		$modal_add = $this->load->view('templates/actions/modal_delete', $modal_add, true);
		$this->data["header_button"] .=  $modal_add;
		####################################################
		# DELETE
		####################################################
		####################################################
		# PROBLEM
		####################################################
		$this->load->library('services/Problem_services');
		$this->services = new Problem_services;

		$modal_add_problem = array(
			"name" => "Tambah",
			"modal_id" => "add_problem_",
			"button_color" => "primary",
			"url" => site_url( "uadmin/problem/add/" ),
			"param" => "id",
			"form_data" => $this->services->get_form_data(  )["form_data"] ,
			"title" => "Kegiatan",
        	"data_name" => "title",
			'data' => NULL
		);

		$modal_add_problem["form_data"][ "activity_id" ]['value'] = $activity_id;
		$modal_add_problem["form_data"][ "report_date" ]['value'] = date( "m/d/Y" ) ;
		$modal_add_problem["form_data"][ "problem_date" ]['value'] = date( "m/d/Y" ) ;
		$modal_add_problem["form_data"][ "settlement_date" ]['value'] = date( "m/d/Y" ) ;

		$modal_add_problem = $this->load->view('templates/actions/modal_form', $modal_add_problem, true);
		$this->data["problem_header"] =  $modal_add_problem;

		$problem_table = $this->services->get_table_config( 'uadmin/problem/' );
		$problem_table[ "rows" ] = $this->problem_model->problems( $start = 0 , $limit = NULL, $nomenclature_id = NULL, $year = NULL, $pptk_id = NULL,  $activity_id  )->result();
		// echo var_dump( $problem_table[ "rows" ] ); die;
		$problem_table = $this->load->view('templates/tables/plain_table_12', $problem_table, true);
		$this->data[ "problem_table" ] = $problem_table;
		####################################################
		# PROBLEM
		####################################################
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "";
		$this->data["header"] = "Detail Kegiatan";
		$this->data["sub_header"] = '';
		$this->render( "user/activity/detail_sub_package" );
	}

	public function edit( $activity_id = NULL )
	{
		if( !isset($activity_id) ) redirect(site_url(  $this->current_page ));  

        $this->form_validation->set_rules( $this->services->get_validation_config() );
        if ($this->form_validation->run() === TRUE  )
        {
			$data['title'] 				= $this->input->post( 'title' );
			// $data['nomenclature_id'] 	= $this->input->post( 'nomenclature_id' );
			$data['AuFnF'] 				= $this->input->post( 'AuFnF' );
			$data['quantity'] 			= $this->input->post( 'quantity' );
			$data['unit'] 				= $this->input->post( 'unit' );
			$data['year'] 				= $this->input->post( 'year' );
			$data['ceiling_budget'] 	= $this->input->post( 'ceiling_budget' );
			$data['ceiling_rpm'] 		= $data['ceiling_budget'] ;// $this->input->post( 'ceiling_rpm' );
			$data['ceiling_pln'] 		= 0; //$this->input->post( 'ceiling_pln' );
			$data['location'] 			= $this->input->post( 'location' );
			// $data['pptk_id'] 			= $this->input->post( 'pptk_id' );
			$data['latitude'] 			= $this->input->post( 'latitude' );
			$data['longitude'] 			= $this->input->post( 'longitude' );
			$data['no_contract'] 		= $this->input->post( 'no_contract' );
			$data['company_name'] 		= $this->input->post( 'company_name' );
			$data['no_news'] 			= $this->input->post( 'no_news' );
			$data['duration'] 			= $this->input->post( 'duration' );
			$data['status'] 			= $this->input->post( 'status' );
			$data['date'] 				= date("Y-m-d", strtotime( $this->input->post( 'date' ) ));
			$data['pagu_'] 				= $this->input->post( 'pagu_' );

			##############################################
			# PLANNING VALIDATION
			##############################################
			$budget_arr = array();
			$sum = 0;
			foreach( $this->input->post( 'budget[]' ) as $index => $budget )
			{
				if( ! ( $budget == '0' || $budget == '' ) )
				{
					$sum += $budget;
					$budget_arr []= array(
						'activity_id' => $activity_id,
						'nominal' => $budget,
						'month' => $index + 1,
						'year' => $data['year'] ,
						'rpm_pln' => 0 , // 0 = rpm ; 1 = pln 
						'status' => 0 , // 0 = planning ; 1 = realization
					);
				}
			}

			###############################################################
			$physical_arr = array();
			$physical_sum = 0;
			foreach( $this->input->post( 'physical[]' ) as $index => $physical )
			{
				if( ! ( $physical == '0' || $physical == '' ) )
				{
					$physical_sum += $physical;
					$physical_arr []= array(
						'activity_id' => $activity_id,
						'progress' => $physical,
						'month' => $index + 1,
						'year' => $data['year'] ,
						'status' => 0 , // 0 = planning ; 1 = realization
					);
				}	
			}

			if( $sum != $data['ceiling_budget'] || $physical_sum != 100 )
			{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, 'rencana anggaran tidak sesuai pagu !' ) );
				redirect( site_url( $this->current_page ). 'edit/'.$this->input->post( 'id' )  );
				return;
			}
			##############################################
			# PLANNING VALIDATION
			##############################################
			$data_param["id"] = $this->input->post( 'id' );
			// echo var_dump( $data_param ); die;

			if(  $this->activity_model->update( $data , $data_param ) )
			{

				$planing_data_param["activity_id"] = $data_param["id"];
				$planing_data_param["status"] = 0;
				$this->physical_model->delete( $planing_data_param );
				$this->budget_model->delete( $planing_data_param );

				if(  $this->physical_model->create_batch( $physical_arr ) &&  $this->budget_model->create_batch( $budget_arr )  )
				{
					$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->activity_model->messages() ) );
					redirect( site_url( $this->current_page ). 'detail/' . $activity_id  );
					return;
				}else{
					$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, 'Gagal' ) );
					redirect( site_url( $this->current_page ). 'detail/' . $activity_id  );
					return;
				}
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->activity_model->errors() ) );
			}
			redirect( site_url( $this->current_page ). 'detail/' . $activity_id  );
        }
        else
        {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            if(  !empty( validation_errors() ) || $this->ion_auth->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
			$activity = $this->activity_model->activity( $activity_id )->row();
            $form = $this->services->get_form_data( $activity_id );

			$form_data = $form[0];
			$form_data["form_data"]['nomenclature_id']['readonly'] = 'readonly';
			$form_data = $this->load->view('templates/form/plain_form', $form_data , TRUE ) ;
			
			$form_data_1 = $form[1];
			
			// $form_data_1["form_data"]['pptk_id']['readonly'] = 'readonly';
			$form_data_1 = $this->load->view('templates/form/plain_form_6', $form_data_1 , TRUE ) ;
			
			$form_data_3 = $form[3];
			$form_data_3 = $this->load->view('templates/form/plain_form_6', $form_data_3 , TRUE ) ;

			$form_data_4 = $this->services->get_form_data()[4];
			$form_data_4 = $this->load->view('templates/form/plain_form', $form_data_4 , TRUE ) ;

			$this->data[ "contents" ] =  $form_data;
			$this->data[ "contents" ] .= $form_data_1.$form_data_3.$form_data_4;
			
			$table = $this->services->get_planning_table_config( $this->current_page );
			$budget_plan = $this->budget_model->budget_by_activity_id( $activity_id,  0, $activity->year )->row();
			$physical_plan = $this->physical_model->physical_by_activity_id( $activity_id,  0, $activity->year )->row();
			$table[ "budget" ] = $budget_plan;
			$table[ "physical" ] = $physical_plan;
			$table = $this->load->view('user/activity/sub_package/budget_planning_input', $table, true);
			$this->data[ "planning" ] = $table;

			$alert = $this->session->flashdata('alert');
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "";
			$this->data["header"] = "Ubah Kegiatan";
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
			$this->render( "user/activity/content_form" );
        }
	}

	public function delete( )
	{
		if (!($_POST)) redirect(site_url($this->current_page));

		$data_param['id'] 	= $this->input->post('id');

		$activity = $this->activity_model->activity( $data_param['id'] )->row();
		if ($activity == NULL) redirect(site_url($this->current_page));

		$planing_data_param["activity_id"] = $data_param["id"];
		$this->physical_model->delete( $planing_data_param );
		$this->budget_model->delete( $planing_data_param );
		$this->problem_model->delete( $planing_data_param );

		if ($this->activity_model->delete($data_param)) {
			$image_url = $this->services->get_photo_upload_config("")["upload_path"];

			$images = explode(";", $activity->images);
			foreach ($images as $i => $image) :
				echo $image_url . $image . " ";
				if ($image != "default.jpg")
					if (!@unlink($image_url . $image)) { };
			endforeach;
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::SUCCESS, $this->activity_model->messages()));
		} else {
			$this->session->set_flashdata('alert', $this->alert->set_alert(Alert::DANGER, $this->activity_model->errors()));
		}
		redirect(site_url($this->current_page));
	}
	public function print_pdf( $activity_id  )
	{
		$this->load->library('pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

		$pdf->SetTitle("Laporan Kegiatan");

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->SetTopMargin(10);
		$pdf->SetLeftMargin(10);
		$pdf->SetRightMargin(10);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('CIPTA KARYA');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->AddPage();
		$pptks = $this->pptk_model->pptks()->result();
		$pptk_select = array();
		foreach( $pptks as $pptk )
		{
			$pptk_select[ $pptk->id ] = $pptk->name;
		}
		$nomenclatures = $this->nomenclature_model->nomenclatures()->result();
		$nomenclatures_select = array();
		foreach( $nomenclatures as $nomenclature )
		{
			$nomenclatures_select[ $nomenclature->id ] = "[{$nomenclature->code}] {$nomenclature->name}" ; ;
		}
		$data["pptk_select"] 			= $pptk_select;
		$data["nomenclatures_select"] 	= $nomenclatures_select;
		$data["image_url"] 				= $this->services->get_photo_upload_config("")["image_path"];
		$data["activity"] 				= $this->activity_model->activity( $activity_id )->row();
		// var_dump( $data["activity"] );die;
		$data[ "problems" ] 			= $this->problem_model->problems( $start = 0 , $limit = NULL, $nomenclature_id = NULL, $year = NULL, $pptk_id = NULL,  $activity_id  )->result();


		$html = $this->load->view('templates/report/activity', $data, true);
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->SetFont('times', NULL, 9);
		// $html = $this->load->view('templates/report/candidates', $this->data, true);
		// $pdf->writeHTML($html, true, false, true, false, '');
		$title = str_replace(" ", "_", "Laporan Kegiatan" );
		//sleep ( 15 );
		ob_end_clean();
		$pdf->Output($title . ".pdf", 'I');
	}
}
