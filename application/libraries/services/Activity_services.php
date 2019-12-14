<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Activity_services
{
	protected $id;
	protected $title;
	protected $nomenclature_id;
	protected $quantity;
	protected $unit;
	protected $year;
	protected $ceiling_budget;
	protected $location;
  protected $pptk_id;
  
  public $months = array( 'jan' ,'feb' ,'mar' ,'apr' ,'mei' ,'jun' ,'jul' ,'ags' ,'sep' ,'okt' ,'nov' ,'des');

  function __construct(){
     $this->id = 0;
     $this->title = "Administrasi Umum Satker PLP";
     $this->nomenclature_id = 3;
     $this->quantity = 4;
     $this->unit = "KAB/KOTA";
     $this->year = date('Y');
     $this->ceiling_budget = 200000;
     $this->ceiling_rpm = 0;
     $this->ceiling_pln = 0;
     $this->location = "KOTA KENDARI";
     $this->pptk_id = 1;
  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  
  public function get_table_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        'code' => 'Kode',
        'name' => 'Nama Satuan Kerja',
        'ceiling' => 'Pagu',
        'account' => 'eMonitoring ( Akun )',
        'packet' => 'Paket (Pengadaan)',
        'sp2d_realization_budget' => 'Realisasi sp2d ribu',
        'sp2d_realization_percent' => 'Realisasi sp2d persen',
        'spm_realization_budget' => 'Realisasi spm ribu',
        'spm_realization_percent' => 'Realisasi spm persen',
        'progress_percent' => 'progress Fisik',
        'updated_date' => 'Tanggal Kirim',
      );
      $table["number"] = $start_number;
    return $table;
  }

  public function get_month_table_config( $_page, $start_number = 1 )
  {
      // $table["header"] = array(
      //   'month' => 'Bulan',
      //   'rpm' => 'RPM ( Ribu )',
      //   'pln' => 'PLN ( Ribu )',
      //   'physical' => 'Fisik',
      // );
      $table["header"] = array(
				'title' => '	',
				
				'jan' => 'jan',
				'feb' => 'feb',
				'mar' => 'mar',
				'apr' => 'apr',
				'mei' => 'mei',
				'jun' => 'jun',
				'jul' => 'jul',
				'ags' => 'ags',
				'sep' => 'sep',
				'okt' => 'okt',
				'nov' => 'nov',
				'des' => 'des',
      );
      $table["number"] = $start_number;
    return $table;
  }

  public function get_sub_package_table_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        'code' => 'Kode',
        'title' => 'Nama Satuan Kerja',

        'location' => 'Lokasi',
        'quantity' => 'Kuantitas Target',
        'unit' => 'Unit Target',
        'AuFnF' => 'AUfNf',
        'AUpLkS' => 'AUpLkS',
        'ceiling_rpm' => 'akun RPM Pagu',
        'ceiling_pln' => 'akun PLN Pagu',
        'total' => 'akun total Pagu',
        // 'ceiling_package' => 'Paket Pagu',
        // 'ceiling_procurement_plan' => 'pencana pengadaan Pagu',

        'real_rpm' => 'akun RPM Realisasi',
        'real_pln' => 'akun PLN Realisasi',
        'real_total' => 'akun total Realisasi',

        'financial_progress' => 'Progress keuangan',
        'physical_progress' => 'Progress Fisik',

        'ceiling_block' => 'Pagu Blokir',
        'description' => 'Keterangan',
      );
      $table["number"] = $start_number;
    return $table;
  }

  public function get_planning_table_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        'code' => '05486618',
				'title' => '	Nama Satuan Kerja',
			
				'AuFnF' => 'AUfNf',
				'AUpLkS' => 'AUpLkS',
				'total' => 'Pagu Akun',
				// 'ceiling_planning' => 'Pagu Rencana',
				
				'jan' => '-',
				'feb' => '-',
				'mar' => '-',
				'apr' => '-',
				'mei' => '-',
				'jun' => '-',
				'jul' => '-',
				'ags' => '-',
				'sep' => '-',
				'okt' => '-',
				'nov' => '-',
				'des' => '-',
      );
      $table["number"] = $start_number;
    return $table;
  }
  public function get_planning_bold( $data )
  {
      $data->code = "<b>".$data->code."</b>";
      $data->title = "<b>".$data->title."</b>";
      $data->AuFnF = "<b>".$data->AuFnF."</b>";
      $data->AUpLkS = "<b>".$data->AUpLkS."</b>";
      $data->total = "<b>".number_format(  $data->total )."</b>";
      $data->jan = "<b>".number_format(  $data->jan )."</b>";
      $data->feb = "<b>".number_format(  $data->feb )."</b>";
      $data->mar = "<b>".number_format(  $data->mar )."</b>";
      $data->apr = "<b>".number_format(  $data->apr )."</b>";
      $data->mei = "<b>".number_format(  $data->mei )."</b>";
      $data->jun = "<b>".number_format(  $data->jun )."</b>";
      $data->jul = "<b>".number_format(  $data->jul )."</b>";
      $data->ags = "<b>".number_format(  $data->ags )."</b>";
      $data->sep = "<b>".number_format(  $data->sep )."</b>";
      $data->okt = "<b>".number_format(  $data->okt )."</b>";
      $data->nov = "<b>".number_format(  $data->nov )."</b>";
      $data->des = "<b>".number_format(  $data->des )."</b>";
      
    
    return $data;
  }

  public function get_physical_prefix_sum( $data )
  {
      // $months = array('jan' ,'feb' ,'mar' ,'apr' ,'mei' ,'jun' ,'jul' ,'ags' ,'sep' ,'okt' ,'nov' ,'des');
      $months = $this->months;
      $sum = 0;
      for( $i=1; $i < count( $months ); $i++ )
      {
        // if( $data->{ $months[ $i ] } == 0 ) continue;
        $a = $sum + $data->{ $months[ $i - 1 ] };
        $data->{ $months[ $i ] } += $a;
      }

    return $data;
  }
  public function get_budget_physical_row( $rpm, $pln, $physical )
  {
      // $months = array('jan' ,'feb' ,'mar' ,'apr' ,'mei' ,'jun' ,'jul' ,'ags' ,'sep' ,'okt' ,'nov' ,'des');
      $months = $this->months;
      $sum = 0;
      $rows = array();

      foreach( $months as $month )
      {
          $rows[]= (object) array(
            'month' => $month,
            'rpm' => $rpm->$month ,
            'pln' => $pln->$month ,
            'physical' => $physical->$month ,
          );
      }

    return $rows;
  }

  public function get_sub_package_bold( $data )
  {
      $data->code = "<b>".$data->code."</b>";
      $data->title = "<b>".$data->title."</b>";
      $data->location = "<b>".$data->location."</b>";
      $data->unit = "<b>".$data->unit."</b>";
      $data->description = "<b>".$data->description."</b>";

      $data->AuFnF = "<b>".$data->AuFnF."</b>";
      $data->AUpLkS = "<b>".$data->AUpLkS."</b>";
      $data->quantity = "<b>".number_format(  $data->quantity )."</b>";
      $data->ceiling_rpm = "<b>".number_format(  $data->ceiling_rpm )."</b>";
      $data->ceiling_pln = "<b>".number_format(  $data->ceiling_pln )."</b>";
      $data->total = "<b>".number_format(  $data->total )."</b>";

      $data->real_rpm = "<b>".number_format(  $data->real_rpm )."</b>";
      $data->real_pln = "<b>".number_format(  $data->real_pln )."</b>";
      $data->real_total = "<b>".number_format(  $data->real_total )."</b>";
      $data->financial_progress = "<b>".number_format(  $data->financial_progress )."</b>";
      $data->physical_progress = "<b>".number_format(  $data->physical_progress )."</b>";
      $data->ceiling_block = "<b>".number_format(  $data->ceiling_block )."</b>";
      
    
    return $data;
  }
  public function get_photo_table_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        'code' => '05486618',
				'name' => '	Nama Satuan Kerja',
			
				'longitude' => 'Longitude',
        'latitude' => 'Latitude',
        
				'zero' => '-',
				'twenty_five' => '-',
				'fifty' => '-',
				'seventy_five' => '-',
        'one_hundred' => '-',
        
				'description' => '-',
      );
      $table["number"] = $start_number;
    return $table;
  }

  public function get_problem_table_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
				'name' => '	Paket Pekerjaan',
			
				'date' => 'Tanggal',
        'problem_description' => 'Permasalahan',
        
				'problem_date' => 'Tanggal Masalah',
				'solution' => 'Upaya yang diperlukan',
				'authorized_official' => 'Instansi/Pejabat yang Berwenang',
				'settlement_time' => 'Waktu Penyelesaian',
        'required_support' => 'Dukungan Atasan yang diperlukan',
      );
      $table["number"] = $start_number;
    return $table;
  }

  public function photo_data_test( )
  {
    $planning_data = array(
			(object) array(
        'id' => '1',
        'code' => '1',
				'name' => '	Rehabilitasi dan Renovasi Sarana Prasarana Sekolah Kab. Bombana dan Kolaka',
			
				'longitude' => '121,5139179',
        'latitude' => '	-005,2131139',
        
				'zero' => '-',
				'twenty_five' => '-',
				'fifty' => '-',
				'seventy_five' => '-',
        'one_hundred' => '-',
        
				'description' => '-',	
			),
    );
    for( $i =0; $i<10; $i++ )
    {
      $planning_data[]= (object) array(
        'id' => '1',
        'code' => '1',
				'name' => '	Rehabilitasi dan Renovasi Sarana Prasarana Sekolah Kab. Bombana dan Kolaka',
			
				'longitude' => '121,5139179',
        'latitude' => '	-005,2131139',
        
				'zero' => '-',
				'twenty_five' => '-',
				'fifty' => '-',
				'seventy_five' => '-',
        'one_hundred' => '-',
        
				'description' => '-',	
			);
    }
    
    return $planning_data;
  }

  public function problem_data_test( )
  {
    $problem_data = array(
			(object) array(
        'id' => '1',
				'name' => '	Peningkatan Kualitas Permukiman Kumuh Kab. Kolaka Kawasan Kolakasih-Sea (NSUP)	',
			
				'date' => '14-06-2019',
        'problem_description' => 'Masih Proses Persiapan Lelang di Balai PBJ Wilayah Sulawesi Tenggara	',
        
				'problem_date' => '14-06-2019',
        'solution' => 'Menunggu pengumuman lelang dari Balai PBJ Wilayah Sulawesi Tenggara untuk melakukan lelang paket tersebut.	',
        
				'authorized_official' => 'Satker Pelaksanaan Prasarana Permukiman Prov. Sultra	',
				'settlement_time' => '25-11-2019',
        'required_support' => 'Menyampaikan Surat Permintaan Segera Melakukan Proses Pelelangan Kepada Balai PBJ Wilayah Sulawesi Tenggara No : Tanggal :',
			),
    );
    for( $i =0; $i<10; $i++ )
    {
      $problem_data[]= (object) array(
        'id' => '1',
				'name' => '	Peningkatan Kualitas Permukiman Kumuh Kab. Kolaka Kawasan Kolakasih-Sea (NSUP)	',
			
				'date' => '14-06-2019',
        'problem_description' => 'Masih Proses Persiapan Lelang di Balai PBJ Wilayah Sulawesi Tenggara	',
        
				'problem_date' => '14-06-2019',
        'solution' => 'Menunggu pengumuman lelang dari Balai PBJ Wilayah Sulawesi Tenggara untuk melakukan lelang paket tersebut.	',
        
				'authorized_official' => 'Satker Pelaksanaan Prasarana Permukiman Prov. Sultra	',
				'settlement_time' => '25-11-2019',
        'required_support' => 'Menyampaikan Surat Permintaan Segera Melakukan Proses Pelelangan Kepada Balai PBJ Wilayah Sulawesi Tenggara No : Tanggal :',
			);
    }
    
    return $problem_data;
  }

  public function get_validation_config( )
  {
    $config = array(
        array(
          'field' => 'title',
          'label' => 'title',
          'rules' =>  'trim|required',
        ),
    );
    
    return $config;
  }

  public function get_form_data( $activity_id = NULL )
	{
      $this->load->model(array(
        'pptk_model',
        'nomenclature_model',
        'activity_model',
      ));

      if( isset(  $activity_id ) )
      {
          $activity = $this->activity_model->activity( $activity_id )->row();
          $this->id               = $activity->id;
          $this->title            = $activity->title;
          $this->nomenclature_id  = $activity->nomenclature_id;
          $this->quantity         = $activity->quantity;
          $this->unit             = $activity->unit;
          $this->year             = $activity->year;
          $this->ceiling_budget   = $activity->ceiling_budget;
          $this->ceiling_rpm      = $activity->ceiling_rpm;
          $this->ceiling_pln      = $activity->ceiling_pln;
          $this->location         = $activity->location;
          $this->pptk_id          = $activity->pptk_id;
      }
      // echo var_dump( $activity ); die;


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
      $_data[0]["form_data"] = array(
        "id" => array(
          'type' => 'hidden',
          'label' => "ID",
          'value' => $this->form_validation->set_value('id', $this->id),
          ),
        "title" => array(
          'type' => 'textarea',
          'label' => "Uraian",
          'value' => $this->form_validation->set_value('title', $this->title),
        ),
        "nomenclature_id" => array(
          'type' => 'select',
          'label' => "Kegiatan",
          'options' => $nomenclatures_select,
          'selected' => $this->form_validation->set_value('nomenclature_id', $this->nomenclature_id ),
        ),
        "quantity" => array(
          'type' => 'text',
          'label' => "Volume/Kuantitas",
          'value' => $this->form_validation->set_value('quantity', $this->quantity),
        ),
        "unit" => array(
          'type' => 'text',
          'label' => "Satuan",
          'value' => $this->form_validation->set_value('unit', $this->unit),
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
          'selected' => $this->form_validation->set_value('year', $this->year ),
        ),
        "ceiling_budget" => array(
          'type' => 'number',
          'label' => "APBD Provinsi ( dalam ribuan Rp 1.000 )",
          'value' => $this->form_validation->set_value('ceiling_budget', $this->ceiling_budget),
        ),
      
      );

      $_data[1]["form_data"] = array(
          "location" => array(
            'type' => 'text',
            'label' => "Lokasi",
            'value' => $this->form_validation->set_value('location', $this->location),
          ),
          "pptk_id" => array(
            'type' => 'select',
            'label' => "PPTK",
            'options' => $pptk_select,
            'selected' => $this->form_validation->set_value('pptk_id', $this->pptk_id ),
          ),
      );

      $_data[2]["form_data"] = array(
        "ceiling_rpm" => array(
          'type' => 'number',
          'label' => "RPM ( dalam ribuan Rp 1.000 )",
          'value' => 0 ,
          'value' => $this->form_validation->set_value('ceiling_rpm', $this->ceiling_rpm),
        ),
        "ceiling_pln" => array(
          'type' => 'number',
          'label' => "PLN ( dalam ribuan Rp 1.000 )",
          'value' => 0 ,
          'value' => $this->form_validation->set_value('ceiling_pln', $this->ceiling_pln),
        ),
    );
      return $_data;
  }
}
?>
