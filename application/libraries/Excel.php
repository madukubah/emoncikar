<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  ======================================= 
 *  Author     : Muhammad Surya Ikhsanudin 
 *  License    : Protected 
 *  Email      : mutofiyah@gmail.com 
 *   
 *  Dilarang merubah, mengganti dan mendistribusikan 
 *  ulang tanpa sepengetahuan Author 
 *  ======================================= 
 */  
require_once APPPATH."/third_party/PHPExcel.php"; 
require_once APPPATH."/third_party/PHPExcel/Writer/Excel2007.php"; 
// require_once APPPATH."/third_party/Bootstrap.php"; 
// require_once APPPATH."/third_party/PhpSpreadsheet/Spreadsheet.php"; 



 
class Excel extends PHPExcel { 
    public function __construct() { 
        parent::__construct(); 
    } 

    public function generate( $activities )
    {   
        $this->setActiveSheetIndex(0);
		$this->getActiveSheet()->setTitle('Laporan');
        
        // Value Started
        $this->getActiveSheet()->mergeCells('A2:K2');
		$this->getActiveSheet()->setCellValue('A2', '');
		$this->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->getActiveSheet()->getStyle('A2')->getFont()->setSize(16);
        $this->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        // Value Started
        $this->getActiveSheet()->mergeCells('A3:K3');
		$this->getActiveSheet()->setCellValue('A3', ' DATA BASE KEGIATAN BIDANG CIPTA KARYA ');
		$this->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->getActiveSheet()->getStyle('A3')->getFont()->setSize(16);
        $this->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);

        $this->getActiveSheet()->mergeCells('E4:F4');
        $this->getActiveSheet()->setCellValue('E4', ' Tanggal: '.date( 'd M Y' ));
        $this->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->getActiveSheet()->getStyle('E4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->getActiveSheet()->getStyle('E4')->getFont()->setSize(12);
        $this->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);

        // header
        // $this->getActiveSheet()->mergeCells('A5:E5');
        // $this->getActiveSheet()->setCellValue('A5', 'DETAIL PEMBANGUNAN CIPTA KARYA');
		// $this->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// $this->getActiveSheet()->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		// $this->getActiveSheet()->getStyle('A5')->getFont()->setSize(11);
        // $this->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);

        // $this->getActiveSheet()->setCellValue('F5', 'PAGU');
		// $this->getActiveSheet()->getStyle('F5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// $this->getActiveSheet()->getStyle('F5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		// $this->getActiveSheet()->getStyle('F5')->getFont()->setSize(11);
        // $this->getActiveSheet()->getStyle('F5')->getFont()->setBold(true);

        // $this->getActiveSheet()->setCellValue('G5', 'REALISASI');
		// $this->getActiveSheet()->getStyle('G5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// $this->getActiveSheet()->getStyle('G5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		// $this->getActiveSheet()->getStyle('G5')->getFont()->setSize(11);
        // $this->getActiveSheet()->getStyle('G5')->getFont()->setBold(true);

        $headers = [
            'Nomenkaltur',
            'Uraian Detail Kegiatan',
            'Lokasi',
            'Volume',
            'Satuan',
            'Tipe Kegiatan',
            'Tahun Anggaran',
            'Longitude',
            'Latitude',
            'PAGU Anggaran',
            'REALISASI Anggaran',
            'Progress keuangan',
            'Progress Fisik',
        ];
        foreach( $headers as $ind => $header ):
            //SET DIMENSI TABEL
            $this->getActiveSheet()->getColumnDimension(chr( 65+$ind ))->setWidth(30);
            if( $ind <= 1 ) $this->getActiveSheet()->getColumnDimension(chr( 65+$ind ))->setWidth(40);
            
            $this->getActiveSheet()->setCellValue(( chr( 65+$ind ).'6' ), strtoupper( $header ) );
            $this->getActiveSheet()->getStyle(( chr( 65+$ind ).'6' ))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $this->getActiveSheet()->getStyle(( chr( 65+$ind ).'6' ))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $this->getActiveSheet()->getStyle( ( chr( 65+$ind ).'6' ))->getFont()->setSize(11);
            $this->getActiveSheet()->getStyle( ( chr( 65+$ind ).'6' ) )->getFont()->setBold(true);
            $this->getActiveSheet()->getStyle(( chr( 65+$ind ).'6' ))->getAlignment()->setWrapText(true);

            $this->getActiveSheet()->getStyle(( chr( 65+$ind ).'6' ))->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '9ba683')
                    )
                )
            );

        endforeach;
        // ROWS
        $number = 7;
        $headers = [
            'name',
            'title',
            'location',
            'quantity',
            'unit',
            'AuFnF',
            'year',
            'longitude',
            'latitude',
            'ceiling_budget',
            'real_total',
            'financial_progress',
            'physical_progress',
        ];
        $AuFnF_select = [
            "AU" => "[AU] Administrasi Umum",
            "F" => "[F] Fisik",
            "NF" => "[NF] Non Fisik",
          ];
        $n = 0;
        foreach( $activities as $activity ):
            foreach( $headers as $ind => $header ):
                
                if( $header == 'physical_progress' || $header == 'financial_progress' ) 
                {
                    $activity->$header = number_format($activity->$header, 2) ;
                    $activity->$header .= " % ";
                }
                $this->getActiveSheet()->setCellValue(( chr( 65+$ind ).$number ), ( $activity->$header ) );
                if( $header == 'AuFnF' ) $this->getActiveSheet()->setCellValue(( chr( 65+$ind ).$number ), ( $AuFnF_select[ $activity->AuFnF ] ) );

                $this->getActiveSheet()->getStyle(( chr( 65+$ind ).$number ))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $this->getActiveSheet()->getStyle(( chr( 65+$ind ).$number ))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $this->getActiveSheet()->getStyle( ( chr( 65+$ind ).$number ))->getFont()->setSize(11);
                $this->getActiveSheet()->getStyle(( chr( 65+$ind ).$number ))->getAlignment()->setWrapText(true);
                if( $header == 'ceiling_budget' || $header == 'real_total' ) 
                    $this->getActiveSheet()->getStyle( ( chr( 65+$ind ).$number ) )->getNumberFormat()->setFormatCode( '_("Rp "* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)' );

                if( $n == count( $activities ) - 1 )
                {
                    $this->getActiveSheet()->getStyle(( chr( 65+$ind ).$number ))->applyFromArray(
                        array(
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '9ba683')
                            )
                        )
                    );
                    $this->getActiveSheet()->getStyle( ( chr( 65+$ind ).$number ) )->getFont()->setBold(true);

                }
                    
            endforeach;
            
            $number++;
            $n++;
        endforeach;

		ob_end_clean();
        $filename='Laporan .xlsx'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        $objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel2007');

        $objWriter->save('php://output');
    }
}

