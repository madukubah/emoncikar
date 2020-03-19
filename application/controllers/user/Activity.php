<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Activity extends User_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = 'user';
	private $current_page = 'user/activity/';
	
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
				$this->session->set_flashdata('last_url', site_url('user/activity/nomenclature/').$nomenclature_id  );

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
				$table = $this->load->view('user/activity/sub_package/sub_package_table_user', $table, true);
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
				$activity_select [ -1 ] = " ";
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
			case "budget_planning" :
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
				$this->data[ "contents" ] = $form_filter.$table;
			break;
			case "physical_planning" :
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
				$this->data[ "contents" ] = $form_filter.$table;
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
		$this->data["tab_url"] = site_url(  ).'/user/activity/nomenclature/'.$nomenclature_id;
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Pelaksanaan Anggaran Per Paket Pekerjaan TA ".$year." <br> ".strtoupper( $nomenclature->name ) ;
		$this->data["header"] = "Data Per Satuan Kerja";
		$this->data["sub_header"] = '';
		$this->render( "user/activity/sub_package/content" );
	}

}
