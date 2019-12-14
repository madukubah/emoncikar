<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Activity extends Uadmin_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = 'uadmin';
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
		));
		$this->data["menu_list_id"] = "activity_index";

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
				$sum_budget = $this->budget_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id )->row();
				$budget_plan_table = $this->budget_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id )->row();
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
				$realization_sum_budget = $this->budget_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id, $status = 1 )->row();
				$realization_sum_budget_table = $this->budget_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id, $status = 1 )->row();

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
				$sum_physical = $this->physical_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id )->row();
				$sum_physical_table = $this->physical_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id )->row();
				$sum_physical = $this->services->get_physical_prefix_sum( $sum_physical );
				$physical_plan_arr = array();
				$physical_plan_table_arr = array();
				foreach( $months as $month )
				{
					$physical_plan_arr []= $sum_physical->$month ;
					$physical_plan_table_arr []= $sum_physical_table->$month ;
				}
				#realization
				$realization_sum_physical = $this->physical_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id,  $status = 1 )->row();
				$realization_sum_physical_table = $this->physical_model->sum( 0, NULL, $nomenclature_id, $year , $pptk_id,  $status = 1 )->row();
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
				$this->data[ "contents" ] = $form_filter.$chart1."<br>".$chart2;
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
				$table[ "rows" ] = $this->services->photo_data_test() ;//$this->group_model->groups( $pagination['start_record'], $pagination['limit_per_page'] )->result();
				$table = $this->load->view('user/activity/sub_package/photo_table', $table, true);
				$this->data[ "contents" ] = $form_filter.$table;
			break;
			case "problem" :
				$table = $this->services->get_problem_table_config( $this->current_page );
				$table[ "rows" ] = $this->services->problem_data_test();//$this->group_model->groups( $pagination['start_record'], $pagination['limit_per_page'] )->result();
				$table = $this->load->view('user/activity/sub_package/problem_table', $table, true);
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
		$this->data["tab_url"] = site_url(  ).'uadmin/activity/nomenclature/'.$nomenclature_id;
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
			$data['title'] = $this->input->post( 'title' );
			$data['nomenclature_id'] = $this->input->post( 'nomenclature_id' );
			$data['quantity'] = $this->input->post( 'quantity' );
			$data['unit'] = $this->input->post( 'unit' );
			$data['year'] = $this->input->post( 'year' );
			$data['ceiling_budget'] = $this->input->post( 'ceiling_budget' );
			$data['ceiling_rpm'] = $this->input->post( 'ceiling_rpm' );
			$data['ceiling_pln'] = $this->input->post( 'ceiling_pln' );
			$data['location'] = $this->input->post( 'location' );
			$data['pptk_id'] = $this->input->post( 'pptk_id' );
			
			if(  $activity_id = $this->activity_model->create( $data ) )
			{
				$budget_arr = array();
				$sum = 0;
				foreach( $this->input->post( 'budget_plan_rpm[]' ) as $index => $budget_plan_rpm )
				{
					if( ! ( $budget_plan_rpm == '0' || $budget_plan_rpm == '' ) )
					{
						$sum += $budget_plan_rpm;
						$budget_arr []= array(
							'activity_id' => $activity_id,
							'nominal' => $budget_plan_rpm,
							'month' => $index + 1,
							'year' => $data['year'] ,
							'rpm_pln' => 0 , // 0 = rpm ; 1 = pln 
							'status' => 0 , // 0 = planning ; 1 = realization
						);
					}
					// pln
					$budget_plan_pln = $this->input->post( 'budget_plan_pln[]' )[ $index ];	
					if( ! ( $budget_plan_pln == '0' || $budget_plan_pln == '' ) )
					{
						$sum += $budget_plan_pln;
						// pln
						$budget_arr []= array(
							'activity_id' => $activity_id,
							'nominal' => $budget_plan_pln ,
							'month' => $index + 1,
							'year' => $data['year'] ,
							'rpm_pln' => 1 , // 0 = rpm ; 1 = pln 
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
				foreach( $this->input->post( 'physical_plan[]' ) as $index => $physical_plan )
				{
					if( ! ( $physical_plan == '0' || $physical_plan == '' ) )
					{
						$sum += $physical_plan;
						$physical_arr []= array(
							'activity_id' => $activity_id,
							'progress' => $physical_plan,
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
			
			$form_data_2 = $this->services->get_form_data()[2];
            $form_data_2 = $this->load->view('templates/form/plain_form_6', $form_data_2 , TRUE ) ;

			$this->data[ "contents" ] =  $form_data;
			// $this->data[ "contents" ] .=  '<div class="text-left" > <strong id="ceiling_message" >Sisa : </strong> </div>';
			$this->data[ "contents" ] .=  $form_data_2.$form_data_1;
			
			$table = $this->services->get_planning_table_config( $this->current_page );
			$table[ "rows" ] =  array();//$this->services->planning_data_test() ;//$this->group_model->groups( $pagination['start_record'], $pagination['limit_per_page'] )->result();
			$table = $this->load->view('user/activity/sub_package/budget_planning_input', $table, true);
			$this->data[ "planning" ] = $table;

			$table = $this->services->get_planning_table_config( $this->current_page );
			$table[ "rows" ] =  array();//$this->services->planning_data_test() ;//$this->group_model->groups( $pagination['start_record'], $pagination['limit_per_page'] )->result();
			$table = $this->load->view('user/activity/sub_package/physical_planning_input', $table, true);
			$this->data[ "physical" ] = $table;

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
			foreach( $this->input->post( 'budget_plan_rpm[]' ) as $index => $budget_plan_rpm )
			{
				if( ! ( $budget_plan_rpm == '0' || $budget_plan_rpm == '' ) )
				{
					$sum += $budget_plan_rpm;
					$budget_arr []= array(
						'activity_id' => $activity_id,
						'nominal' => $budget_plan_rpm,
						'month' => $index + 1,
						'year' => $data['year'] ,
						'rpm_pln' => 0 , // 0 = rpm ; 1 = pln 
						'status' => 1 , // 0 = planning ; 1 = realization
					);
				}
				// pln
				$budget_plan_pln = $this->input->post( 'budget_plan_pln[]' )[ $index ];	
				if( ! ( $budget_plan_pln == '0' || $budget_plan_pln == '' ) )
				{
					$sum += $budget_plan_pln;
					// pln
					$budget_arr []= array(
						'activity_id' => $activity_id,
						'nominal' => $budget_plan_pln ,
						'month' => $index + 1,
						'year' => $data['year'] ,
						'rpm_pln' => 1 , // 0 = rpm ; 1 = pln 
						'status' => 1 , // 0 = planning ; 1 = realization
					);
				}
			}

			$physical_arr = array();
			$physical_sum = 0;
			foreach( $this->input->post( 'physical_plan[]' ) as $index => $physical_plan )
			{
				if( ! ( $physical_plan == '0' || $physical_plan == '' ) )
				{
					$physical_sum += $physical_plan;
					$physical_arr []= array(
						'activity_id' => $activity_id,
						'progress' => $physical_plan,
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
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->activity_model->messages() ) );
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

		$form_data = $form[0];
		$form_data = $this->load->view('templates/form/plain_form_readonly', $form_data , TRUE ) ;
		
		$form_data_1 = $form[1];
		$form_data_1 = $this->load->view('templates/form/plain_form_readonly_6', $form_data_1 , TRUE ) ;
		
		$form_data_2 = $form[2];
		$form_data_2 = $this->load->view('templates/form/plain_form_readonly_6', $form_data_2 , TRUE ) ;
		$this->data[ "contents" ] =  $form_data;
		$this->data[ "contents" ] .=  $form_data_2.$form_data_1;

		$this->data[ "planning" ] = "";
		$this->data[ "physical" ] = "";

		$table = $this->services->get_month_table_config( $this->current_page );
		$budget_plan_rpm = $this->budget_model->budget_by_activity_id( $activity_id,  0, 0 )->row();
		$budget_plan_rpm->title = 'RPM ( Ribu )';
		$budget_plan_pln = $this->budget_model->budget_by_activity_id( $activity_id,  0, 1 )->row();
		$budget_plan_pln->title = 'PLN ( Ribu )';
		$physical_plan = $this->physical_model->physical_by_activity_id( $activity_id,  0 )->row();
		$physical_plan = $this->services->get_physical_prefix_sum( $physical_plan );
		$physical_plan->title = 'Fisik';

		$table[ "rows" ] =[ $budget_plan_rpm, $budget_plan_pln, $physical_plan ] ; //$this->services->get_budget_physical_row( $budget_plan_rpm, $budget_plan_pln, $physica_plan );
		$table = $this->load->view('templates/tables/plain_table', $table, true);
		$this->data[ "planning_table" ] = $table ;
		#REALISASI REALISASI REALISASI REALISASI
		$table = NULL;
		$table = $this->services->get_month_table_config( $this->current_page );
		$budget_realization_rpm = $this->budget_model->budget_by_activity_id( $activity_id,  1, 0 )->row();
		$budget_realization_rpm->title = 'RPM ( Ribu )';
		$budget_realization_pln = $this->budget_model->budget_by_activity_id( $activity_id,  1, 1 )->row();
		$budget_realization_pln->title = 'PLN ( Ribu )';
		$physical_realization = $this->physical_model->physical_by_activity_id( $activity_id,  1 )->row();
		$physical_realization = $this->services->get_physical_prefix_sum( $physical_realization );
		$physical_realization->title = 'Fisik';
		
		$table[ "rows" ] = [ $budget_realization_rpm, $budget_realization_pln, $physical_realization ] ; //$this->services->get_budget_physical_row( $budget_plan_rpm, $budget_plan_pln, $physica_plan );
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
		$table[ "budget_plan_rpm" ] = $budget_realization_rpm;
		$table[ "budget_plan_pln" ] = $budget_realization_pln;
		$table[ "rows" ] =  array();//$this->services->planning_data_test() ;//$this->group_model->groups( $pagination['start_record'], $pagination['limit_per_page'] )->result();
		$table = $this->load->view('user/activity/sub_package/budget_planning_input', $table, true);
		$this->data[ "planning" ] = $table;

		$table = $this->services->get_planning_table_config( $this->current_page );
		$physical_realization = $this->physical_model->physical_by_activity_id( $activity_id,  1 )->row();
		$table[ "physical_plan" ] = $physical_realization;
		$table = $this->load->view('user/activity/sub_package/physical_planning_input', $table, true);
		$this->data[ "physical" ] = $table;
		####################################################
		# EDIT REALIZATION
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
			$data['title'] = $this->input->post( 'title' );
			$data['nomenclature_id'] = $this->input->post( 'nomenclature_id' );
			$data['quantity'] = $this->input->post( 'quantity' );
			$data['unit'] = $this->input->post( 'unit' );
			$data['year'] = $this->input->post( 'year' );
			$data['ceiling_budget'] = $this->input->post( 'ceiling_budget' );
			$data['ceiling_rpm'] = $this->input->post( 'ceiling_rpm' );
			$data['ceiling_pln'] = $this->input->post( 'ceiling_pln' );
			$data['location'] = $this->input->post( 'location' );
			$data['pptk_id'] = $this->input->post( 'pptk_id' );
			##############################################
			# PLANNING VALIDATION
			##############################################
			$budget_arr = array();
			$sum = 0;
			foreach( $this->input->post( 'budget_plan_rpm[]' ) as $index => $budget_plan_rpm )
			{
				if( ! ( $budget_plan_rpm == '0' || $budget_plan_rpm == '' ) )
				{
					$sum += $budget_plan_rpm;
					$budget_arr []= array(
						'activity_id' => $activity_id,
						'nominal' => $budget_plan_rpm,
						'month' => $index + 1,
						'year' => $data['year'] ,
						'rpm_pln' => 0 , // 0 = rpm ; 1 = pln 
						'status' => 0 , // 0 = planning ; 1 = realization
					);
				}
				// pln
				$budget_plan_pln = $this->input->post( 'budget_plan_pln[]' )[ $index ];	
				if( ! ( $budget_plan_pln == '0' || $budget_plan_pln == '' ) )
				{
					$sum += $budget_plan_pln;
					// pln
					$budget_arr []= array(
						'activity_id' => $activity_id,
						'nominal' => $budget_plan_pln ,
						'month' => $index + 1,
						'year' => $data['year'] ,
						'rpm_pln' => 1 , // 0 = rpm ; 1 = pln 
						'status' => 0 , // 0 = planning ; 1 = realization
					);
				}
			}

			$physical_arr = array();
			$physical_sum = 0;
			foreach( $this->input->post( 'physical_plan[]' ) as $index => $physical_plan )
			{
				if( ! ( $physical_plan == '0' || $physical_plan == '' ) )
				{
					$physical_sum += $physical_plan;
					$physical_arr []= array(
						'activity_id' => $activity_id,
						'progress' => $physical_plan,
						'month' => $index + 1,
						'year' => $data['year'] ,
						'status' => 0 , // 0 = planning ; 1 = realization
					);
				}	
			}
			if( $sum != $data['ceiling_budget'] || $physical_sum != 100 )
			{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, 'rencana anggaran tidak sesuai pagu !' ) );
				redirect( site_url( $this->current_page ). 'add/'  );
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

            $form = $this->services->get_form_data( $activity_id );

			$form_data = $form[0];
			$form_data = $this->load->view('templates/form/plain_form', $form_data , TRUE ) ;
			
			$form_data_1 = $form[1];
			$form_data_1 = $this->load->view('templates/form/plain_form_6', $form_data_1 , TRUE ) ;
			
			$form_data_2 = $form[2];
			$form_data_2 = $this->load->view('templates/form/plain_form_6', $form_data_2 , TRUE ) ;
			$this->data[ "contents" ] =  $form_data;
			$this->data[ "contents" ] .=  $form_data_2.$form_data_1;
			
			$table = $this->services->get_planning_table_config( $this->current_page );
			$budget_plan_rpm = $this->budget_model->budget_by_activity_id( $activity_id,  0, 0 )->row();
			$budget_plan_pln = $this->budget_model->budget_by_activity_id( $activity_id,  0, 1 )->row();
			$table[ "budget_plan_rpm" ] = $budget_plan_rpm;
			$table[ "budget_plan_pln" ] = $budget_plan_pln;
			$table[ "rows" ] =  array();//$this->services->planning_data_test() ;//$this->group_model->groups( $pagination['start_record'], $pagination['limit_per_page'] )->result();
			$table = $this->load->view('user/activity/sub_package/budget_planning_input', $table, true);
			$this->data[ "planning" ] = $table;

			$table = $this->services->get_planning_table_config( $this->current_page );
			$physical_plan = $this->physical_model->physical_by_activity_id( $activity_id,  0 )->row();
			$table[ "rows" ] =  array();//$this->services->planning_data_test() ;//$this->group_model->groups( $pagination['start_record'], $pagination['limit_per_page'] )->result();
			$table[ "physical_plan" ] = $physical_plan;
			$table = $this->load->view('user/activity/sub_package/physical_planning_input', $table, true);
			$this->data[ "physical" ] = $table;

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

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->group_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->group_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->group_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
}
