<?php
    include_once '../../../conf.ini.php';
    include_once ROOT_EXCEL.'PHPExcel.php';

    function reporte_eta_aula($data)
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_EXCEL.'PHPConfig.php';

        list($unidad,$semana) = $data;

        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
        $row_s = gestorSemana::set_semana($semana);

        list( $idGrado, $nombreGrado)     = GestorGrado::set_grado($_SESSION['tutor']['grado']);
        list( $idSeccion, $nombreSeccion) = GestorSeccion::set_seccion($_SESSION['tutor']['seccion']);
        list( $idNivel, $nombreNivel)     = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $data1 = array($_SESSION['tutor']['grado'],$_SESSION['tutor']['seccion'],$_SESSION['tutor']['nivel'],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_s[0]);
        $data2 = array($_SESSION['tutor']['grado'],$_SESSION['tutor']['seccion'],$_SESSION['tutor']['nivel'],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_s[0]);

        $rs_e  = gestorRegistroEta::get_eta_calificacion($data1,0,ETA_TABLA);
        $row_r = gestorRegistroEta::get_eta_registro($data2);
        $row_t = gestorTutor::get_eta_tutor($data1);
        $rs_c  = gestorCursoEta::get_eta_curso(array($_SESSION['anio'][0],ETA));


        $nombreTutor = $nombreTutor = $row_t[3]." ".$row_t[4]." ".$row_t[5];

        $r_eta        = gestorRegistroEta::get_eta_configuracion(ETA);
        $CantCampo    = gestorRegistroEta::get_registro_campos(ETA_TABLA);
        $CantPregunta = $r_eta[2];
        $CantUsuario  = $r_eta[3];
        $CantDetalle  = $r_eta[4];


        $inicioRespuestaCorrecta = $CantUsuario + $CantPregunta + $CantDetalle;
        $inicioTotalCalificacion = $CantUsuario + $CantPregunta;

        $mg=1;

        $rangeCeldauno   = cellsToMergeByColsRow(0, 30, 1);
        $rangeCeldados   = cellsToMergeByColsRow(0, 30, 2);

        $objPHPExcel->getActiveSheet(0)->setTitle('reporte_aula'); #-- Nombre de la de la hoja de Excel

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldauno)->applyFromArray($titulo_uno);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldauno);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(40);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,1, 'REPORTE ETA POR AULA');

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldados)->applyFromArray($titulo_dos);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldados);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(2)->setRowHeight(25);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,2, $row_c[5]." ".$row_c[1]);

        $arrayName = array();
        array_push($arrayName,'TUTOR:');
        array_push($arrayName,$nombreTutor);
        array_push($arrayName,'NIVEL:');
        array_push($arrayName,$nombreNivel);
        array_push($arrayName,'GRADO:');
        array_push($arrayName,$nombreGrado);
        array_push($arrayName,'SECCION:');
        array_push($arrayName,$nombreSeccion);
        array_push($arrayName,'EVALUACIÓN:');
        array_push($arrayName,$row_s[3]);
        array_push($arrayName,$row_u[3]);
        array_push($arrayName,'FECHA:');
        array_push($arrayName,$row_s[4]);

        $arraySize  = array(10,42,12,15,12,12,12,12,15,12,12,12,18);
        $arrayfill  = array(1,0,1,0,1,0,1,0,1,0,1,1,0);

        $arrayA = array(0,1,3,5,8,10,12,15,17,21,24,27,30);
        $arrayB = array(0,1,1,2,1,1,2,1,3,2,2,2,2);

        foreach ($arrayName as $key => $value) {
            $valor = ($arrayfill[$key] == 1) ? $titulo_cuatro : $titulo_tres;
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],4,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(4)->setRowHeight(20);
        }

        $arrayCurso = array("CODIGO","APELLIDOS Y NOMBRES","MG");
        $arrayA = array(0,1,2);
        $arrayB = array(0,0,0);
        $a=0;
        foreach ($rs_c as $row_c) {
            $a+=3;
            array_push($arrayCurso,$row_c[3]);
            array_push($arrayA,$a);
            array_push($arrayB,2);
        }
        array_push($arrayCurso,"PROMEDIO");
        array_push($arrayA,$a+3);
        array_push($arrayB,2);

        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn(0)->setWidth(10);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn(1)->setWidth(42);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn(2)->setWidth(10);

        for ($c=3; $c < 33; $c++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn($c)->setWidth(5);
        }

        foreach ($arrayCurso as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6))->applyFromArray($titulo_cuatro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],6,$value);
        }


        ///////////////////////
        // LISTA ESTUDIANTES //
        ///////////////////////

        $cv = 7;

        $suma_nota = $suma_proc = $suma_buena = $suma_mala = $suma_blanco = array();

        $a = 0;

        foreach($rs_e as $rows){
            $a++;
            $ch = $ca = 3;
            $cb = 3;

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(0,0,$cv,$cv+2))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(0,0,$cv,$cv+2));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,$cv,$rows[3]);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(1,1,$cv,$cv+2))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(1,1,$cv,$cv+2));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(1,$cv,$rows[4]." ".$rows[5]);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(2,2,$cv,$cv+2))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(2,2,$cv,$cv+2));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2,$cv,$a.'°');

            $cont = 0;
            for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {

                $cont++;

                $suma_nota[$u] += $rows[$u];
                $suma_proc[$u-1] += $rows[$u-1];

                if ($rows[$u] <= 10) {
                    $color = $celda_uno;
                }elseif ($rows[$u]>=11 && $rows[$u]<=17){
                    $color = $celda_dos;
                } elseif ($rows[$u]>=18 && $rows[$u]<= 20){
                    $color = $celda_tres;
                }

                $ca+=3;

                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca-1,$cv))->applyFromArray($color);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca-1,$cv));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv,$rows[$u]);

                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca-1,$cv+1))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca-1,$cv+1));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv+1, $rows[$u-1].'%');

                $ch+=3;
            }

            for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {

                $suma_buena[$j] += $rows[$j];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j]);
                $cb +=1;

                $suma_mala[$j+1] += $rows[$j+1];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+1]);
                $cb +=1;

                $suma_blanco[$j+2] += $rows[$j+2];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+2]);
                $cb +=1;
            }



            /////////////////////////
            // PROMEDIO POR ALUMNO //
            /////////////////////////

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca+2,$cv))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca+2,$cv));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv,round($rows[$inicioTotalCalificacion+4]/$cont,2),2);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca+2,$cv+1))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca+2,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv+1,$rows[$inicioTotalCalificacion+3].'%');

            for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j]);
                $cb +=1;

                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+1]);
                $cb +=1;

                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+2]);
                $cb +=1;
            }

            $cv+=3;
        }

         ////////////////////////
        // RESULTADOS FINALES //
        ////////////////////////


        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(0,0,$cv,$cv+2))->applyFromArray($titulo_tres);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(0,0,$cv,$cv+2));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,$cv,"");

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(1,1,$cv,$cv+2))->applyFromArray($titulo_tres);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(1,1,$cv,$cv+2));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(1,$cv,"");

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(2,2,$cv,$cv+2))->applyFromArray($titulo_tres);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(2,2,$cv,$cv+2));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2,$cv,"");

        $prom_suma = $prom_porc = 0;
        $ch = $ca = 3;

        for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {

            $prom_suma += ($suma_nota[$u]/$a);
            $prom_porc += ($suma_proc[$u-1]/$a);

            $ca+=3;

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca-1,$cv))->applyFromArray($celda_cuadro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca-1,$cv));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv, round($suma_nota[$u]/$a,2) );

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca-1,$cv+1))->applyFromArray($celda_cuadro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca-1,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv+1, round($suma_proc[$u-1]/$a).'%');

            $ch+=3;
        }

        $cb = 3;

        for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {
            $prom_buena += round($suma_buena[$j]/$a,2);
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_cuadro);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($suma_buena[$j]/$a));
            $cb +=1;

            $prom_mala += round($suma_mala[$j+1]/$a,2);
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_cuadro);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($suma_mala[$j+1]/$a));
            $cb +=1;

            $prom_blanco += round($suma_blanco[$j+2]/$a,2);
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_cuadro);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($suma_blanco[$j+2]/$a));
            $cb +=1;
        }

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca+2,$cv))->applyFromArray($celda_quinto);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca+2,$cv));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv, round($prom_suma/$cont,2));

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca+2,$cv+1))->applyFromArray($celda_quinto);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca+2,$cv+1));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv+1, round($prom_porc/$cont).'%');


        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_quinto);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($prom_buena));
        $cb +=1;

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_quinto);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($prom_mala));
        $cb +=1;

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_quinto);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($prom_blanco));
        $cb +=1;


        $nombreArchivo = "reporte_eta_aula.xlsx";
        require_once ROOT_EXCEL.'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($_SERVER['DOCUMENT_ROOT']."/EVA/view/core/report/archive/".$nombreArchivo);
        sistema::imprimir(utf8_decode($nombreArchivo));
    }

    function reporte_eta_grado($data)
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_EXCEL.'PHPConfig.php';

        list($unidad,$semana) = $data;

        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
        $row_s = gestorSemana::set_semana($semana);


        list( $idGrado, $nombreGrado)     = GestorGrado::set_grado($_SESSION['tutor']['grado']);
        list( $idNivel, $nombreNivel)     = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $nombreTutor = $nombreSeccion = array();

        $data1 = array($idGrado,$_SESSION['colegio'][0],$_SESSION['anio'][0],$semana);
        $data2 = array($idGrado,$_SESSION['anio'][0]);

        $rs_e = gestorRegistroEta::get_eta_calificacion_grado($data1,0,ETA_TABLA);
        $rs_r = gestorRegistroEta::get_eta_grupo_grado($data2);
        $rs_t = gestorTutor::get_eta_tutor_grado($data1);
        $rs_c = gestorCursoEta::get_eta_curso(array($_SESSION['anio'][0],ETA));

        foreach ($rs_t as $row_t) {

            array_push($nombreTutor, $row_t[3]." ".$row_t[4]." ".$row_t[5]);
        }

        foreach ($rs_r as $row_r) {
            $rows = GestorSeccion::set_seccion($row_r[3]);
            array_push($nombreSeccion,$rows[1]);
        }

        $r_eta        = gestorRegistroEta::get_eta_configuracion(ETA);
        $CantCampo    = gestorRegistroEta::get_registro_campos(ETA_TABLA);
        $CantPregunta = $r_eta[2];
        $CantUsuario  = $r_eta[3];
        $CantDetalle  = $r_eta[4];


        $inicioRespuestaCorrecta = $CantUsuario + $CantPregunta + $CantDetalle;
        $inicioTotalCalificacion = $CantUsuario + $CantPregunta;

        $rangeCeldauno   = cellsToMergeByColsRow(0, 20, 1);
        $rangeCeldados   = cellsToMergeByColsRow(0, 20, 2);

        $objPHPExcel->getActiveSheet(0)->setTitle('reporte_grado'); #-- Nombre de la de la hoja de Excel

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldauno)->applyFromArray($titulo_uno);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldauno);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(40);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,1, 'REPORTE ETA POR GRADO');

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldados)->applyFromArray($titulo_dos);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldados);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(2)->setRowHeight(25);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,2, $row_c[5]." ".$row_c[1]);

        $arrayName = array();
        array_push($arrayName,'TUTORES:');
        array_push($arrayName,$nombreTutor[0]."\n".$nombreTutor[1]);
        array_push($arrayName,'NIVEL:');
        array_push($arrayName,$nombreNivel);
        array_push($arrayName,'GRADO:');
        array_push($arrayName,$nombreGrado);
        array_push($arrayName,'SECCION:');
        array_push($arrayName,$nombreSeccion[0]." | ".$nombreSeccion[1]);
        array_push($arrayName,'EVALUACIÓN:');
        array_push($arrayName,$row_s[3]);
        array_push($arrayName,$row_u[3]);
        array_push($arrayName,'FECHA:');
        array_push($arrayName,$row_s[4]);

        $arraySize  = array(10,42,12,15,12,12,12,12,15,12,12,12,18);
        $arrayfill  = array(1,0,1,0,1,0,1,0,1,0,1,1,0);

        $arrayA = array(0,1,3,5,8,10,12,15,18,22,25,28,31);
        $arrayB = array(0,1,1,2,1,1,2,2,3,2,2,2,2);

        foreach ($arrayName as $key => $value) {
            $valor = ($arrayfill[$key] == 1) ? $titulo_cuatro : $titulo_tres;
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4));
            $objPHPExcel->getActiveSheet(0)->getRowDimension(4)->setRowHeight(40);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],4,$value);


        }

        $arrayCurso = array("N°","APELLIDOS Y NOMBRES","MG","SECCION");
        $arrayA = array(0,1,2,3);
        $arrayB = array(0,0,0,0);
        $a = 1;
        foreach ($rs_c as $row_c) {
            $a+=3;
            array_push($arrayCurso,$row_c[3]);
            array_push($arrayA,$a);
            array_push($arrayB,2);
        }
        array_push($arrayCurso,"PROMEDIO");
        array_push($arrayA,$a+3);
        array_push($arrayB,2);

        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn(0)->setWidth(11);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn(1)->setWidth(42);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn(2)->setWidth(10);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn(3)->setWidth(10);


        for ($c=4; $c < 50; $c++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn($c)->setWidth(5);
        }

        foreach ($arrayCurso as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6))->applyFromArray($titulo_cuatro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],6,$value);
        }


        /////////////////////////
        // LISTA DE ESTUDIANTE //
        /////////////////////////
        $suma_nota = $suma_proc = $suma_buena = $suma_mala = $suma_blanco = array();
        $prom_buena = $prom_mala = $prom_blanco = 0;

        $cv = 7;
        $mg = 0;

        foreach($rs_e as $rows){
            $ch = $ca = 4;
            $cb = 4;
            $mg ++;

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(0,0,$cv,$cv+2))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(0,0,$cv,$cv+2));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,$cv,$rows[3]);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(1,1,$cv,$cv+2))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(1,1,$cv,$cv+2));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(1,$cv,$rows[5]." ".$rows[4]);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(2,2,$cv,$cv+2))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(2,2,$cv,$cv+2));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2,$cv,$mg.'°');

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(3,3,$cv,$cv+2))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(3,3,$cv,$cv+2));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(3,$cv,$rows[7]);

           $cont = 0;
            for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {
                $cont++;

                $valor_nota = $rows[$u];
                $valor_porc = $rows[$u-1];

                $suma_nota[$u] += $valor_nota;
                $suma_proc[$u-1] += $valor_porc;

                if ($rows[$u] <= 10) {
                    $color = $celda_uno;
                }elseif ($rows[$u]>=11 && $rows[$u]<=17){
                    $color = $celda_dos;
                } elseif ($rows[$u]>=18 && $rows[$u]<= 20){
                    $color = $celda_tres;
                }

                $ca+=3;

                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca-1,$cv))->applyFromArray($color);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca-1,$cv));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv,$valor_nota);

                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca-1,$cv+1))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca-1,$cv+1));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv+1, $valor_porc.'%');

                $ch+=3;
            }

            for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {

                $suma_buena[$j] += $rows[$j];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j]);
                $cb +=1;

                $suma_mala[$j+1] += $rows[$j+1];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+1]);
                $cb +=1;

                $suma_blanco[$j+2] += $rows[$j+2];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+2]);
                $cb +=1;
            }

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca+2,$cv))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca+2,$cv));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv,round($rows[$inicioTotalCalificacion+4]/$cont,2));

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca+2,$cv+1))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca+2,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv+1,$rows[$inicioTotalCalificacion+3].'%');

            for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {

                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j]);
                $cb +=1;

                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+1]);
                $cb +=1;

                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+2]);
                $cb +=1;
            }

            $cv+=3;
        }


        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(0,0,$cv,$cv+2))->applyFromArray($titulo_tres);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(0,0,$cv,$cv+2));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,$cv,"");

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(1,1,$cv,$cv+2))->applyFromArray($titulo_tres);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(1,1,$cv,$cv+2));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(1,$cv,"");

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(2,2,$cv,$cv+2))->applyFromArray($titulo_tres);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(2,2,$cv,$cv+2));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2,$cv,"");

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(3,3,$cv,$cv+2))->applyFromArray($titulo_tres);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(3,3,$cv,$cv+2));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(3,$cv,"");

        $prom_suma = $prom_porc = 0;
        $ch = $ca = 4;

        for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {

            $prom_suma += ($suma_nota[$u]/$mg);
            $prom_porc += ($suma_proc[$u-1]/$mg);

            $ca+=3;

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca-1,$cv))->applyFromArray($celda_cuadro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca-1,$cv));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv, round($suma_nota[$u]/$mg,2) );

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca-1,$cv+1))->applyFromArray($celda_cuadro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca-1,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv+1, round($suma_proc[$u-1]/$mg).'%');

            $ch+=3;
        }

        $cb = 4;

        for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {
            $prom_buena += round($suma_buena[$j]/$mg,2);
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_cuadro);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($suma_buena[$j]/$mg));
            $cb +=1;

            $prom_mala += round($suma_mala[$j+1]/$mg,2);
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_cuadro);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($suma_mala[$j+1]/$mg));
            $cb +=1;

            $prom_blanco += round($suma_blanco[$j+2]/$mg,2);
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_cuadro);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($suma_blanco[$j+2]/$mg));
            $cb +=1;
        }


        //////////////////////
        // PROMEDIO GENERAL //
        //////////////////////

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca+2,$cv))->applyFromArray($celda_quinto);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca+2,$cv));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv, round($prom_suma/$cont,2));

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca+2,$cv+1))->applyFromArray($celda_quinto);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca+2,$cv+1));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv+1, round($prom_porc/$cont).'%');


        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_quinto);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($prom_buena));
        $cb +=1;

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_quinto);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($prom_mala));
        $cb +=1;

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_quinto);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($prom_blanco));
        $cb +=1;

        $nombreArchivo = "reporte_eta_grado.xlsx";
        require_once ROOT_EXCEL.'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($_SERVER['DOCUMENT_ROOT']."/EVA/view/core/report/archive/".$nombreArchivo);
        sistema::imprimir(utf8_decode($nombreArchivo));
    }

    function reporte_eta_grupo($data)
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_EXCEL.'PHPConfig.php';

        list($unidad,$semana,$grupo) = $data;

        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
        $row_s = gestorSemana::set_semana($semana);

        list( $idNivel, $nombreNivel, $abrvNivel) = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $nombreSeccion = $nombreGrado = array();

        $data1 = array($grupo,$_SESSION['colegio'][0],$_SESSION['anio'][0],$semana);
        $data2 = array($grupo,$_SESSION['anio'][0]);

        $rs_e = gestorRegistroEta::get_eta_calificacion_grupo($data1,0,ETA_TABLA);
        $rs_r = gestorRegistroEta::get_eta_grupo($data2);

        $rs_c = gestorCursoEta::get_eta_curso(array($_SESSION['anio'][0],ETA));

        foreach ($rs_r as $row_r) {
            $rows1 = GestorGrado::set_grado($row_r[2]);
            $rows2 = GestorSeccion::set_seccion($row_r[3]);
            array_push($nombreGrado,$rows1[1]);
            array_push($nombreSeccion,$rows2[1]);
        }

        $r_eta        = gestorRegistroEta::get_eta_configuracion(ETA);
        $CantCampo    = gestorRegistroEta::get_registro_campos(ETA_TABLA);
        $CantPregunta = $r_eta[2];
        $CantUsuario  = $r_eta[3];
        $CantDetalle  = $r_eta[4];


        $inicioRespuestaCorrecta = $CantUsuario + $CantPregunta + $CantDetalle;
        $inicioTotalCalificacion = $CantUsuario + $CantPregunta;

        $rangeCeldauno   = cellsToMergeByColsRow(0, 15, 1);
        $rangeCeldados   = cellsToMergeByColsRow(0, 15, 2);

        $objPHPExcel->getActiveSheet(0)->setTitle('reporte_grado'); #-- Nombre de la de la hoja de Excel

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldauno)->applyFromArray($titulo_uno);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldauno);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(40);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,1, 'REPORTE ETA POR GRADO');

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldados)->applyFromArray($titulo_dos);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldados);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(2)->setRowHeight(25);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,2, $row_c[5]." ".$row_c[1]);

        $arrayName = array();
        array_push($arrayName,'NIVEL:');
        array_push($arrayName,$nombreNivel);
        array_push($arrayName,'GRADO:');
        array_push($arrayName,$nombreGrado[0]."|".$nombreGrado[1]."|".$nombreGrado[2]);
        array_push($arrayName,'SECCION:');
        array_push($arrayName,$nombreSeccion[0]."|".$nombreSeccion[1]);
        array_push($arrayName,'EVALUACIÓN:');
        array_push($arrayName,$row_s[3]);
        array_push($arrayName,$row_u[3]);
        array_push($arrayName,'FECHA:');
        array_push($arrayName,$row_s[4]);

        $arrayfill  = array(1,0,1,0,1,0,1,0,1,1,0);

        $arrayA = array(0,2,5,7,11,13,15,18,21,24,26);
        $arrayB = array(1,2,1,3,1,1,2,2,2,1,2);

        foreach ($arrayName as $key => $value) {
            $valor = ($arrayfill[$key] == 1) ? $titulo_cuatro : $titulo_tres;
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],4,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(4)->setRowHeight(20);

        }

        $arrayCurso = array("APELLIDOS Y NOMBRES","MG");
        $arrayA = array(0,10);
        $arrayB = array(9,0);
        $valor = 8;
        foreach ($rs_c as $row_c) {
            $valor+=3;
            array_push($arrayCurso,$row_c[3]);
            array_push($arrayA,$valor);
            array_push($arrayB,2);
        }
        array_push($arrayCurso,"PROMEDIO");
        array_push($arrayA,$valor+3);
        array_push($arrayB,2);

        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn(0)->setWidth(11);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn(1)->setWidth(42);
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn(2)->setWidth(10);


        for ($c=0; $c < 50; $c++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn($c)->setWidth(5);
        }

        foreach ($arrayCurso as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6))->applyFromArray($titulo_cuatro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],6,$value);
        }


        /////////////////////////
        // LISTA DE ESTUDIANTE //
        /////////////////////////

        $cv = 7;
        $mg = 0;
        foreach($rs_e as $rows){
            $mg++;
            $ch = $ca = 11;
            $cb = 11;

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(0,9,$cv,$cv+2))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(0,9,$cv,$cv+2));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,$cv,$rows[5]." ".$rows[4]."\n".$rows[6]." ".$rows[7]." ".$rows[8]);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(10,10,$cv,$cv+2))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(10,10,$cv,$cv+2));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(10,$cv,$mg.'°');

            $cont = 0;
            for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {
                $cont++;

                $valor_nota = $rows[$u];
                $valor_porc = $rows[$u-1];

                $suma_nota[$u] += $valor_nota;
                $suma_proc[$u-1] += $valor_porc;

                if ($rows[$u] <= 10) {
                    $color = $celda_uno;
                }elseif ($rows[$u]>=11 && $rows[$u]<=17){
                    $color = $celda_dos;
                } elseif ($rows[$u]>=18 && $rows[$u]<= 20){
                    $color = $celda_tres;
                }

                $ca+=3;

                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca-1,$cv))->applyFromArray($color);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca-1,$cv));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv,$valor_nota);

                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca-1,$cv+1))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca-1,$cv+1));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv+1, $valor_porc.'%');

                $ch+=3;
            }

            for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {

                $suma_buena[$j] += $rows[$j];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j]);
                $cb +=1;

                $suma_mala[$j+1] += $rows[$j+1];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+1]);
                $cb +=1;

                $suma_blanco[$j+2] += $rows[$j+2];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+2]);
                $cb +=1;
            }


            // /////////////////////////
            // // PROMEDIO POR ALUMNO //
            // /////////////////////////

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca+2,$cv))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca+2,$cv));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv,round($rows[$inicioTotalCalificacion+4]/$cont,2));

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca+2,$cv+1))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca+2,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv+1,$rows[$inicioTotalCalificacion+3].'%');

            for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {

                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j]);
                $cb +=1;

                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+1]);
                $cb +=1;

                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+2]);
                $cb +=1;
            }

            $cv+=3;
        }

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(0,9,$cv,$cv+2))->applyFromArray($titulo_tres);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(0,9,$cv,$cv+2));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,$cv,"");

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(10,10,$cv,$cv+2))->applyFromArray($titulo_tres);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(10,10,$cv,$cv+2));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(10,$cv,"");

        $prom_suma = $prom_porc = 0;
        $ch = $ca = 11;

        for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {

            $prom_suma += ($suma_nota[$u]/$mg);
            $prom_porc += ($suma_proc[$u-1]/$mg);

            $ca+=3;

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca-1,$cv))->applyFromArray($celda_cuadro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca-1,$cv));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv, round($suma_nota[$u]/$mg,2));

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca-1,$cv+1))->applyFromArray($celda_cuadro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca-1,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv+1, round($suma_proc[$u-1]/$mg).'%');

            $ch+=3;
        }

        $cb = 11;

        for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {
            $prom_buena += round($suma_buena[$j]/$mg,2);
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_cuadro);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($suma_buena[$j]/$mg));
            $cb +=1;

            $prom_mala += round($suma_mala[$j+1]/$mg,2);
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_cuadro);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($suma_mala[$j+1]/$mg));
            $cb +=1;

            $prom_blanco += round($suma_blanco[$j+2]/$mg,2);
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_cuadro);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($suma_blanco[$j+2]/$mg));
            $cb +=1;
        }

        ////////////////////////
        // RESULTADOS FINALES //
        ////////////////////////

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca+2,$cv))->applyFromArray($celda_quinto);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca+2,$cv));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv, round($prom_suma/$cont,2));

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($ch,$ca+2,$cv+1))->applyFromArray($celda_quinto);
        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($ch,$ca+2,$cv+1));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($ch,$cv+1, round($prom_porc/$cont).'%');


        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_quinto);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($prom_buena));
        $cb +=1;

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_quinto);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($prom_mala));
        $cb +=1;

        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($celda_quinto);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv+2,round($prom_blanco));
        $cb +=1;


        $nombreArchivo = "reporte_eta_grupo.xlsx";
        require_once ROOT_EXCEL.'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($_SERVER['DOCUMENT_ROOT']."/EVA/view/core/report/archive/".$nombreArchivo);
        sistema::imprimir(utf8_decode($nombreArchivo));
    }

    function reporte_eta_estudiante($data)
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_EXCEL.'PHPConfig.php';

        list($estudiante,$unidad) = $data;

        $row_i = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_e = gestorEstudiante::set_estudiante($estudiante);
        $row_f = gestorFicha::set_fichaEstudiante($estudiante);

        list( $idGrado, $nombreGrado)     = GestorGrado::set_grado($row_f[4]);
        list( $idSeccion, $nombreSeccion) = GestorSeccion::set_seccion($row_f[5]);
        list( $idNivel, $nombreNivel)     = GestorNivel::set_nivel($row_f[6]);

        $rs_c = gestorCursoEta::get_eta_curso(array($_SESSION['anio'][0],ETA));

        $positionInExcel=-1;
        foreach ($unidad as $value) {
            $a = 0;
            $positionInExcel++;

             //Loque mencionaste
            $objPHPExcel->createSheet($positionInExcel);

            $objPHPExcel->setActiveSheetIndex($positionInExcel);

            $data1 = array($row_f[7],$_SESSION['colegio'][0],$_SESSION['anio'][0],$value);
            $row_u = gestorPeriodo::set_periodo(array($value,$_SESSION['anio'][0]));
            $row_s = gestorSemana::get_semana_periodo($value);
            $rs_e  = gestorRegistroEta::get_eta_calificacion_estudiante($data1,ETA_TABLA);

            $r_eta        = gestorRegistroEta::get_eta_configuracion(ETA);
            $CantCampo    = gestorRegistroEta::get_registro_campos(ETA_TABLA);
            $CantPregunta = $r_eta[2];
            $CantUsuario  = $r_eta[3];
            $CantDetalle  = $r_eta[4];

            $inicioRespuestaCorrecta = $CantUsuario + $CantPregunta + $CantDetalle;
            $inicioTotalCalificacion = $CantUsuario + $CantPregunta;

            $rangeCeldauno   = cellsToMergeByColsRow(0, 30, 1);
            $rangeCeldados   = cellsToMergeByColsRow(0, 30, 2);

            $objPHPExcel->getActiveSheet($positionInExcel)->setTitle('SEM '.$value); #-- Nombre de la de la hoja de Excel

            $objPHPExcel->getActiveSheet($positionInExcel)->getStyle($rangeCeldauno)->applyFromArray($titulo_uno);
            $objPHPExcel->getActiveSheet($positionInExcel)->mergeCells($rangeCeldauno);
            $objPHPExcel->getActiveSheet($positionInExcel)->getRowDimension(1)->setRowHeight(40);
            $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow(0,1, 'REPORTE ETA POR ESTUDIANTE');

            $objPHPExcel->getActiveSheet($positionInExcel)->getStyle($rangeCeldados)->applyFromArray($titulo_dos);
            $objPHPExcel->getActiveSheet($positionInExcel)->mergeCells($rangeCeldados);
            $objPHPExcel->getActiveSheet($positionInExcel)->getRowDimension(2)->setRowHeight(25);
            $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow(0,2, $row_i[5]." ".$row_i[1]);

            $arrayName = array();
            array_push($arrayName,'ESTUDIANTE:');
            array_push($arrayName,$row_e[3]." ".$row_e[4]." ".$row_e[5]);
            array_push($arrayName,'CODIGO:');
            array_push($arrayName,$row_f[7]);
            array_push($arrayName,'GRADO:');
            array_push($arrayName,$nombreGrado);
            array_push($arrayName,'SECCION:');
            array_push($arrayName,$nombreSeccion);
            array_push($arrayName,'NIVEL:');
            array_push($arrayName,$nombreNivel);
            array_push($arrayName,$row_u[3]);

            $arrayfill  = array(1,0,1,0,1,0,1,0,1,0,1,0,1);

            $arrayA = array(0,3,13,15,17,19,21,23,25,27,30);
            $arrayB = array(2,9,1,1,1,1,1,1,1,2,2);

            foreach ($arrayName as $key => $value) {
                $valor = ($arrayfill[$key] == 1) ? $titulo_cuatro : $titulo_tres;
                $objPHPExcel->getActiveSheet($positionInExcel)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4))->applyFromArray($valor);
                $objPHPExcel->getActiveSheet($positionInExcel)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4));
                $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow($arrayA[$key],4,$value);
                $objPHPExcel->getActiveSheet($positionInExcel)->getRowDimension(4)->setRowHeight(20);
            }

            $arrayCurso = array("N°","ETA","MG");
            $arrayA = array(0,1,4);
            $arrayB = array(0,2,0);
            $i = 2;
            foreach ($rs_c as $row_c) {
                $i+=3;
                array_push($arrayCurso,$row_c[3]);
                array_push($arrayA,$i);
                array_push($arrayB,2);
            }
            array_push($arrayCurso,"PROMEDIO");
            array_push($arrayA,$i+3);
            array_push($arrayB,2);

            $objPHPExcel->setActiveSheetIndex($positionInExcel)->getColumnDimensionByColumn(0)->setWidth(15);
            $objPHPExcel->setActiveSheetIndex($positionInExcel)->getColumnDimensionByColumn(1)->setWidth(42);
            $objPHPExcel->setActiveSheetIndex($positionInExcel)->getColumnDimensionByColumn(2)->setWidth(10);


            for ($c=0; $c < 50; $c++) {
                $objPHPExcel->setActiveSheetIndex($positionInExcel)->getColumnDimensionByColumn($c)->setWidth(5);
            }

            foreach ($arrayCurso as $key => $value) {
                $objPHPExcel->getActiveSheet($positionInExcel)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6))->applyFromArray($titulo_cuatro);
                $objPHPExcel->getActiveSheet($positionInExcel)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6));
                $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow($arrayA[$key],6,$value);
            }


            // LISTA DE ESTUDIANTE
            $suma_nota = $suma_proc = array();
            $cv = 7;
            $mg = 0;
            $color = $valor_nota = $valor_por = '';
            foreach($rs_e as $rows){

                $mg++;
                $ch = $ca = 5;
                $cb = 5;

                $row_s = gestorSemana::get_semana_registro($rows[1]);

                $objPHPExcel->getActiveSheet($positionInExcel)->getStyle(cellsToMergeByRowCols(0,0,$cv,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet($positionInExcel)->mergeCells(cellsToMergeByRowCols(0,0,$cv,$cv+2));
                $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow(0,$cv,$row_s[0]);

                $objPHPExcel->getActiveSheet($positionInExcel)->getStyle(cellsToMergeByRowCols(1,3,$cv,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet($positionInExcel)->mergeCells(cellsToMergeByRowCols(1,3,$cv,$cv+2));
                $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow(1,$cv,$row_s[3]);

                $objPHPExcel->getActiveSheet($positionInExcel)->getStyle(cellsToMergeByRowCols(4,4,$cv,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet($positionInExcel)->mergeCells(cellsToMergeByRowCols(4,4,$cv,$cv+2));
                $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow(4,$cv,$mg.'°');

                $cont = 0;
                for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {
                    $cont++;

                    $valor_nota = $rows[$u];
                    $valor_porc = $rows[$u-1];

                    $suma_nota[$u] += $valor_nota;
                    $suma_proc[$u-1] += $valor_porc;

                    if ($valor_nota <= 10) {
                        $color = $celda_uno;
                    }elseif ($valor_nota>=11 && $valor_nota<=17){
                        $color = $celda_dos;
                    } elseif ($valor_nota>=18 && $valor_nota<= 20){
                        $color = $celda_tres;
                    } else {
                        $color = $celda_uno;
                    }


                    $ca+=3;

                    $objPHPExcel->getActiveSheet($positionInExcel)->getStyle(cellsToMergeByColsRow($ch,$ca-1,$cv))->applyFromArray($color);
                    $objPHPExcel->getActiveSheet($positionInExcel)->mergeCells(cellsToMergeByColsRow($ch,$ca-1,$cv));
                    $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow($ch,$cv,$valor_nota);

                    $objPHPExcel->getActiveSheet($positionInExcel)->getStyle(cellsToMergeByColsRow($ch,$ca-1,$cv+1))->applyFromArray($titulo_tres);
                    $objPHPExcel->getActiveSheet($positionInExcel)->mergeCells(cellsToMergeByColsRow($ch,$ca-1,$cv+1));
                    $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow($ch,$cv+1, $valor_porc.'%');

                    $ch+=3;
                }

                for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {
                    $suma_buena[$j] += $rows[$j];
                    $objPHPExcel->getActiveSheet($positionInExcel)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                    $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j]);
                    $cb +=1;

                    $suma_mala[$j+1] += $rows[$j+1];
                    $objPHPExcel->getActiveSheet($positionInExcel)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                    $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+1]);
                    $cb +=1;

                    $suma_blanco[$j+2] += $rows[$j+2];
                    $objPHPExcel->getActiveSheet($positionInExcel)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                    $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+2]);
                    $cb +=1;
                }


                //////////////////////
                // PROMEDIO POR ETA //
                //////////////////////


                $objPHPExcel->getActiveSheet($positionInExcel)->getStyle(cellsToMergeByColsRow($ch,$ca+2,$cv))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet($positionInExcel)->mergeCells(cellsToMergeByColsRow($ch,$ca+2,$cv));
                $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow($ch,$cv,round($rows[$inicioTotalCalificacion+4]/$cont,2));

                $objPHPExcel->getActiveSheet($positionInExcel)->getStyle(cellsToMergeByColsRow($ch,$ca+2,$cv+1))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet($positionInExcel)->mergeCells(cellsToMergeByColsRow($ch,$ca+2,$cv+1));
                $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow($ch,$cv+1,$rows[$inicioTotalCalificacion+3].'%');

                for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {

                    $objPHPExcel->getActiveSheet($positionInExcel)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                    $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j]);
                    $cb +=1;

                    $objPHPExcel->getActiveSheet($positionInExcel)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                    $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+1]);
                    $cb +=1;

                    $objPHPExcel->getActiveSheet($positionInExcel)->getStyle(cellsToMergeByCols($cb,$cv+2))->applyFromArray($titulo_tres);
                    $objPHPExcel->setActiveSheetIndex($positionInExcel)->setCellValueByColumnAndRow($cb,$cv+2,$rows[$j+2]);
                    $cb +=1;
                }

                $cv+=3;

           }

        }

        $nombreArchivo = "reporte_eta_estudiante.xlsx";
        require_once ROOT_EXCEL.'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($_SERVER['DOCUMENT_ROOT']."/EVA/view/core/report/archive/".$nombreArchivo);
        sistema::imprimir(utf8_decode($nombreArchivo));
    }

    function reporte_eta_porcental($data)
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_EXCEL.'PHPConfig.php';

        list($unidad,$semana) = $data;

        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
        $row_s = gestorSemana::set_semana($semana);

        list( $idGrado, $nombreGrado)     = GestorGrado::set_grado($_SESSION['tutor']['grado']);
        list( $idSeccion, $nombreSeccion) = GestorSeccion::set_seccion($_SESSION['tutor']['seccion']);
        list( $idNivel, $nombreNivel)     = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $data1 = array($_SESSION['tutor']['grado'],$_SESSION['tutor']['seccion'],$_SESSION['tutor']['nivel'],$_SESSION['colegio'][0],$_SESSION['anio'][0],$semana);

        $row_v = gestorRespuestaEta::get_eta_respuesta($data1,ETA_RESPUESTA);
        $row_r = gestorRegistroEta::get_eta_registro($data1);
        $row_t = gestorTutor::get_eta_tutor($data1);
        $rs_c  = gestorCursoEta::get_eta_curso(array($_SESSION['anio'][0],ETA));

        $nombreTutor = $row_t[3]." ".$row_t[4]." ".$row_t[5];

        $rangeCeldauno   = cellsToMergeByColsRow(0, 30, 1);
        $rangeCeldados   = cellsToMergeByColsRow(0, 30, 2);

        $objPHPExcel->getActiveSheet(0)->setTitle('reporte_porcentil'); #-- Nombre de la de la hoja de Excel

        for ($c=0; $c < 50; $c++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn($c)->setWidth(5);
        }

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldauno)->applyFromArray($titulo_uno);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldauno);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(40);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,1, 'REPORTE CUADRO PORCENTUAL DE RESPUESTAS');

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldados)->applyFromArray($titulo_dos);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldados);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(2)->setRowHeight(25);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,2, $row_c[5]." ".$row_c[1]);

        $arrayName = array();
        array_push($arrayName,'TUTOR:');
        array_push($arrayName,$nombreTutor );
        array_push($arrayName,'GRADO:');
        array_push($arrayName,$nombreGrado);
        array_push($arrayName,'SECCION:');
        array_push($arrayName,$nombreSeccion);
        array_push($arrayName,'NIVEL:');
        array_push($arrayName,$nombreNivel);
        array_push($arrayName,'EVALUACIÓN:');
        array_push($arrayName,$row_s[3]);
        array_push($arrayName,$row_u[3]);
        array_push($arrayName,'FECHA:');
        array_push($arrayName,$row_r[7]);

        $arrayfill  = array(1,0,1,0,1,0,1,0,1,0,1,1,0);

        $arrayA = array(0,2,11,14,16,19,21,24,27,31,34,37,40);
        $arrayB = array(1,8,2,1,2,1,2,2,3,2,2,2,2);

        foreach ($arrayName as $key => $value) {
            $valor = ($arrayfill[$key] == 1) ? $titulo_cuatro : $titulo_tres;
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],4,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(4)->setRowHeight(20);

        }


        $arrayName  = array('N°','CURSO','A','B','C','D','E','BLAN','ANUL','N°','CURSO','A','B','C','D','E','BLAN','ANUL');
        $arrayValue = array('A','B','C','D','E','BLAN','ANUL');

        #COLUMNA 1
        $arrayA = array(0,2,7,9,11,13,15,17,19,22,24,29,31,33,35,37,39,41);
        $arrayB = array(1,4,1,1,1,1,1,1,1,1,4,1,1,1,1,1,1,1);

        foreach ($arrayName as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6))->applyFromArray($titulo_cuatro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],6,$value);
        }

        $cv = 7;
        $nroRespuesta = 4;

        $valor = (ETA == 1) ? 4 : 9;

        $n = 0 ;
        foreach ($rs_c as $row_c) {

            if($row_c[0] <= $valor){

                $cursoEta = gestorCursoEta::set_eta_curso_configuracion(array($_SESSION['anio'][0],$row_c[1],ETA));

                for ($r=1; $r <= $cursoEta[4]; $r++) {
                    $n++;

                    $respuesta = $row_v[$nroRespuesta];
                    $row_p = gestorRespuestaEta::get_eta_porcentaje(array($row_v[1],$_SESSION['anio'][0],$n),ETA_RESPUESTA,ETA_TABLA);
                    $mayor = max($row_p[0],$row_p[1],$row_p[2],$row_p[3],$row_p[4],$row_p[5],$row_p[6]);

                    $arrayA     = array(0,2);
                    $arrayB     = array(1,4);
                    $arrayCurso = array($n,$row_c[2]);
                    $arrayFill  = array($option_cuatro,$option_cuatro);

                    $i = 5;
                    $k = 0;

                    foreach ($arrayValue as $value) {
                        $i+=2;

                        if($row_p[$k] == $mayor and $value == $respuesta) {
                            $valor_color = $option_tres;
                        } else if ($respuesta == $value) {
                            $valor_color = $option_uno;
                        } else if ($row_p[$k] == $mayor) {
                            $valor_color = $option_dos;
                        } else{
                            $valor_color = $option_cuatro;
                        }

                        array_push($arrayA,$i);
                        array_push($arrayB,1);
                        array_push($arrayCurso,$row_p[$k].'%');
                        array_push($arrayFill,$valor_color);

                        $k++;
                    }

                    $x = 0;
                    foreach ($arrayCurso as $key => $value) {
                        $x++;
                        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],$cv))->applyFromArray($arrayFill[$key]);
                        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],$cv));
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],$cv,$arrayCurso[$key]);
                        $objPHPExcel->getActiveSheet(0)->getRowDimension($cv)->setRowHeight(36);
                        $x++;
                    }

                    $cv+=1;

                    $nroRespuesta++;
                }

            }else{

                $cursoEta = gestorCursoEta::set_eta_curso_configuracion(array($_SESSION['anio'][0],$row_c[1],ETA));

                $valor = (ETA == 1) ? 6 : 11;
                $cv = ($row_c[0] <= $valor) ? 7 : $cv;

                for ($r=1; $r <= $cursoEta[4]; $r++) {
                    $n++;

                    $respuesta = $row_v[$nroRespuesta];
                    $row_p = gestorRespuestaEta::get_eta_porcentaje(array($row_v[1],$_SESSION['anio'][0],$n),ETA_RESPUESTA,ETA_TABLA);
                    $mayor = max($row_p[0],$row_p[1],$row_p[2],$row_p[3],$row_p[4],$row_p[5],$row_p[6]);

                    $arrayA     = array(22,24);
                    $arrayB     = array(1,4);
                    $arrayCurso = array($n,$row_c[2]);
                    $arrayFill  = array($option_cuatro,$option_cuatro);

                    $i = 27;
                    $k = 0;

                    foreach ($arrayValue as $value) {
                        $i+=2;

                        if($row_p[$k] == $mayor and $value == $respuesta) {
                            $valor_color = $option_tres;
                        } else if ($respuesta == $value) {
                            $valor_color = $option_uno;
                        } else if ($row_p[$k] == $mayor) {
                            $valor_color = $option_dos;
                        } else{
                            $valor_color = $option_cuatro;
                        }

                        array_push($arrayA,$i);
                        array_push($arrayB,1);
                        array_push($arrayCurso,$row_p[$k].'%');
                        array_push($arrayFill,$valor_color);

                        $k++;
                    }

                    foreach ($arrayCurso as $key => $value) {
                        $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],$cv))->applyFromArray($arrayFill[$key]);
                        $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],$cv));
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],$cv,$arrayCurso[$key]);
                        $objPHPExcel->getActiveSheet(0)->getRowDimension($cv)->setRowHeight(36);
                    }

                    $cv+=1;

                    $nroRespuesta++;
                }
            }

        }
        // LISTA DE ESTUDIANTE

        $nombreArchivo = "reporte_eta_porcental.xlsx";
        require_once ROOT_EXCEL.'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($_SERVER['DOCUMENT_ROOT']."/EVA/view/core/report/archive/".$nombreArchivo);
        sistema::imprimir(utf8_decode($nombreArchivo));
    }

    function reporte_merito_aula($data)
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_EXCEL.'PHPConfig.php';

        list($unidad,$semana,$cantidad) = $data;

        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
        $row_s = gestorSemana::set_semana($semana);

        list( $idGrado, $nombreGrado)     = GestorGrado::set_grado($_SESSION['tutor']['grado']);
        list( $idSeccion, $nombreSeccion) = GestorSeccion::set_seccion($_SESSION['tutor']['seccion']);
        list( $idNivel, $nombreNivel)     = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $data1 = array($_SESSION['tutor']['grado'],$_SESSION['tutor']['seccion'],$_SESSION['tutor']['nivel'],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_s[0]);
        $data2 = array($_SESSION['tutor']['grado'],$_SESSION['tutor']['seccion'],$_SESSION['tutor']['nivel'],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_s[0]);

        $rs_e = gestorRegistroEta::get_eta_calificacion($data1,$cantidad,ETA_TABLA);
        $row_r = gestorRegistroEta::get_eta_registro($data2);
        $row_t = gestorTutor::get_eta_tutor($data1);

        $nombreTutor = $nombreTutor = $row_t[3]." ".$row_t[4]." ".$row_t[5];

        $rangeCeldauno   = cellsToMergeByColsRow(0, 30, 1);
        $rangeCeldados   = cellsToMergeByColsRow(0, 30, 2);
        $rangeCeldatres   = cellsToMergeByColsRow(0, 30, 3);

        $objPHPExcel->getActiveSheet(0)->setTitle('merito_aula'); #-- Nombre de la de la hoja de Excel

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldauno)->applyFromArray($titulo_uno);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldauno);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(40);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,1, 'MERITO GENERAL POR AULA');

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldados)->applyFromArray($titulo_dos);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldados);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(2)->setRowHeight(25);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,2,"LOS ".$cantidad." PRIMEROS PUESTOS");

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldatres)->applyFromArray($titulo_dos);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldatres);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(3)->setRowHeight(25);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,3, $row_c[5]." ".$row_c[1]);

        $arrayName = array();
        array_push($arrayName,'TUTOR:');
        array_push($arrayName,$nombreTutor);
        array_push($arrayName,'NIVEL:');
        array_push($arrayName,$nombreNivel);
        array_push($arrayName,'GRADO:');
        array_push($arrayName,$nombreGrado);
        array_push($arrayName,'SECCION:');
        array_push($arrayName,$nombreSeccion);
        array_push($arrayName,'EVALUACIÓN:');
        array_push($arrayName,$row_s[3]);
        array_push($arrayName,$row_u[3]);

        $arraySize  = array(10,42,12,15,12,12,12,12,15,12,12);
        $arrayfill  = array(1,0,1,0,1,0,1,0,1,0,1);

        $arrayA = array(0,2,7,9,12,14,16,18,20,24,27);
        $arrayB = array(1,4,1,2,1,1,1,1,3,2,2);

        foreach ($arrayName as $key => $value) {
            $valor = ($arrayfill[$key] == 1) ? $titulo_cuatro : $titulo_tres;
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],5))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],5));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],5,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(5)->setRowHeight(40);
        }

        $arrayCurso = array();
        array_push($arrayCurso,"PUESTO");
        array_push($arrayCurso,"APELLIDOS Y NOMBRES");
        array_push($arrayCurso,"PROMEDIO");

        $arrayA = array(0,2,11);
        $arrayB = array(1,8,2);

        for ($c=0; $c < 50; $c++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn($c)->setWidth(5);
        }

        foreach ($arrayCurso as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],7))->applyFromArray($titulo_cuatro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],7));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],7,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(7)->setRowHeight(30);
        }

        $cv = 8;
        $mg=0;
        $rcurso = count(gestorCursoEta::get_eta_curso(array($_SESSION['anio'][0],ETA)));
        foreach($rs_e as $rows){
            $mg++;

            $valor = ($mg%2 == 0) ? $titulo_cuatro : $titulo_tres;

            $u = (ETA == 1) ? 53 : 44;

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow(0,1,$cv))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow(0,1,$cv));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,$cv,$mg.'°');
            $objPHPExcel->getActiveSheet(0)->getRowDimension($cv)->setRowHeight(35);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow(2,10,$cv))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow(2,10,$cv));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2,$cv,$rows[4]." ".$rows[5]);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow(11,13,$cv))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow(11,13,$cv));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(11,$cv,round($rows[$u]/$rcurso,2)." ( ".$rows[$u-1]."% )");

            $cv+=1;
        }

        $nombreArchivo = "reporte_eta_merito.xlsx";
        require_once ROOT_EXCEL.'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($_SERVER['DOCUMENT_ROOT']."/EVA/view/core/report/archive/".$nombreArchivo);
        sistema::imprimir(utf8_decode($nombreArchivo));
    }

    function reporte_merito_grado($data)
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_EXCEL.'PHPConfig.php';

        list($unidad,$semana,$cantidad) = $data;

        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
        $row_s = gestorSemana::set_semana($semana);

        list( $idGrado, $nombreGrado)     = GestorGrado::set_grado($_SESSION['tutor']['grado']);
        list( $idNivel, $nombreNivel)     = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $nombreTutor = $nombreSeccion = $fecha = array();

        $data1 = array($idGrado,$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_s[0]);
        $data2 = array($idGrado,$_SESSION['anio'][0]);

        $rs_e = gestorRegistroEta::get_eta_calificacion_grado($data1,$cantidad,ETA_TABLA);
        $rs_r = gestorRegistroEta::get_eta_grupo_grado($data2);
        $rs_t = gestorTutor::get_eta_tutor_grado($data1);

        foreach ($rs_t as $row_t) {

            array_push($nombreTutor, $row_t[3]." ".$row_t[4]." ".$row_t[5]);
        }

        foreach ($rs_r as $row_r) {
            $rows = GestorSeccion::set_seccion($row_r[3]);
            array_push($nombreSeccion,$rows[1]);
        }

        $rangeCeldauno   = cellsToMergeByColsRow(0, 30, 1);
        $rangeCeldados   = cellsToMergeByColsRow(0, 30, 2);
        $rangeCeldatres   = cellsToMergeByColsRow(0, 30, 3);

        $objPHPExcel->getActiveSheet(0)->setTitle('merito_grado'); #-- Nombre de la de la hoja de Excel

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldauno)->applyFromArray($titulo_uno);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldauno);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(40);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,1, 'MERITO GENERAL POR GRADO');

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldados)->applyFromArray($titulo_dos);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldados);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(2)->setRowHeight(25);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,2,"LOS ".$cantidad." PRIMEROS PUESTOS");

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldatres)->applyFromArray($titulo_dos);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldatres);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(3)->setRowHeight(25);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,3, $row_c[5]." ".$row_c[1]);

        $arrayName = array();
        array_push($arrayName,'TUTORES:');
        array_push($arrayName,$nombreTutor[0]."\n".$nombreTutor[1]);
        array_push($arrayName,'NIVEL:');
        array_push($arrayName,$nombreNivel);
        array_push($arrayName,'GRADO:');
        array_push($arrayName,$nombreGrado);
        array_push($arrayName,'SECCION:');
        array_push($arrayName,$nombreSeccion[0]." | ".$nombreSeccion[1]);
        array_push($arrayName,'EVALUACIÓN:');
        array_push($arrayName,$row_s[3]);
        array_push($arrayName,$row_u[3]);

        $arraySize  = array(10,42,12,15,12,12,12,12,15,12,12);
        $arrayfill  = array(1,0,1,0,1,0,1,0,1,0,1,);

        $arrayA = array(0,3,10,12,15,17,19,21,23,27,30);
        $arrayB = array(2,6,1,2,1,1,1,1,3,2,2);

        foreach ($arrayName as $key => $value) {
            $valor = ($arrayfill[$key] == 1) ? $titulo_cuatro : $titulo_tres;
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],5))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],5));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],5,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(5)->setRowHeight(40);
        }

        $arrayCurso = array();
        array_push($arrayCurso,"PUESTO");
        array_push($arrayCurso,"APELLIDOS Y NOMBRES");
        array_push($arrayCurso,"PROMEDIO");

        $arrayA = array(0,2,11);
        $arrayB = array(1,8,2);

        for ($c=0; $c < 50; $c++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn($c)->setWidth(5);
        }

        foreach ($arrayCurso as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],7))->applyFromArray($titulo_cuatro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],7));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],7,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(7)->setRowHeight(30);
        }

        $cv = 8;
        $mg=0;
        $rcurso = count(gestorCursoEta::get_eta_curso(array($_SESSION['anio'][0],ETA)));
        foreach($rs_e as $rows){
            $mg++;

            $valor = ($mg%2 == 0) ? $titulo_cuatro : $titulo_tres;
            $u = (ETA == 1) ? 53 : 44;

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow(0,1,$cv))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow(0,1,$cv));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,$cv,$mg.'°');
            $objPHPExcel->getActiveSheet(0)->getRowDimension($cv)->setRowHeight(35);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow(2,10,$cv))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow(2,10,$cv));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2,$cv,$rows[4]." ".$rows[5]."\n".$rows[6]." ".$rows[7]." ".$rows[8]);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow(11,13,$cv))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow(11,13,$cv));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(11,$cv,round($rows[$u]/$rcurso,2)." ( ".$rows[$u-1]."% )");

            $cv+=1;
        }


        $nombreArchivo = "reporte_eta_merito.xlsx";
        require_once ROOT_EXCEL.'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($_SERVER['DOCUMENT_ROOT']."/EVA/view/core/report/archive/".$nombreArchivo);
        sistema::imprimir(utf8_decode($nombreArchivo));
    }

    function reporte_merito_grupo($data)
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_EXCEL.'PHPConfig.php';

        list($unidad,$semana,$cantidad,$grupo) = $data;

        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
        $row_s = gestorSemana::set_semana($semana);

        list( $idNivel, $nombreNivel, $abrvNivel) = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $nombreSeccion = $nombreGrado = array();

        $data1 = array($grupo,$_SESSION['colegio'][0],$_SESSION['anio'][0],$semana);
        $data2 = array($grupo,$_SESSION['anio'][0]);

        $rs_e = gestorRegistroEta::get_eta_calificacion_grupo($data1,$cantidad,ETA_TABLA);
        $rs_r = gestorRegistroEta::get_eta_grupo($data2);

        foreach ($rs_r as $row_r) {

            $rows1 = GestorGrado::set_grado($row_r[2]);
            $rows2 = GestorSeccion::set_seccion($row_r[3]);

            array_push($nombreGrado,$rows1[1]);
            array_push($nombreSeccion,$rows2[1]);
        }

        $rangeCeldauno   = cellsToMergeByColsRow(0, 30, 1);
        $rangeCeldados   = cellsToMergeByColsRow(0, 30, 2);
        $rangeCeldatres   = cellsToMergeByColsRow(0, 30, 3);

        $objPHPExcel->getActiveSheet(0)->setTitle('merito_grupo'); #-- Nombre de la de la hoja de Excel

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldauno)->applyFromArray($titulo_uno);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldauno);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(40);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,1, 'MERITO GENERAL POR AULA');

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldados)->applyFromArray($titulo_dos);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldados);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(2)->setRowHeight(25);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,2,"LOS ".$cantidad." PRIMEROS PUESTOS");

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldatres)->applyFromArray($titulo_dos);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldatres);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(3)->setRowHeight(25);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,3, $row_c[5]." ".$row_c[1]);

        $arrayName = array();
        array_push($arrayName,'NIVEL:');
        array_push($arrayName,$nombreNivel);
        array_push($arrayName,'GRADO:');
        array_push($arrayName,$nombreGrado[0]."|".$nombreGrado[2]."|".$nombreGrado[4]);
        array_push($arrayName,'SECCION:');
        array_push($arrayName,$nombreSeccion[0]."|".$nombreSeccion[1]);
        array_push($arrayName,'EVALUACIÓN:');
        array_push($arrayName,$row_s[3]);
        array_push($arrayName,$row_u[3]);

        $arrayfill  = array(1,0,1,0,1,0,1,0,1);

        $arrayA = array(0,2,5,7,11,13,15,19,22);
        $arrayB = array(1,2,1,3,1,1,3,2,2);

        foreach ($arrayName as $key => $value) {
            $valor = ($arrayfill[$key] == 1) ? $titulo_cuatro : $titulo_tres;
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],5))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],5));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],5,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(5)->setRowHeight(35);

        }

        $arrayCurso = array();
        array_push($arrayCurso,"PUESTO");
        array_push($arrayCurso,"APELLIDOS Y NOMBRES");
        array_push($arrayCurso,"PROMEDIO");

        $arrayA = array(0,2,11);
        $arrayB = array(1,8,2);

        for ($c=0; $c < 50; $c++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn($c)->setWidth(5);
        }

        foreach ($arrayCurso as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],7))->applyFromArray($titulo_cuatro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],7));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],7,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(7)->setRowHeight(30);
        }

        $cv = 8;
        $mg=0;
        $rcurso = count(gestorCursoEta::get_eta_curso(array($_SESSION['anio'][0],ETA)));
        foreach($rs_e as $rows){
            $mg++;

            $valor = ($mg%2 == 0) ? $titulo_cuatro : $titulo_tres;
            $u = (ETA == 1) ? 53 : 44;

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow(0,1,$cv))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow(0,1,$cv));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,$cv,$mg.'°');
            $objPHPExcel->getActiveSheet(0)->getRowDimension($cv)->setRowHeight(35);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow(2,10,$cv))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow(2,10,$cv));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2,$cv,$rows[4]." ".$rows[5]."\n".$rows[6]." ".$rows[7]." ".$rows[8]);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow(11,13,$cv))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow(11,13,$cv));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(11,$cv,round($rows[$u]/$rcurso,2)." ( ".$rows[$u-1]."% )");

            $cv+=1;
        }


        $nombreArchivo = "reporte_eta_merito.xlsx";
        require_once ROOT_EXCEL.'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($_SERVER['DOCUMENT_ROOT']."/EVA/view/core/report/archive/".$nombreArchivo);
        sistema::imprimir(utf8_decode($nombreArchivo));
    }

    function reporte_eta_semana($data)
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_EXCEL.'PHPConfig.php';

        list($unidad,$semana) = $data;

        $data1  = array($_SESSION['tutor']['grado'],$_SESSION['tutor']['seccion'],$_SESSION['tutor']['nivel'],$_SESSION['colegio'][0],$_SESSION['anio'][0]);

        list( $idGrado, $nombreGrado)     = GestorGrado::set_grado($_SESSION['tutor']['grado']);
        list( $idSeccion, $nombreSeccion) = GestorSeccion::set_seccion($_SESSION['tutor']['seccion']);
        list( $idNivel, $nombreNivel)     = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
        $row_t = gestorTutor::get_eta_tutor($data1);

        $nombreTutor = $nombreTutor = $row_t[3]." ".$row_t[4]." ".$row_t[5];

        $row_s = gestorSemana::set_semana($semana);
        $row_z = gestorSemana::set_semana($semana+1);
        $rs_e  = gestorEstudiante::get_estudiante_reporte($data1);

        $rangeCeldauno   = cellsToMergeByColsRow(0, 30, 1);
        $rangeCeldados   = cellsToMergeByColsRow(0, 30, 2);

        $objPHPExcel->getActiveSheet(0)->setTitle('reporte_'); #-- Nombre de la de la hoja de Excel

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldauno)->applyFromArray($titulo_uno);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldauno);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(40);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,1, 'REPORTE SÁBAMA ETA');

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldados)->applyFromArray($titulo_dos);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldados);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(2)->setRowHeight(25);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,2, $row_c[5]." ".$row_c[1]);

        $arrayName = array();
        array_push($arrayName,'TUTOR:');
        array_push($arrayName,$nombreTutor);
        array_push($arrayName,'NIVEL:');
        array_push($arrayName,$nombreNivel);
        array_push($arrayName,'GRADO:');
        array_push($arrayName,$nombreGrado);
        array_push($arrayName,'SECCION:');
        array_push($arrayName,$nombreSeccion);
        array_push($arrayName,'EVALUACIÓN:');
        array_push($arrayName,$row_s[3]);
        array_push($arrayName,$row_u[3]);

        $arraySize  = array(10,42,12,15,12,12,12,12,15,12,12);
        $arrayfill  = array(1,0,1,0,1,0,1,0,1,0,1,);

        $arrayA = array(0,2,7,9,12,14,16,18,20,24,27);
        $arrayB = array(1,4,1,2,1,1,1,1,3,2,2);

        foreach ($arrayName as $key => $value) {
            $valor = ($arrayfill[$key] == 1) ? $titulo_cuatro : $titulo_tres;
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],4,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(4)->setRowHeight(30);
        }

        for ($c=0; $c < 50; $c++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn($c)->setWidth(5);
        }

        $arrayName = array("CODIGO","APELLIDOS Y NOMBRES");
        $arrayA    = array(0,2);
        $arrayB    = array(1,5);

        $x = 5;
        $y = 8;
        $i = 1;

        array_push($arrayName,'ETA '.$row_s[0]);
        array_push($arrayA,$x+=(3*$i));
        array_push($arrayB,2);

        array_push($arrayName,'META ETA '.($row_s[0]+1));
        array_push($arrayA,$y+=(3*$i));
        array_push($arrayB,2);

        array_push($arrayA,$x+(3*$i));
        array_push($arrayB,2);
        array_push($arrayName,"ETA ".$row_z[0]);

        foreach ($arrayName as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6))->applyFromArray($titulo_cuatro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],6,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(6)->setRowHeight(30);
        }

        $a  = 0;
        $cv = 7;

        foreach ($rs_e as $row_e){
            $a++;
            $s=0;
            $suma_eta = 0;
            $rows1 = gestorEstudiante::set_estudiante($row_e[3]);
            $rows2 = gestorFicha::set_fichaEstudiante($row_e[3]);

            $valor = ($a%2 == 0) ? $titulo_tres : $titulo_cuatro;

            $arrayName = array($rows2[7],$rows1[3]." ".$rows1[4]." ".$rows1[5]);
            $arrayA    = array(0,2);
            $arrayB    = array(1,5);

            $x = 5;
            $y = 8;
            $i = 1;

            $data1 = array($rows2[7],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_s[0]);
            $data2 = array($rows2[7],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_z[0]);
            $data3 = array($rows1[0],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_s[0]);

            $rows3 = gestorRegistroEta::get_eta_calificacion_semana($data1,ETA_TABLA);
            $rows4 = gestorRegistroEta::get_eta_calificacion_semana($data2,ETA_TABLA);
            $rows5 = gestorMeta::set_meta_semana($data3);

            $valor_nota1 = empty($rows3[57]) ? 'NSP' : $rows3[57]; $s++;
            $valor_nota2 = empty($rows4[57]) ? 0 : $rows4[57];
            $valor_meta  = empty($rows5[5]) ? 0 : $rows5[5];

            array_push($arrayName,$valor_nota1);
            array_push($arrayA,$x+=(3*$i));
            array_push($arrayB,2);

            array_push($arrayName,$valor_meta);
            array_push($arrayA,$y+=(3*$i));
            array_push($arrayB,2);

            array_push($arrayA,$x+(3*$i));
            array_push($arrayB,2);
            array_push($arrayName,$valor_nota2);


            foreach ($arrayName as $key => $value) {
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],$cv))->applyFromArray($valor);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],$cv));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],$cv,$value);
                $objPHPExcel->getActiveSheet(0)->getRowDimension($cv)->setRowHeight(60);
            }

            $cv++;

        }

        $nombreArchivo = "reporte_sabana_eta.xlsx";
        require_once ROOT_EXCEL.'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($_SERVER['DOCUMENT_ROOT']."/EVA/view/core/report/archive/".$nombreArchivo);
        sistema::imprimir(utf8_decode($nombreArchivo));
    }

    function reporte_eta_sabana($data)
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_EXCEL.'PHPConfig.php';

        list($unidad,$semana) = $data;

        $data1  = array($_SESSION['tutor']['grado'],$_SESSION['tutor']['seccion'],$_SESSION['tutor']['nivel'],$_SESSION['colegio'][0],$_SESSION['anio'][0]);

        list( $idGrado, $nombreGrado)     = GestorGrado::set_grado($_SESSION['tutor']['grado']);
        list( $idSeccion, $nombreSeccion) = GestorSeccion::set_seccion($_SESSION['tutor']['seccion']);
        list( $idNivel, $nombreNivel)     = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
        $row_t = gestorTutor::get_eta_tutor($data1);

        $nombreTutor = $nombreTutor = $row_t[3]." ".$row_t[4]." ".$row_t[5];

        $rs_s  = gestorSemana::get_semanaAcademica($unidad);
        $rs_e  = gestorEstudiante::get_estudiante_reporte($data1);

        $rangeCeldauno   = cellsToMergeByColsRow(0, 30, 1);
        $rangeCeldados   = cellsToMergeByColsRow(0, 30, 2);

        $objPHPExcel->getActiveSheet(0)->setTitle('reporte_'); #-- Nombre de la de la hoja de Excel

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldauno)->applyFromArray($titulo_uno);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldauno);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(40);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,1, 'REPORTE SÁBAMA ETA');

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldados)->applyFromArray($titulo_dos);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldados);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(2)->setRowHeight(25);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,2, $row_c[5]." ".$row_c[1]);

        $arrayName = array();
        array_push($arrayName,'TUTOR:');
        array_push($arrayName,$nombreTutor);
        array_push($arrayName,'NIVEL:');
        array_push($arrayName,$nombreNivel);
        array_push($arrayName,'GRADO:');
        array_push($arrayName,$nombreGrado);
        array_push($arrayName,'SECCION:');
        array_push($arrayName,$nombreSeccion);
        array_push($arrayName,'EVALUACIÓN:');
        array_push($arrayName,$row_s[3]);
        array_push($arrayName,$row_u[3]);


        $arraySize  = array(10,42,12,15,12,12,12,12,15,12,12);
        $arrayfill  = array(1,0,1,0,1,0,1,0,1,0,1,);

        $arrayA = array(0,2,7,9,12,14,16,18,20,24,27);
        $arrayB = array(1,4,1,2,1,1,1,1,3,2,2);

        foreach ($arrayName as $key => $value) {
            $valor = ($arrayfill[$key] == 1) ? $titulo_cuatro : $titulo_tres;
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],4,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(4)->setRowHeight(30);
        }

        for ($c=0; $c < 50; $c++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn($c)->setWidth(5);
        }

        $arrayName = array("CODIGO","APELLIDOS Y NOMBRES");
        $arrayA    = array(0,2);
        $arrayB    = array(1,5);

        $x = 5;
        $y = 8;

        foreach($rs_s as $rows){
            $x+=3;
            $y=$x+3;
            array_push($arrayName,'ETA '.$rows[0]);
            array_push($arrayA,$x);
            array_push($arrayB,2);

            array_push($arrayName,'META ETA '.($rows[0]+1));
            array_push($arrayA,$y);
            array_push($arrayB,2);
            $x+=3;
        }

        array_push($arrayA,$x+3);
        array_push($arrayB,2);
        array_push($arrayName,"PROMEDIO");

        foreach ($arrayName as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6))->applyFromArray($titulo_cuatro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],6,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(6)->setRowHeight(30);
        }

        $a = 0;

        $cv = 7;

        foreach ($rs_e as $row_e){
            $a++;
            $s=0;
            $suma_eta = 0;
            $rows1 = gestorEstudiante::set_estudiante($row_e[3]);
            $rows2 = gestorFicha::set_fichaEstudiante($row_e[3]);

            $valor = ($a%2 == 0) ? $titulo_tres : $titulo_cuatro;

            $arrayName = array($rows2[7],$rows1[3]." ".$rows1[4]." ".$rows1[5]);
            $arrayA    = array(0,2);
            $arrayB    = array(1,5);

            $x = 5;
            $y = 8;
            $i = 0;

            foreach($rs_s as $row_s){
                $x+=3;
                $y=$x+3;

                $data1 = array($rows2[7],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_s[0]);
                $data2 = array($rows2[7],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_s[0]+1);
                $data3 = array($rows1[0],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_s[0]);

                $rows3 = gestorRegistroEta::get_eta_calificacion_semana($data1,ETA_TABLA);
                $rows4 = gestorRegistroEta::get_eta_calificacion_semana($data2,ETA_TABLA);
                $rows5 = gestorMeta::set_meta_semana($data3);

                $valor_nota1 = empty($rows3[57]) ? 'NSP' : $rows3[57]; $s++;
                $valor_nota2 = empty($rows4[57]) ? 0 : $rows4[57];
                $valor_meta  = empty($rows5[5]) ? 0 : $rows5[5];

                $v_nota1[$row_s[0]]   = $valor_nota1;
                $v_nota2[$row_s[0]+1] = $valor_nota2;
                $v_meta[$row_s[0]]    = $valor_meta;

                $suma_eta += $valor_nota2;

                array_push($arrayName,$valor_nota1);
                array_push($arrayA,$x);
                array_push($arrayB,2);

                array_push($arrayName,0);
                array_push($arrayA,$y);
                array_push($arrayB,2);

                $x+=3;
            }

            array_push($arrayA,$x+3);
            array_push($arrayB,2);
            array_push($arrayName,round($suma_eta/$s,2));


            foreach ($arrayName as $key => $value) {
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],$cv))->applyFromArray($valor);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],$cv));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],$cv,$value);
                $objPHPExcel->getActiveSheet(0)->getRowDimension($cv)->setRowHeight(60);
            }

            $cv++;

        }


        $nombreArchivo = "reporte_sabana_eta.xlsx";
        require_once ROOT_EXCEL.'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($_SERVER['DOCUMENT_ROOT']."/EVA/view/core/report/archive/".$nombreArchivo);
        sistema::imprimir(utf8_decode($nombreArchivo));
    }
    // ETA II

    function reporte_etas_aula($data)
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_EXCEL.'PHPConfig.php';

        list($unidad,$semana) = $data;

        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
        $row_s = gestorSemana::set_semana($semana);

        list( $idGrado, $nombreGrado)     = GestorGrado::set_grado($_SESSION['tutor']['grado']);
        list( $idNivel, $nombreNivel)     = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $nombreTutor = $nombreSeccion = array();

        $data1 = array($idGrado,$_SESSION['colegio'][0],$_SESSION['anio'][0],$semana);
        $data2 = array($idGrado,$_SESSION['anio'][0]);

        $rs_e = gestorRegistroEta::get_eta_calificacion_grado($data1,0,ETA_TABLA);
        $rs_r = gestorRegistroEta::get_eta_grupo_grado($data2);
        $rs_t = gestorTutor::get_eta_tutor_grado($data1);

        foreach ($rs_t as $row_t) {
            array_push($nombreTutor, $row_t[3]." ".$row_t[4]." ".$row_t[5]);
        }

        foreach ($rs_r as $row_r) {
            $rows = GestorSeccion::set_seccion($row_r[3]);
            array_push($nombreSeccion,$rows[1]);
        }

        $r_eta        = gestorRegistroEta::get_eta_configuracion(ETA);
        $CantCampo    = gestorRegistroEta::get_registro_campos(ETA_TABLA);
        $CantPregunta = $r_eta[2];
        $CantUsuario  = $r_eta[3];
        $CantDetalle  = $r_eta[4];


        $inicioRespuestaCorrecta = $CantUsuario + $CantPregunta + $CantDetalle;
        $inicioTotalCalificacion = $CantUsuario + $CantPregunta;

        $mg=1;

        $rangeCeldauno   = cellsToMergeByColsRow(0, 30, 1);
        $rangeCeldados   = cellsToMergeByColsRow(0, 30, 2);

        $objPHPExcel->getActiveSheet(0)->setTitle('reporte_aula'); #-- Nombre de la de la hoja de Excel

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldauno)->applyFromArray($titulo_uno);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldauno);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(40);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,1, 'REPORTE ETA POR AULA');

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldados)->applyFromArray($titulo_dos);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldados);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(2)->setRowHeight(25);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,2, $row_c[5]." ".$row_c[1]);

        $arrayName = array();
        array_push($arrayName,'TUTOR:');
        array_push($arrayName,$nombreTutor);
        array_push($arrayName,'NIVEL:');
        array_push($arrayName,$nombreNivel);
        array_push($arrayName,'GRADO:');
        array_push($arrayName,$nombreGrado);
        array_push($arrayName,'SECCION:');
        array_push($arrayName,$nombreSeccion);
        array_push($arrayName,'EVALUACIÓN:');
        array_push($arrayName,$row_s[3]);
        array_push($arrayName,$row_u[3]);

        $arrayfill = array(1,0,1,0,1,0,1,0,1,0,1,);

        $arrayA = array(0,2,10,12,15,17,19,21,23,26,29,);
        $arrayB = array(1,7,1,2,1,1,1,1,2,2,2);

        foreach ($arrayName as $key => $value) {
            $valor = ($arrayfill[$key] == 1) ? $titulo_cuatro : $titulo_tres;
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],4,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(4)->setRowHeight(20);
        }

        for ($c=0; $c < 33; $c++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn($c)->setWidth(5);
        }

        $arrayCurso = array();
        array_push($arrayCurso,"CODIGO");
        array_push($arrayCurso,"APELLIDOS Y NOMBRES");
        array_push($arrayCurso,"MG");
        array_push($arrayCurso,"CORRECTAS");
        array_push($arrayCurso,"INCORRECTAS");
        array_push($arrayCurso,"BLANCO");
        array_push($arrayCurso,"PORCENTAJE");
        array_push($arrayCurso,"PROMEDIO");

        $arrayA = array(0,2,10,11,14,17,20,23);
        $arrayB = array(1,7,0,2,2,2,2,2);

        foreach ($arrayCurso as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6))->applyFromArray($titulo_cuatro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],6,$value);
        }


        $cv = 7;

        $suma_nota = $suma_proc = $suma_buena = $suma_mala = $suma_blanco = 0;

        $mg = 0;

        foreach($rs_e as $rows){
            $mg++;
            $ch = $ca = 11;
            $cb = 11;

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(0,1,$cv,$cv+1))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(0,1,$cv,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,$cv,$rows[3]);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(2,9,$cv,$cv+1))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(2,9,$cv,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2,$cv,$rows[4]." ".$rows[5]);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(10,10,$cv,$cv+1))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(10,10,$cv,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(10,$cv,$mg.'°');

            $cont = 0;

            for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {

                $suma_buena += $rows[$j];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($cb,$cb+2,$cv,$cv+1))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($cb,$cb+2,$cv,$cv+1));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv,$rows[$j]);
                $cb +=1;

                $suma_mala += $rows[$j+1];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($cb+2,$cb+4,$cv,$cv+1) )->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($cb+2,$cb+4,$cv,$cv+1) );
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb+2,$cv, $rows[$j+1]);
                $cb +=1;

                $suma_blanco += $rows[$j+2];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($cb+4,$cb+6,$cv,$cv+1))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($cb+4,$cb+6,$cv,$cv+1));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb+4,$cv,$rows[$j+2] );
                $cb +=1;
            }
                $suma_proc += $rows[$inicioTotalCalificacion+3];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($cb+6,$cb+8,$cv,$cv+1))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($cb+6,$cb+8,$cv,$cv+1));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb+6,$cv,$rows[$inicioTotalCalificacion+3].'%');

                $suma_nota += $rows[$inicioTotalCalificacion+4];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($cb+9,$cb+11,$cv,$cv+1))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($cb+9,$cb+11,$cv,$cv+1));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb+9,$cv, $rows[$inicioTotalCalificacion+4]);

            $cv+=2;
        }

        $arrayPromedio = array();
        array_push($arrayPromedio,"PROMEDIO");
        array_push($arrayPromedio,round($suma_buena/$mg));
        array_push($arrayPromedio,round($suma_mala/$mg));
        array_push($arrayPromedio,round($suma_blanco/$mg));
        array_push($arrayPromedio,round($suma_proc/$mg));
        array_push($arrayPromedio,round($suma_nota/$mg,2));

        $celdaA = array(0);
        $celdaB = array(10);
        $x = 8;

        foreach ($arrayPromedio as $key => $value) {
            $x+=3;
            array_push($celdaA,$x);
            array_push($celdaB,2);
        }

        foreach ($arrayPromedio as $key => $value) {

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($celdaA[$key],$celdaA[$key]+$celdaB[$key],$cv,$cv+1))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($celdaA[$key],$celdaA[$key]+$celdaB[$key],$cv,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($celdaA[$key],$cv,$value);

        }


        $nombreArchivo = "reporte_eta_aula.xlsx";
        require_once ROOT_EXCEL.'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($_SERVER['DOCUMENT_ROOT']."/EVA/view/core/report/archive/".$nombreArchivo);
        sistema::imprimir(utf8_decode($nombreArchivo));
    }

    function reporte_etas_grado($data)
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_EXCEL.'PHPConfig.php';

        list($unidad,$semana) = $data;

        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
        $row_s = gestorSemana::set_semana($semana);

        list( $idGrado, $nombreGrado)     = GestorGrado::set_grado($_SESSION['tutor']['grado']);
        list( $idNivel, $nombreNivel)     = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $nombreTutor = $nombreSeccion = array();

        $data1 = array($idGrado,$_SESSION['colegio'][0],$_SESSION['anio'][0],$semana);
        $data2 = array($idGrado,$_SESSION['anio'][0]);

        $rs_e = gestorRegistroEta::get_eta_calificacion_grado($data1,0,ETA_TABLA);
        $rs_r = gestorRegistroEta::get_eta_grupo_grado($data2);
        $rs_t = gestorTutor::get_eta_tutor_grado($data1);

        foreach ($rs_t as $row_t) {
            array_push($nombreTutor, $row_t[3]." ".$row_t[4]." ".$row_t[5]);
        }

        foreach ($rs_r as $row_r) {
            $rows = GestorSeccion::set_seccion($row_r[3]);
            array_push($nombreSeccion,$rows[1]);
        }

        $r_eta        = gestorRegistroEta::get_eta_configuracion(ETA);
        $CantCampo    = gestorRegistroEta::get_registro_campos(ETA_TABLA);
        $CantPregunta = $r_eta[2];
        $CantUsuario  = $r_eta[3];
        $CantDetalle  = $r_eta[4];


        $inicioRespuestaCorrecta = $CantUsuario + $CantPregunta + $CantDetalle;
        $inicioTotalCalificacion = $CantUsuario + $CantPregunta;

        $mg=1;

        $rangeCeldauno   = cellsToMergeByColsRow(0, 30, 1);
        $rangeCeldados   = cellsToMergeByColsRow(0, 30, 2);

        $objPHPExcel->getActiveSheet(0)->setTitle('reporte_aula'); #-- Nombre de la de la hoja de Excel

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldauno)->applyFromArray($titulo_uno);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldauno);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(40);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,1, 'REPORTE ETA POR AULA');

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldados)->applyFromArray($titulo_dos);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldados);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(2)->setRowHeight(25);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,2, $row_c[5]." ".$row_c[1]);

        $arrayName = array();
        array_push($arrayName,'TUTOR:');
        array_push($arrayName,$nombreTutor[0]." ".$nombreTutor[1]);
        array_push($arrayName,'NIVEL:');
        array_push($arrayName,$nombreNivel);
        array_push($arrayName,'GRADO:');
        array_push($arrayName,$nombreGrado);
        array_push($arrayName,'SECCION:');
        array_push($arrayName,$nombreSeccion[0]."|".$nombreSeccion[1]);
        array_push($arrayName,'EVALUACIÓN:');
        array_push($arrayName,$row_s[3]);
        array_push($arrayName,$row_u[3]);
        array_push($arrayName,'FECHA:');
        array_push($arrayName,$row_s[4]);

        $arrayfill = array(1,0,1,0,1,0,1,0,1,0,1,1,0);

        $arrayA = array(0,2,10,12,15,17,19,21,23,26,29,32,34);
        $arrayB = array(1,7,1,2,1,1,1,1,2,2,2,1,2);

        foreach ($arrayName as $key => $value) {
            $valor = ($arrayfill[$key] == 1) ? $titulo_cuatro : $titulo_tres;
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],4,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(4)->setRowHeight(35);
        }

        for ($c=0; $c < 33; $c++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn($c)->setWidth(5);
        }

        $arrayCurso = array();
        array_push($arrayCurso,"CODIGO");
        array_push($arrayCurso,"APELLIDOS Y NOMBRES");
        array_push($arrayCurso,"MG");
        array_push($arrayCurso,"SECCION");
        array_push($arrayCurso,"CORRECTAS");
        array_push($arrayCurso,"INCORRECTAS");
        array_push($arrayCurso,"BLANCO");
        array_push($arrayCurso,"PORCENTAJE");
        array_push($arrayCurso,"PROMEDIO");

        $arrayA = array(0,2,10,11,13,16,19,22,25);
        $arrayB = array(1,7,0,1,2,2,2,2,2);

        foreach ($arrayCurso as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6))->applyFromArray($titulo_cuatro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],6,$value);
        }


        $cv = 7;

        $suma_nota = $suma_proc = $suma_buena = $suma_mala = $suma_blanco = 0;

        $mg = 0;

        foreach($rs_e as $rows){
            $mg++;
            $ch = $ca = 13;
            $cb = 13;

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(0,1,$cv,$cv+1))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(0,1,$cv,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,$cv,$rows[3]);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(2,9,$cv,$cv+1))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(2,9,$cv,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2,$cv,$rows[4]." ".$rows[5]);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(10,10,$cv,$cv+1))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(10,10,$cv,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(10,$cv,$mg.'°');

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(11,12,$cv,$cv+1))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(11,12,$cv,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(11,$cv,$rows[7]);

            $cont = 0;

            for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {

                $suma_buena += $rows[$j];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($cb,$cb+2,$cv,$cv+1))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($cb,$cb+2,$cv,$cv+1));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv,$rows[$j]);
                $cb +=1;

                $suma_mala += $rows[$j+1];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($cb+2,$cb+4,$cv,$cv+1) )->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($cb+2,$cb+4,$cv,$cv+1) );
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb+2,$cv, $rows[$j+1]);
                $cb +=1;

                $suma_blanco += $rows[$j+2];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($cb+4,$cb+6,$cv,$cv+1))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($cb+4,$cb+6,$cv,$cv+1));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb+4,$cv,$rows[$j+2] );
                $cb +=1;
            }
                $suma_proc += $rows[$inicioTotalCalificacion+3];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($cb+6,$cb+8,$cv,$cv+1))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($cb+6,$cb+8,$cv,$cv+1));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb+6,$cv,$rows[$inicioTotalCalificacion+3].'%');

                $suma_nota += $rows[$inicioTotalCalificacion+4];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($cb+9,$cb+11,$cv,$cv+1))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($cb+9,$cb+11,$cv,$cv+1));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb+9,$cv, $rows[$inicioTotalCalificacion+4]);

            $cv+=2;
        }

        $arrayPromedio = array();
        array_push($arrayPromedio,"PROMEDIO");
        array_push($arrayPromedio,round($suma_buena/$mg));
        array_push($arrayPromedio,round($suma_mala/$mg));
        array_push($arrayPromedio,round($suma_blanco/$mg));
        array_push($arrayPromedio,round($suma_proc/$mg));
        array_push($arrayPromedio,round($suma_nota/$mg,2));

        $celdaA = array(0);
        $celdaB = array(12);
        $x = 10;

        foreach ($arrayPromedio as $key => $value) {
            $x+=3;
            array_push($celdaA,$x);
            array_push($celdaB,2);
        }

        foreach ($arrayPromedio as $key => $value) {

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($celdaA[$key],$celdaA[$key]+$celdaB[$key],$cv,$cv+1))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($celdaA[$key],$celdaA[$key]+$celdaB[$key],$cv,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($celdaA[$key],$cv,$value);

        }

        $nombreArchivo = "reporte_eta_grado.xlsx";
        require_once ROOT_EXCEL.'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($_SERVER['DOCUMENT_ROOT']."/EVA/view/core/report/archive/".$nombreArchivo);
        sistema::imprimir(utf8_decode($nombreArchivo));
    }

    function reporte_etas_grupo($data)
    {
        $objPHPExcel = new PHPExcel();
        include_once ROOT_EXCEL.'PHPConfig.php';

        list($unidad,$semana,$grupo) = $data;

        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
        $row_s = gestorSemana::set_semana($semana);

        list( $idNivel, $nombreNivel, $abrvNivel) = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $nombreSeccion = $nombreGrado = array();

        $data1 = array(ETA,$_SESSION['colegio'][0],$_SESSION['anio'][0],$semana);
        $data2 = array(ETA,$_SESSION['anio'][0]);

        $rs_e = gestorRegistroEta::get_eta_calificacion_grupo($data1,0,ETA_TABLA);
        $rs_r = gestorRegistroEta::get_eta_grupo($data2);

        foreach ($rs_r as $row_r) {
            $rows1 = GestorGrado::set_grado($row_r[2]);
            $rows2 = GestorSeccion::set_seccion($row_r[3]);
            array_push($nombreGrado,$rows1[1]);
            array_push($nombreSeccion,$rows2[1]);
        }


        $r_eta        = gestorRegistroEta::get_eta_configuracion(ETA);
        $CantCampo    = gestorRegistroEta::get_registro_campos(ETA_TABLA);
        $CantPregunta = $r_eta[2];
        $CantUsuario  = $r_eta[3];
        $CantDetalle  = $r_eta[4];

        $inicioRespuestaCorrecta = $CantUsuario + $CantPregunta + $CantDetalle;
        $inicioTotalCalificacion = $CantUsuario + $CantPregunta;

        $mg=1;

        $rangeCeldauno   = cellsToMergeByColsRow(0, 30, 1);
        $rangeCeldados   = cellsToMergeByColsRow(0, 30, 2);

        $objPHPExcel->getActiveSheet(0)->setTitle('reporte_aula'); #-- Nombre de la de la hoja de Excel

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldauno)->applyFromArray($titulo_uno);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldauno);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(1)->setRowHeight(40);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,1, 'REPORTE ETA POR AULA');

        $objPHPExcel->getActiveSheet(0)->getStyle($rangeCeldados)->applyFromArray($titulo_dos);
        $objPHPExcel->getActiveSheet(0)->mergeCells($rangeCeldados);
        $objPHPExcel->getActiveSheet(0)->getRowDimension(2)->setRowHeight(25);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,2, $row_c[5]." ".$row_c[1]);

        $arrayName = array();
        array_push($arrayName,'NIVEL:');
        array_push($arrayName,$nombreNivel);
        array_push($arrayName,'GRADO:');
        array_push($arrayName,$nombreGrado[0]."|".$nombreGrado[2]);
        array_push($arrayName,'SECCION:');
        array_push($arrayName,$nombreSeccion[0]."|".$nombreSeccion[1]);
        array_push($arrayName,'EVALUACIÓN:');
        array_push($arrayName,$row_s[3]);
        array_push($arrayName,$row_u[3]);

        $arrayfill = array(1,0,1,0,1,0,1,0,1);
        $arrayA    = array(0,2,5,7,10,12,14,17,20);
        $arrayB    = array(1,2,1,2,1,1,2,2,1);

        foreach ($arrayName as $key => $value) {
            $valor = ($arrayfill[$key] == 1) ? $titulo_cuatro : $titulo_tres;
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4))->applyFromArray($valor);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],4));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],4,$value);
            $objPHPExcel->getActiveSheet(0)->getRowDimension(4)->setRowHeight(20);
        }

        for ($c=0; $c < 33; $c++) {
            $objPHPExcel->setActiveSheetIndex(0)->getColumnDimensionByColumn($c)->setWidth(5);
        }

        $arrayCurso = array();
        array_push($arrayCurso,"CODIGO");
        array_push($arrayCurso,"APELLIDOS Y NOMBRES");
        array_push($arrayCurso,"MG");
        array_push($arrayCurso,"CORRECTAS");
        array_push($arrayCurso,"INCORRECTAS");
        array_push($arrayCurso,"BLANCO");
        array_push($arrayCurso,"PORCENTAJE");
        array_push($arrayCurso,"PROMEDIO");

        $arrayA = array(0,2,10,11,14,17,20,23);
        $arrayB = array(1,7,0,2,2,2,2,2);

        foreach ($arrayCurso as $key => $value) {
            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6))->applyFromArray($titulo_cuatro);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByColsRow($arrayA[$key],$arrayA[$key]+$arrayB[$key],6));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($arrayA[$key],6,$value);
        }

        $cv = 7;

        $suma_nota = $suma_proc = $suma_buena = $suma_mala = $suma_blanco = 0;

        $mg = 0;

        foreach($rs_e as $rows){
            $mg++;
            $ch = $ca = 11;
            $cb = 11;

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(0,1,$cv,$cv+2))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(0,1,$cv,$cv+2));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(0,$cv,$rows[3]);

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(2,9,$cv,$cv+2))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(2,9,$cv,$cv+2));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(2,$cv,$rows[4]." ".$rows[5]."\n ( ".$rows[6]." ".$rows[7]." ".$rows[8]." )");

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols(10,10,$cv,$cv+2))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols(10,10,$cv,$cv+2));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow(10,$cv,$mg.'°');

            $cont = 0;

            for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {

                $suma_buena += $rows[$j];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($cb,$cb+2,$cv,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($cb,$cb+2,$cv,$cv+2));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb,$cv,$rows[$j]);
                $cb +=1;

                $suma_mala += $rows[$j+1];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($cb+2,$cb+4,$cv,$cv+2) )->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($cb+2,$cb+4,$cv,$cv+2) );
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb+2,$cv, $rows[$j+1]);
                $cb +=1;

                $suma_blanco += $rows[$j+2];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($cb+4,$cb+6,$cv,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($cb+4,$cb+6,$cv,$cv+2));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb+4,$cv,$rows[$j+2] );
                $cb +=1;
            }
                $suma_proc += $rows[$inicioTotalCalificacion+3];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($cb+6,$cb+8,$cv,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($cb+6,$cb+8,$cv,$cv+2));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb+6,$cv,$rows[$inicioTotalCalificacion+3].'%');

                $suma_nota += $rows[$inicioTotalCalificacion+4];
                $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($cb+9,$cb+11,$cv,$cv+2))->applyFromArray($titulo_tres);
                $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($cb+9,$cb+11,$cv,$cv+2));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($cb+9,$cv, $rows[$inicioTotalCalificacion+4]);

            $cv+=3;
        }

        $arrayPromedio = array();
        array_push($arrayPromedio,"PROMEDIO");
        array_push($arrayPromedio,round($suma_buena/$mg));
        array_push($arrayPromedio,round($suma_mala/$mg));
        array_push($arrayPromedio,round($suma_blanco/$mg));
        array_push($arrayPromedio,round($suma_proc/$mg));
        array_push($arrayPromedio,round($suma_nota/$mg,2));

        $celdaA = array(0);
        $celdaB = array(10);
        $x = 8;

        foreach ($arrayPromedio as $key => $value) {
            $x+=3;
            array_push($celdaA,$x);
            array_push($celdaB,2);
        }

        foreach ($arrayPromedio as $key => $value) {

            $objPHPExcel->getActiveSheet(0)->getStyle(cellsToMergeByRowCols($celdaA[$key],$celdaA[$key]+$celdaB[$key],$cv,$cv+1))->applyFromArray($titulo_tres);
            $objPHPExcel->getActiveSheet(0)->mergeCells(cellsToMergeByRowCols($celdaA[$key],$celdaA[$key]+$celdaB[$key],$cv,$cv+1));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($celdaA[$key],$cv,$value);

        }


        $nombreArchivo = "reporte_eta_grupo.xlsx";
        require_once ROOT_EXCEL.'PHPExcel\\IOFactory.php';
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($_SERVER['DOCUMENT_ROOT']."/EVA/view/core/report/archive/".$nombreArchivo);
        sistema::imprimir(utf8_decode($nombreArchivo));
    }