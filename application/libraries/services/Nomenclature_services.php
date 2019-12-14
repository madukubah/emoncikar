<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Nomenclature_services
{
  function __construct()
  {
  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  public function nomenclature_table_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        '_code' => 'Kode',
        'name' => 'Kegiatan',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
              array(
                "name" => 'Lihat',
                "type" => "link",
                "modal_id" => "edit_",
                "url" => site_url( $_page."nomenclature/"),
                "button_color" => "primary",
                "param" => "id",
                "form_data" => array(
                    "id" => array(
                        'type' => 'hidden',
                        'label' => "id",
                    ),
                ),
              ),
    );
    return $table;
  }
  public function get_table_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        '_code' => 'Kode',
        'name' => 'Nama',
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
                "form_data" => array(
                    "id" => array(
                        'type' => 'hidden',
                        'label' => "id",
                    ),
                    "code" => array(
                        'type' => 'text',
                        'label' => "Kode",
                    ),
                    "name" => array(
                        'type' => 'text',
                        'label' => "Nama",
                    ),
                ),
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
                ),
                "title" => "Group",
                "data_name" => "name",
              ),
    );
    return $table;
  }
  public function validation_config( ){
    $config = array(
        array(
          'field' => 'name',
          'label' => 'name',
          'rules' =>  'trim|required',
        ),
        array(
          'field' => 'code',
          'label' => 'code',
          'rules' =>  'trim|required',
        ),
    );
    
    return $config;
  }
}
?>
