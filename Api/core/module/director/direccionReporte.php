<?php
    include_once '../../../conf.ini.php';
    include_once ROOT_EXCEL.'PHPExcel.php';

    function reporte_lista_pdf($data)
    {
        $pdf = new MYPDF(PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, false);
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->startPageGroup();
        $pdf->setFontSubsetting(true);
        $pdf->AddPage();

        list($grado,$seccion,$nivel,$columna,$option) = $data;
        $idAnioAcademico = $_SESSION['anio'][0];
        $idColegio = $_SESSION['colegio'][0];

        $rs_e  = gestorEstudiante::get_estudiante_reporte(array($grado,$seccion,$nivel,$idColegio,$idAnioAcademico));
        $row_a = gestorTutor::get_tutor_reporte(array($grado,$seccion,$nivel,$idColegio,$idAnioAcademico));
        $row_g = gestorGrado::set_grado($grado);
        $row_s = gestorSeccion::set_seccion($seccion);
        $row_n = gestorNivel::set_nivel($nivel);
        $row_t = gestorPersonal::set_personal($row_a[2]);

        $nombreTutor   = empty($row_t[0]) ? "NO ASIGNADO" : $row_t[3].' '.$row_t[4].' '.$row_t[5];

        $i=1;

        //DATOS DEL TITULO
        $pdf->SetXY(5,15);
        $pdf->SetFont(FONT_NAME,'B',20);
        $pdf->Cell(0,5,'LISTA DE ESTUDIANTES '.$_SESSION['anio'][1],0,1,'C');
        $pdf->Ln();

        $pdf->SetFont(FONT_NAME,'',10);
        $pdf->Cell(0,5,'TUTOR: '.$nombreTutor,0,1,'L');
        $pdf->Cell(0,5,$row_g[1].'° GRADO "'.$row_s[1].'" '.$row_n[1],0,1,'L');
        $pdf->Ln();

        $pdf->SetFillColor(166,166,166);
        $pdf->SetFont(FONT_NAME,'',10);
        $pdf->Cell(7,5,'N°',1,0,'C',true,'',1);
        $pdf->Cell(17,5,'CODIGO',1,0,'C',true,'',1);
        $pdf->Cell(100,5,'APELLIDOS Y NOMBRES',1,0,'C',true,'',1);
        $sumItemCols = 0;
        for ($cols=0; $cols < count($option) ; $cols++){
          $sumItemCols += 25;
          if($option[$cols] == 'FOTO') $pdf->Cell(25,5,($option[$cols]),1,0,'C',true);
          if($option[$cols] == 'GENERO') $pdf->Cell(25,5,("GENÉRO"),1,0,'C',true);
          if($option[$cols] == 'EDAD') $pdf->Cell(25,5,($option[$cols]),1,0,'C',true);
          if($option[$cols] == 'F.NAC.') $pdf->Cell(25,5,($option[$cols]),1,0,'C',true);
        }

        if($sumItemCols == 0){
            if(PAGE_ORIENTATION == 'P'){
                $ancho = 77;
            }else if(PAGE_ORIENTATION == 'L'){
                $ancho = 163;
            }
        } else {
          $ancho = ANCHO_CELDA-$sumItemCols;
        }

        for ($w=0; $w < $columna ; $w++) {
            $pdf->Cell($ancho/$columna,5,"",1,0,'C');
        }

        $pdf->Ln();
        $k=0;
        if($option[0] == 'FOTO') {
          $celda = 30; $cebra = false;
        } else {
          $celda = 5;
        }

        foreach($rs_e as $rows){

            $row_e = gestorEstudiante::set_estudiante($rows[3]);
            $row_f = gestorFicha::set_ficha($rows[0]);
            $fotoEStudiante = sistema::get_info_foto_estudiante($row_e[14],$row_e[7]);

            $k++;
            $var = (($k%2) == 0) ? true : false;

            $pdf->SetFillColor(216,216,216);
            $pdf->SetFont(FONT_NAME,'I',9);
            $pdf->Cell(7,$celda,$i,1,0,'C',$var);
            $pdf->Cell(17,$celda,$row_f[7],1,0,'C',$var);
            $pdf->Cell(100,$celda,($row_e[3].' '.$row_e[4].', '.$row_e[5]),1,0,'L',$var);
            for ($cols=0; $cols < count($option) ; $cols++){
                if($option[$cols] == 'FOTO') $pdf->Cell(25,$celda, $pdf->Image(ROOT_IMG.'ESTUDIANTE\\'.$fotoEStudiante, $pdf->GetX() , $pdf->GetY()+2.5, 25) ,1,0,'C',$cebra);
                if($option[$cols] == 'GENERO') $pdf->Cell(25,$celda,sistema::set_sexo($row_e[7]),1,0,'C',$var);
                if($option[$cols] == 'EDAD') $pdf->Cell(25,$celda,($row_e[8]),1,0,'C',$var);
                if($option[$cols] == 'F.NAC.') $pdf->Cell(25,$celda,($row_e[9]),1,0,'C',$var);
            }
            for ($w=0; $w < $columna ; $w++) {
                $pdf->Cell($ancho/$columna,$celda,"",1,0,'C',$var);
            }
            $pdf->Ln();
            $i++;
        }

        $pdf->Output();
    }

    function reporte_lista_xls($data)
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_EXCEL.'PHPConfig.php';

        list($grado,$seccion,$nivel,$columna,$option) = $data;
        $idAnioAcademico = $_SESSION['anio'][0];
        $idColegio = $_SESSION['colegio'][0];

        $rs_e  = gestorEstudiante::get_estudiante_reporte(array($grado,$seccion,$nivel,$idColegio,$idAnioAcademico));
        $row_a = gestorTutor::get_tutor_reporte(array($grado,$seccion,$nivel,$idColegio,$idAnioAcademico));
        $row_g = gestorGrado::set_grado($grado);
        $row_s = gestorSeccion::set_seccion($seccion);
        $row_n = gestorNivel::set_nivel($nivel);
        $row_t = gestorPersonal::set_personal($row_a[2]);

        $nombreTutor   = empty($row_t[0]) ? "NO ASIGNADO" : $row_t[3].' '.$row_t[4].' '.$row_t[5];

        $rangeCeldauno   = cellsToMergeByColsRow(0, 10, 1);
        $objPHPExcel->getActiveSheet(0)->setTitle('lista_estudiante'); #-- Nombre de la de la hoja de Excel
        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldauno)->applyFromArray($titulo_uno);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldauno);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(40);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,1, 'LISTA DE ESTUDIANTES '.$_SESSION['anio'][1]);

        $objPHPExcel->getActiveSheet(0)->getRowDimension(4)->setRowHeight(12);

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow(0,0,4))->applyFromArray($titulo_tres);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow(0,0,4));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,4,'TUTOR:');

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow(1,4,4))->applyFromArray($titulo_tres);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow(1,4,4));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(1,4,$nombreTutor);

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow(0,4,5))->applyFromArray($titulo_tres);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow(0,4,5));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,5,$row_g[1]." ".$row_s[1]."".$row_n[1]);

        $arrayName = array('N°','CODIGO','APELLIDOS Y NOMBRES');
        $arrayA = array(0,1,2);
        $arrayB = array(0,0,3);

        $inicioA = 5;

        $sumItemCols = 0;
        for ($cols=0; $cols < count($option) ; $cols++){
          $sumItemCols += 1;
          if($option[$cols] == 'FOTO') array_push($arrayName,$option[$cols]); array_push($arrayA,$inicioA+=1); array_push($arrayB,0);
          if($option[$cols] == 'GENERO') array_push($arrayName,"GENÉRO"); array_push($arrayA,$inicioA+=1); array_push($arrayB,0);
          if($option[$cols] == 'EDAD') array_push($arrayName,$option[$cols]); array_push($arrayA,$inicioA+=1); array_push($arrayB,0);
          if($option[$cols] == 'F.NAC.') array_push($arrayName,$option[$cols]); array_push($arrayA,$inicioA+=1); array_push($arrayB,0);
        }

        if($sumItemCols == 0){
            $inicioB = $inicioA;
        } else {
            $inicioB= $inicioA;
        }

        $colsB = 0;

        for ($w=0; $w < $columna ; $w++) {
            array_push($arrayName,"");
            array_push($arrayA,$inicioB+=1);
            array_push($arrayB,0);

        }

        foreach ($arrayName as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],7))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],7));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],7,$value);
        }

        $w = 0;
        $rowA = 8;

        $arrayNameA = array();

        foreach($rs_e as $rows){
            $w++;
            $row_e = gestorEstudiante::set_estudiante($rows[3]);
            $row_f = gestorFicha::set_ficha($rows[0]);

            $fotoEStudiante = sistema::get_info_foto_estudiante($row_e[14],$row_e[7]);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow(0,0,$rowA))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow(0,0,$rowA));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,$rowA,$w);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow(1,1,$rowA))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow(1,1,$rowA));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(1,$rowA,$row_f[7]);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow(2,5,$rowA))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow(2,5,$rowA));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2,$rowA,$row_e[3].' '.$row_e[4].', '.$row_e[5]);

            $inicioA = 5;

            $sumItemCols = 0;

            for ($cols=0; $cols < count($option) ; $cols++){
                $sumItemCols += 1;
                if($option[$cols] == 'FOTO'){
                    $inicioA+=1;
                    $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($inicioA,$inicioA,$rowA))->applyFromArray($titulo_tres);
                    $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($inicioA,$inicioA,$rowA));
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($inicioA,$rowA,"");
                }

                if($option[$cols] == 'GENERO'){
                    $inicioA+=1;
                    $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($inicioA,$inicioA,$rowA))->applyFromArray($titulo_tres);
                    $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($inicioA,$inicioA,$rowA));
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($inicioA,$rowA,sistema::set_sexo($row_e[7]));
                }

                if($option[$cols] == 'EDAD'){
                    $inicioA+=1;
                    $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($inicioA,$inicioA,$rowA))->applyFromArray($titulo_tres);
                    $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($inicioA,$inicioA,$rowA));
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($inicioA,$rowA,$row_e[8]);
                }

                if($option[$cols] == 'F.NAC.'){
                    $inicioA+=1;
                    $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($inicioA,$inicioA,$rowA))->applyFromArray($titulo_tres);
                    $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($inicioA,$inicioA,$rowA));
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($inicioA,$rowA,$row_e[9]);
                }
            }

            if($sumItemCols == 0){
                $inicioB = $inicioA;
            } else {
                $inicioB= $inicioA;
            }

            for ($w=0; $w < $columna ; $w++) {
                $inicioB+=1;
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($inicioB,$inicioB,$rowA))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($inicioB,$inicioB,$rowA));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($inicioB,$rowA,"");
            }

            $rowA++;
        }


        $nombreArchivo = "reporte_estudiante.xlsx";
        require_once ROOT_EXCEL.'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($_SERVER['DOCUMENT_ROOT']."/EVA/view/core/report/archive/".$nombreArchivo);
        sistema::imprimir(utf8_decode($nombreArchivo));
    }

?>