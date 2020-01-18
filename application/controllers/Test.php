$excel->setActiveSheetIndex(0);
		$excel->getActiveSheet()->setTitle('Laporan');
        
        // Value Started
        $$excel->setActiveSheetIndex(0);
		$excel->getActiveSheet()->setTitle('Laporan');
        
        // Value Started
        $excel->getActiveSheet()->mergeCells('A2:F2');
		$excel->getActiveSheet()->setCellValue('A2', '');
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(16);
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        // Value Started
        $excel->getActiveSheet()->mergeCells('A3:F3');
		$excel->getActiveSheet()->setCellValue('A3', ' DATA BASE KEGIATAN BIDANG CIPTA KARYA ');
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(16);
        $excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);

        // header
        // $excel->getActiveSheet()->mergeCells('A5:E5');
        // $excel->getActiveSheet()->setCellValue('A5', 'DETAIL PEMBANGUNAN CIPTA KARYA');
		// $excel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// $excel->getActiveSheet()->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		// $excel->getActiveSheet()->getStyle('A5')->getFont()->setSize(11);
        // $excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);

        // $excel->getActiveSheet()->setCellValue('F5', 'PAGU');
		// $excel->getActiveSheet()->getStyle('F5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// $excel->getActiveSheet()->getStyle('F5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		// $excel->getActiveSheet()->getStyle('F5')->getFont()->setSize(11);
        // $excel->getActiveSheet()->getStyle('F5')->getFont()->setBold(true);

        // $excel->getActiveSheet()->setCellValue('G5', 'REALISASI');
		// $excel->getActiveSheet()->getStyle('G5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// $excel->getActiveSheet()->getStyle('G5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		// $excel->getActiveSheet()->getStyle('G5')->getFont()->setSize(11);
        // $excel->getActiveSheet()->getStyle('G5')->getFont()->setBold(true);

        $headers = [
            'Nomenkaltur',
            'Uraian Detail Kegiatan',
            'Lokasi',
            'Volume',
            'Satuan',
            'Tipe Kegiatan',
            'PAGU Anggaran',
            'REALISASI Anggaran',
            'Tahun Anggaran',
            'Longitude',
            'Latitude',
        ];
        foreach( $headers as $ind => $header ):
            //SET DIMENSI TABEL
            $excel->getActiveSheet()->getColumnDimension(chr( 65+$ind ))->setWidth(30);
            if( $ind <= 1 ) $excel->getActiveSheet()->getColumnDimension(chr( 65+$ind ))->setWidth(40);
            
            $excel->getActiveSheet()->setCellValue(( chr( 65+$ind ).'6' ), strtoupper( $header ) );
            $excel->getActiveSheet()->getStyle(( chr( 65+$ind ).'6' ))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $excel->getActiveSheet()->getStyle(( chr( 65+$ind ).'6' ))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $excel->getActiveSheet()->getStyle( ( chr( 65+$ind ).'6' ))->getFont()->setSize(11);
            $excel->getActiveSheet()->getStyle( ( chr( 65+$ind ).'6' ) )->getFont()->setBold(true);
            $excel->getActiveSheet()->getStyle(( chr( 65+$ind ).'6' ))->getAlignment()->setWrapText(true);

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
            'ceiling_budget',
            'real_total',
            'year',
            'longitude',
            'latitude',
        ];
        $AuFnF_select = [
            "AU" => "[AU] Administrasi Umum",
            "F" => "[F] Fisik",
            "NF" => "[NF] Non Fisik",
          ];
        foreach( $activities as $activity ):
            foreach( $headers as $ind => $header ):
                
                $excel->getActiveSheet()->setCellValue(( chr( 65+$ind ).$number ), ( $activity->$header ) );
                if( $header == 'AuFnF' ) $excel->getActiveSheet()->setCellValue(( chr( 65+$ind ).$number ), ( $AuFnF_select[ $activity->AuFnF ] ) );

                $excel->getActiveSheet()->getStyle(( chr( 65+$ind ).$number ))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $excel->getActiveSheet()->getStyle(( chr( 65+$ind ).$number ))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $excel->getActiveSheet()->getStyle( ( chr( 65+$ind ).$number ))->getFont()->setSize(11);
                $excel->getActiveSheet()->getStyle(( chr( 65+$ind ).$number ))->getAlignment()->setWrapText(true);
                if( $header == 'ceiling_budget' || $header == 'real_total' ) 
                    $excel->getActiveSheet()->getStyle( ( chr( 65+$ind ).$number ) )->getNumberFormat()->setFormatCode( '_("Rp "* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)' );

            endforeach;
            $number++;
        endforeach;

		ob_end_clean();
        $filename='Laporan .xlsx'; //save our workbook as excel file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');

        $objWriter->save('php://output');->getActiveSheet()->mergeCells('A2:F2');
		$excel->getActiveSheet()->setCellValue('A2', '');
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(16);
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        // Value Started
        $excel->getActiveSheet()->mergeCells('A3:F3');
		$excel->getActiveSheet()->setCellValue('A3', ' DATA BASE KEGIATAN BIDANG CIPTA KARYA ');
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(16);
        $excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);

        // header
        // $excel->getActiveSheet()->mergeCells('A5:E5');
        // $excel->getActiveSheet()->setCellValue('A5', 'DETAIL PEMBANGUNAN CIPTA KARYA');
		// $excel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// $excel->getActiveSheet()->getStyle('A5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		// $excel->getActiveSheet()->getStyle('A5')->getFont()->setSize(11);
        // $excel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);

        // $excel->getActiveSheet()->setCellValue('F5', 'PAGU');
		// $excel->getActiveSheet()->getStyle('F5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// $excel->getActiveSheet()->getStyle('F5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		// $excel->getActiveSheet()->getStyle('F5')->getFont()->setSize(11);
        // $excel->getActiveSheet()->getStyle('F5')->getFont()->setBold(true);

        // $excel->getActiveSheet()->setCellValue('G5', 'REALISASI');
		// $excel->getActiveSheet()->getStyle('G5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		// $excel->getActiveSheet()->getStyle('G5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		// $excel->getActiveSheet()->getStyle('G5')->getFont()->setSize(11);
        // $excel->getActiveSheet()->getStyle('G5')->getFont()->setBold(true);

        $headers = [
            'Nomenkaltur',
            'Uraian Detail Kegiatan',
            'Lokasi',
            'Volume',
            'Satuan',
            'Tipe Kegiatan',
            'PAGU Anggaran',
            'REALISASI Anggaran',
            'Tahun Anggaran',
            'Longitude',
            'Latitude',
        ];
        foreach( $headers as $ind => $header ):
            //SET DIMENSI TABEL
            $excel->getActiveSheet()->getColumnDimension(chr( 65+$ind ))->setWidth(30);
            if( $ind <= 1 ) $excel->getActiveSheet()->getColumnDimension(chr( 65+$ind ))->setWidth(40);
            
            $excel->getActiveSheet()->setCellValue(( chr( 65+$ind ).'6' ), strtoupper( $header ) );
            $excel->getActiveSheet()->getStyle(( chr( 65+$ind ).'6' ))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $excel->getActiveSheet()->getStyle(( chr( 65+$ind ).'6' ))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $excel->getActiveSheet()->getStyle( ( chr( 65+$ind ).'6' ))->getFont()->setSize(11);
            $excel->getActiveSheet()->getStyle( ( chr( 65+$ind ).'6' ) )->getFont()->setBold(true);
            $excel->getActiveSheet()->getStyle(( chr( 65+$ind ).'6' ))->getAlignment()->setWrapText(true);

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
            'ceiling_budget',
            'real_total',
            'year',
            'longitude',
            'latitude',
        ];
        $AuFnF_select = [
            "AU" => "[AU] Administrasi Umum",
            "F" => "[F] Fisik",
            "NF" => "[NF] Non Fisik",
          ];
        foreach( $activities as $activity ):
            foreach( $headers as $ind => $header ):
                
                $excel->getActiveSheet()->setCellValue(( chr( 65+$ind ).$number ), ( $activity->$header ) );
                if( $header == 'AuFnF' ) $excel->getActiveSheet()->setCellValue(( chr( 65+$ind ).$number ), ( $AuFnF_select[ $activity->AuFnF ] ) );

                $excel->getActiveSheet()->getStyle(( chr( 65+$ind ).$number ))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $excel->getActiveSheet()->getStyle(( chr( 65+$ind ).$number ))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $excel->getActiveSheet()->getStyle( ( chr( 65+$ind ).$number ))->getFont()->setSize(11);
                $excel->getActiveSheet()->getStyle(( chr( 65+$ind ).$number ))->getAlignment()->setWrapText(true);
                if( $header == 'ceiling_budget' || $header == 'real_total' ) 
                    $excel->getActiveSheet()->getStyle( ( chr( 65+$ind ).$number ) )->getNumberFormat()->setFormatCode( '_("Rp "* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)' );

            endforeach;
            $number++;
        endforeach;

		ob_end_clean();
        $filename='Laporan .xlsx'; //save our workbook as excel file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');

        $objWriter->save('php://output');