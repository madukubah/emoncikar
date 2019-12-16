<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends User_Controller {

	public function __construct(){
		parent::__construct();
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
		$this->render( "admin/dashboard/content" );
	}
}