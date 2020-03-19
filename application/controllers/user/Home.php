<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends User_Controller {

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

	}

	public function index()
	{
		$this->data[ "page_title" ] = "Beranda";
		$this->data[ "activity_count" ] = $this->activity_model->record_count();
		$sum_activity = $this->activity_model->sum( 0, NULL )->row();
		$this->data[ "total_budget_plan" ] = $sum_activity->total;
		$this->data[ "total_budget_realization" ] = $sum_activity->real_total;

		##################
		#chart
		##################
		$nomenclature_id = $this->input->get("nomenclature_id", TRUE );
		$code = $this->input->get("code", TRUE );
		$pptk_id = $this->input->get("pptk_id", TRUE );

		$year = $this->input->get("year", TRUE );
		$year || $year = date('Y');

		$sum_activity = $this->activity_model->sum( 0, NULL, NULL, $year )->row();
		$this->data[ "year_budget_plan" ] = $sum_activity->total;
		$this->data[ "year_budget_realization" ] = $sum_activity->real_total;
		$this->data[ "year" ] = $year;

		
		$activity_id = $this->input->get("activity_id", TRUE );
		#activities
		// echo  $nomenclature_id;
		// echo  $pptk_id;
		// echo  $year;
		// die;

		if( $pptk_id == -1 ) $pptk_id = NULL;
		if( $nomenclature_id == -1 ) $nomenclature_id = NULL;
		// if( $year == -1 ) $year = NULL;
		$activities = $this->activity_model->_fetch_data( 0, NULL, $nomenclature_id, $year , $pptk_id )->result();
		$activity_select [ -1 ] = " Semua Kegiatan ";
		$activity_id || $activity_id = -1;
		foreach( $activities as $activity )
		{
			$activity_select[ $activity->id ] = "{$activity->title}" ;
		}
		$activity_form["form_data"] = array(
			"activity_id" => array(
				'type' => 'select_search',
				'label' => "ID",
				'options' => $activity_select,
				'selected' => $activity_id,
			),
		);
		#nomenclatures
		$nomenclatures = $this->nomenclature_model->nomenclatures( )->result();
		$nomenclature_select [ -1 ] = "Semua Nomenklatur";
		foreach( $nomenclatures as $nomenclature )
		{
			$nomenclature_select[ $nomenclature->id ] = "{$nomenclature->name}" ;
		}
		#pptks
		$pptks = $this->pptk_model->pptks(  )->result();
		$pptk_select = array();
		$pptk_select [ -1 ] = "seluruh PPTK";
		foreach( $pptks as $pptk)
		{
			$pptk_select [ $pptk->id ] = $pptk->name;
		}

		$code || $code = "recap";
		$pptk_id || $pptk_id = -1;
		$nomenclature_id || $nomenclature_id = -1;

		$form_filter["form_data"] = array(
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
				"nomenclature_id" => array(
					'type' => 'select_search',
					'label' => "ID",
					'options' => $nomenclature_select,
					'selected' => $nomenclature_id,
				),
				"pptk_id" => array(
						'type' => 'select',
						'label' => "Email",
						'options' => $pptk_select,
						'selected'=> $pptk_id
				),
				"activity_id" => array(
					'type' => 'select_search',
					'label' => "ID",
					'options' => $activity_select,
					'selected' => $activity_id,
				),
				
		);
		$pptk_id = ( $pptk_id != -1 ) ? $pptk_id : NULL;
		$form_filter["form"] = $this->load->view('templates/form/plain_form_horizontal', $form_filter, TRUE);
		$form_filter = $this->load->view('user/activity/sub_package/filter_horizontal', $form_filter, TRUE);


		$months = array('jan' ,'feb' ,'mar' ,'apr' ,'mei' ,'jun' ,'jul' ,'ags' ,'sep' ,'okt' ,'nov' ,'des');

		if( $activity_id == -1 ) $activity_id = NULL;
		if( $nomenclature_id == -1 ) $nomenclature_id = NULL;
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

		// $this->data[ "contents" ] = $form_filter.$chart1."<br>".$chart2;
		$this->data[ "contents" ] 		= $form_filter;//.$activity_form;
		$this->data[ "budget_chart" ] 	= $chart1;
		$this->data[ "physical_chart" ] = $chart2;

		$this->render( "admin/dashboard/content" );
	}
}