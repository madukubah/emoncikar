<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Problem extends Uadmin_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = 'uadmin';
	private $current_page = 'uadmin/problem/';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('services/Problem_services');
		$this->services = new Problem_services;
		$this->load->model(array(
			'problem_model',
		));
	}


	public function add(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['activity_id'] = $this->input->post( 'activity_id' );
			$data['report_date'] = date("Y-m-d", strtotime( $this->input->post( 'report_date' ) ) ) ;
			$data['problem_description'] = $this->input->post( 'problem_description' );
			$data['problem_date'] = date("Y-m-d", strtotime( $this->input->post( 'problem_date' ) ) ) ;
			$data['solution'] = $this->input->post( 'solution' );
			$data['authorities'] = $this->input->post( 'authorities' );
			$data['settlement_date'] = date("Y-m-d", strtotime( $this->input->post( 'settlement_date' ) ) ) ;
			$data['required_support'] = $this->input->post( 'required_support' );

			// echo var_dump( $data );die;

			if( $this->problem_model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->problem_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->problem_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->problem_model->errors() : $this->session->flashdata('message')));
		  if(  validation_errors() || $this->problem_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		  
		}

		redirect( site_url( "uadmin/activity/detail/".$this->input->post( 'activity_id' ) )  );

	}

	public function edit(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['report_date'] = date("Y-m-d", strtotime( $this->input->post( 'report_date' ) ) ) ;
			$data['problem_description'] = $this->input->post( 'problem_description' );
			$data['problem_date'] = date("Y-m-d", strtotime( $this->input->post( 'problem_date' ) ) ) ;
			$data['solution'] = $this->input->post( 'solution' );
			$data['authorities'] = $this->input->post( 'authorities' );
			$data['settlement_date'] = date("Y-m-d", strtotime( $this->input->post( 'settlement_date' ) ) ) ;
			$data['required_support'] = $this->input->post( 'required_support' );

			// echo var_dump( $data );die;

			$data_param['id'] = $this->input->post( 'id' );

			if( $this->problem_model->update( $data, $data_param  ) )
			{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->problem_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->problem_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->problem_model->errors() : $this->session->flashdata('message')));
		  if(  validation_errors() || $this->problem_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		  
		}

		redirect( site_url( "uadmin/activity/detail/".$this->input->post( 'activity_id' ) )  );
	}

	public function delete(  ) {
		if( !($_POST) ) redirect( site_url($this->current_page) );
	  
		$data_param['id'] 	= $this->input->post('id');
		if( $this->problem_model->delete( $data_param ) ){
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->problem_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->problem_model->errors() ) );
		}
		redirect( site_url( "uadmin/activity/detail/".$this->input->post( 'activity_id' ) )  );
		
	}
}
