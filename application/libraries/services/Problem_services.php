<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Problem_services
{
  function __construct()
  {
  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  
  public function get_table_config( $_page = '', $start_number = 1 )
  {
      $table["header"] = array(
				// 'name' => '	Paket Pekerjaan',
			
				'_report_date' => 'Tanggal',
        'problem_description' => 'Permasalahan',
        
				'_problem_date' => 'Tanggal Masalah',
				'solution' => 'Upaya yang diperlukan',
        'authorities' => 'Instansi/Pejabat yang Berwenang',
        
				'_settlement_date' => 'Waktu Penyelesaian',
        'required_support' => 'Dukungan Atasan yang diperlukan',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
        array(
          "name" => 'Edit',
          "type" => "modal_form",
          "modal_id" => "edit_",
          "url" => site_url( $_page."edit/"),
          "button_color" => "primary",
          "param" => "id",
          "form_data" => $this->get_form_data(  )["form_data"] ,
          "title" => "Group",
          "data_name" => "name",
        ),
        array(
          "name" => 'X',
          "type" => "modal_delete",
          "modal_id" => "delete_",
          "url" => site_url( $_page."delete/"),
          "button_color" => "danger",
          "param" => "id",
          "form_data" => array(
            "id" => array(
              'type' => 'hidden',
              'label' => "id",
            ),
            "activity_id" => array(
              'type' => 'hidden',
              'label' => "ID",
            ),
          ),
          "title" => "Permasalahan",
          "data_name" => "problem_description",
        ),
    );
    return $table;
  }

  public function get_problem_table_config_view( $_page = '', $start_number = 1 )
  {
    $table["header"] = array(
      'activity_title' => '	Paket Pekerjaan',
    
      '_report_date' => 'Tanggal',
      'problem_description' => 'Permasalahan',
      
      '_problem_date' => 'Tanggal Masalah',
      'solution' => 'Upaya yang diperlukan',
      'authorities' => 'Instansi/Pejabat yang Berwenang',
      
      '_settlement_date' => 'Waktu Penyelesaian',
      'required_support' => 'Dukungan Atasan yang diperlukan',
    );
    $table["number"] = $start_number;
    return $table;
  }
  

  public function validation_config( ){
    $config = array(
        array(
          'field' => 'report_date',
          'label' => 'Tanggal',
          'rules' =>  'trim|required',
        ),
        array(
          'field' => 'activity_id',
          'label' => 'activity_id',
          'rules' =>  'trim|required',
        ),
    );
    
    return $config;
  }

  public function get_form_data(  )
	{
      $_data["form_data"] = array(
        "id" => array(
          'type' => 'hidden',
          'label' => "ID",
        ),
        "activity_id" => array(
          'type' => 'hidden',
          'label' => "ID",
        ),
        "report_date" => array(
          'type' => 'date',
          'label' => "Tanggal",
          // 'value' => date( "m/d/Y" ) ,
        ),
        "problem_description" => array(
          'type' => 'textarea',
          'label' => "Permasalahan",
        ),
        "problem_date" => array(
          'type' => 'date',
          'label' => "Tanggal Masalah",
          // 'value' => date( "m/d/Y" ) ,
        ),
        "solution" => array(
          'type' => 'textarea',
          'label' => "Upaya yang diperlukan",
        ),
        "authorities" => array(
          'type' => 'text',
          'label' => "Instansi/Pejabat yang Berwenang	",
        ),
        "settlement_date" => array(
          'type' => 'date',
          'label' => "Waktu Penyelesaian	",
          // 'value' => date( "m/d/Y" ) ,
        ),
        "required_support" => array(
          'type' => 'textarea',
          'label' => "Dukungan Atasan yang diperlukan",
        ),
      
      );

      return $_data;
  }

}
?>
