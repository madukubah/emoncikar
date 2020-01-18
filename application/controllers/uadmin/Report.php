<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."/libraries/Excel.php"; 

// Load library phpspreadsheet
require_once( APPPATH . "../excel/vendor/" . DIRECTORY_SEPARATOR . "autoload.php") ;
// require_once( APPPATH . "../excel/vendor/" . DIRECTORY_SEPARATOR . "phpoffice/phpspreadsheet/samples/Header.php") ;
// require __DIR__ . '/../Header.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
		
// End load library phpspreadsheet


class Report extends Uadmin_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = 'uadmin';
	private $current_page = 'uadmin/report/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Group_services');
		$this->services = new Group_services;
		$this->load->model(array(
			'activity_model',
			'nomenclature_model',
		));
		$this->data["menu_list_id"] = "uadmin_report";

	}
	
	public function index()
	{
		$nomenclatures = $this->nomenclature_model->nomenclatures()->result();
		$nomenclatures_select = [0 => 'semua nomenklatur'];
		foreach( $nomenclatures as $nomenclature )
		{
			$nomenclatures_select[ $nomenclature->id ] = "[{$nomenclature->code}] {$nomenclature->name}" ; ;
		}
		$form_field =[
			"nomenclature_id" => array(
				'type' => 'select',
				'label' => "Nomenklatur",
				'options' => $nomenclatures_select,
			),
			"year" => array(
				'type' => 'select',
				'label' => "Tahun Anggaran",
				'options' => array(
					0 => "seluruh",
					2019 => "2019",
					2020 => "2020",
					2021 => "2021",
					2022 => "2022",
				),
			),
		];
		$form = form_open( site_url( $this->current_page."generate_excel/") );
		$form .= $this->load->view('templates/form/plain_form_6', [ 'form_data'=> $form_field ] , TRUE ) ;
		$form .= 	'<button class="float-right btn btn-bold btn-success btn-md " style="margin-left: 5px;" type="submit">
						Generate Laporan
					</button>';
		//'<a href="'.site_url("uadmin/activity/print_pdf/").'" class="btn  btn-md btn-success waves-effect" target="_blank">Cetak Laporan </a>';
		$form .= form_close() ;
		$this->data[ "contents" ] = $form;
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Laporan";
		$this->data["header"] = "Generate Laporan";
		$this->data["sub_header"] = '';
		$this->render( "templates/contents/plain_content" );
	}
	public function generate_excel()
	{	
		$spreadsheet = new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'Hello')
			->setCellValue('B2', 'world!')
			->setCellValue('C1', 'Hello')
			->setCellValue('D2', 'world!');

		// Miscellaneous glyphs, UTF-8
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A4', 'Miscellaneous glyphs')
			->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="test.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0
		
		$writer = new Xlsx($spreadsheet);
		$filename = 'test.xlsx';
		ob_end_clean();
		$writer->save('php://output');
		exit;
		// exit;
		// return;
		// $nomenclature_id =  $this->input->post( 'nomenclature_id' );
		// $nomenclature_id =  ( $nomenclature_id != 0 ) ? $nomenclature_id : NULL ;
		// $year =  $this->input->post( 'year' );
		// $year =  ( $year != 0 ) ? $year : NULL ;
		// $excel = new Excel;
		// // echo 'aaaaa';die;

		// $activities = $this->activity_model->activities( 0, NULL, $nomenclature_id, $year  )->result();
		// // var_dump( $activities );die;
		// $excel->generate( $activities );
		
	}
}