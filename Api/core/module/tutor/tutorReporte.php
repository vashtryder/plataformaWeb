<?php

    function reporte_eta_metas($data)
    {
        list($unidad,$semana) = $data;
        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_s = gestorSemana::set_semana($semana);
        $data  = array($_SESSION['colegio'][0],$_SESSION['anio'][0],$semana);
        $row_p = gestorMeta::get_meta_porcentaje($data);

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->AddPage();

        $pdf->ln(30);

        $pdf->SetFont(FONT_BOLD,'',40);
        $pdf->SetWidths(array(0));
        $pdf->SetAligns(array('C'));
        $pdf->Row(array("META DEL AULA"),20,1);

        $pdf->SetFont(FONT_BOLD,'',170);
        $pdf->SetWidths(array(0));
        $pdf->SetAligns(array('C'));
        $pdf->Row(array($row_p[0]."%"),80,1);


        $pdf->output();
    }

    function reporte_eta_aula($data)
    {
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

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, 15);
        $pdf->SetHeaderMargin(15);
        $pdf->SetFooterMargin(15);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->AddPage();

        $pdf->SetFont(FONT_BOLD,'',25);
        $pdf->SetWidths(array(150));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array("REPORTE ETA POR AULA"),12,0);

        $pdf->SetFont(FONT_NAME,'',15);
        $pdf->Row(array($row_c[5]." ".$row_c[1]),10,0);

        $pdf->SetFont(FONT_NAME,'B',10);

        $pdf->SetFillColor(166,166,166);
        $pdf->SetWidths(array(15,60,20,25,20,12,20,10,26,25,18,15,21));
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C','C'));
        $pdf->SetFills(array(1,0,1,0,1,0,1,0,1,0,1,1,0));

        $arrayName = array("TUTOR:",$nombreTutor,"NIVEL:",$nombreNivel,"GRADO:",$nombreGrado,"SECCION:",$nombreSeccion,"EVALUACIÓN:",$row_s[3],$row_u[3],"FECHA:",$row_r[7]);
        $pdf->Row($arrayName,10,1);

        $pos_x = 5;
        $pos_y = 55;
        $altura = 5;

        $pdf->SetFont(FONT_NAME, 'B', 9);
        $pdf->SetFillColor(0,176,240);
        $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(12,$altura,"COD",1, 'C', 1, 0, $pos_x, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(60,$altura,"NOMBRE Y APELLIDO",1, 'C', 1, 0, $pos_x+12, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(10,$altura,"MG",1, 'C', 1, 0, $pos_x+72, $pos_y, true, 0, false, true, $altura, 'M');

        $pos_xc = $pos_x+82;
        foreach ($rs_c as $row_c) {
            $pdf->MultiCell(20,$altura,$row_c[3],1, 'C', 1, 0, $pos_xc , $pos_y, true, 0, false, true, $altura, 'M');
            $pos_xc+=20;
        }
        $pdf->MultiCell(25,$altura,'PROMEDIO',1, 'C', 1, 0, $pos_xc, $pos_y, true, 0, false, true, $altura, 'M');


        ///////////////////////
        // LISTA ESTUDIANTES //
        ///////////////////////
        $suma_nota = $suma_proc = array();

        $pos_x = 5;
        $pos_y = 55;
        $altura = 15;
        $altura_x = 5;

        $a=0;

        $suma_nota = array();

        $pdf->SetFont(FONT_NAME, '', 9);

        foreach($rs_e as $rows){
            $a++;

            $y_start = $pdf->GetY()+5;

            $valor = ($a%2 == 0) ? 1 : 0;

            $pdf->SetFillColor(242,242,242);
            $pdf->SetTextColor(0,0,0);
            $pdf->MultiCell(12,$altura,$rows[3],1, 'C', $valor, 0, $pos_x, $y_start, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(60,$altura,$rows[4]." ".$rows[5],1, 'C', $valor, 0, $pos_x+12, $y_start, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(10,$altura,$a.'°',1, 'C', $valor, 0, $pos_x+72, $y_start, true, 0, false, true, $altura, 'M');

            $pos_xc     = $pos_x+82;
            $pos_xc1    = $pos_xc;
            $anchoCelda = 20;

            $cont = 0;
            for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {
                $cont++;

                $valor_nota = $rows[$u];
                $valor_porc = $rows[$u-1];

                $suma_nota[$u] += $valor_nota;
                $suma_proc[$u-1] += $valor_porc;

                if ($valor_nota <= 10) {
                    $pdf->SetFillColor(255,188,0);
                }elseif ($valor_nota>=11 && $valor_nota<=17){
                    $pdf->SetFillColor(162,207,66);
                } elseif ($valor_nota>=18 && $valor_nota<= 20){
                    $pdf->SetFillColor(255,255,0);
                }

                $pdf->SetFont(FONT_NAME, 'B', 9);
                $pdf->MultiCell($anchoCelda,$altura_x,$valor_nota,1, 'C', 1, 0, $pos_xc , $y_start, true, 0, false, true, $altura_x, 'M'); #-- NOTA CURSO
                $pdf->SetFillColor(242,242,242);

                $pdf->SetFont(FONT_NAME, '', 9);
                $pdf->MultiCell($anchoCelda,$altura_x,$valor_porc. '%' ,1, 'C', $valor, 0, $pos_xc , $y_start+5, true, 0, false, true, $altura_x, 'M'); #-- PORCENTAJE NOTA

                $pos_xc+=$anchoCelda;
            }

            $anchoCelda1 = ($anchoCelda/3);

            for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {

                $suma_buena[$j] += $rows[$j];
                $pdf->MultiCell($anchoCelda1,$altura_x, $rows[$j] ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda1;

                $suma_mala[$j+1] += $rows[$j+1];
                $pdf->MultiCell($anchoCelda1,$altura_x, $rows[$j+1] ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda1;

                $suma_blanco[$j+2] += $rows[$j+2];
                $pdf->MultiCell($anchoCelda1,$altura_x, $rows[$j+2] ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda1;
            }

            /////////////////////////
            // PROMEDIO POR ALUMNO //
            /////////////////////////
            $pdf->SetFont(FONT_NAME, 'B', 9);
            $pdf->MultiCell(25,$altura_x, round($rows[$inicioTotalCalificacion+4]/$cont,2) ,1, 'C', $valor, 0, $pos_xc, $y_start, true, 0, false, true, $altura_x, 'M');

            $pdf->SetFont(FONT_NAME, '', 9);
            $pdf->MultiCell(25,$altura_x, $rows[$inicioTotalCalificacion+3].'%' ,1, 'C', $valor, 0, $pos_xc, $y_start+5, true, 0, false, true, $altura_x, 'M');

            $anchoCelda2 = (25/3);

            for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {

                $pdf->MultiCell($anchoCelda2,$altura_x, round($rows[$j]) ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda2;
                $pdf->MultiCell($anchoCelda2,$altura_x, round($rows[$j+1]) ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda2;
                $pdf->MultiCell($anchoCelda2,$altura_x, round($rows[$j+2]) ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda2;
            }

            $pdf->pagebreak(15);

        }

        // ////////////////////////
        // // RESULTADOS FINALES //
        // ////////////////////////


        $y_start = $pdf->GetY()+5;

        $pdf->SetFillColor(198,217,241);
        $pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(12,$altura,$y_end_1,1, 'C', 1, 0, $pos_x, $y_start, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(60,$altura,'',1, 'C', 1, 0, $pos_x+12, $y_start, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(10,$altura,'',1, 'C', 1, 0, $pos_x+72, $y_start, true, 0, false, true, $altura, 'M');

        $pos_xc     = $pos_x+82;
        $pos_xc1    = $pos_xc;
        $altura_x   = 5;
        $anchoCelda = 20;

        $prom_suma = $prom_porc = 0;

        for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {

            $prom_suma += round($suma_nota[$u]/$a,2);
            $prom_porc += round($suma_proc[$u-1]/$a);

            $pdf->MultiCell($anchoCelda,$altura_x, round($suma_nota[$u]/$a,2) ,1, 'C', 1, 0, $pos_xc , $y_start, true, 0, false, true, $altura_x, 'M'); #-- NOTA CURSO

            $pdf->SetFillColor(198,217,241);

            $pdf->MultiCell($anchoCelda,$altura_x, round($suma_proc[$u-1]/$a) . '%' ,1, 'C', 1, 0, $pos_xc , $y_start+5, true, 0, false, true, $altura_x, 'M'); #-- PORCENTAJE NOTA
            $pos_xc+=$anchoCelda;
        }

        $anchoCelda1 = ($anchoCelda/3);

        for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {

            $prom_buena += round($suma_buena[$j]/$a,2);
            $pdf->MultiCell($anchoCelda1,$altura_x, round($suma_buena[$j]/$a) ,1, 'C', 1, 0, $pos_xc1 , $y_start+10, true, 0, false, true, $altura_x, 'M'); #-- NOTAS DE PREGUNTAS
            $pos_xc1+=$anchoCelda1;

            $prom_mala += round($suma_mala[$j+1]/$a,2);
            $pdf->MultiCell($anchoCelda1,$altura_x, round($suma_mala[$j+1]/$a) ,1, 'C', 1, 0, $pos_xc1 , $y_start+10, true, 0, false, true, $altura_x, 'M'); #-- NOTAS DE PREGUNTAS
            $pos_xc1+=$anchoCelda1;

            $prom_blanco += round($suma_blanco[$j+2]/$a,2);
            $pdf->MultiCell($anchoCelda1,$altura_x, round($suma_blanco[$j+2]/$a) ,1, 'C', 1, 0, $pos_xc1 , $y_start+10, true, 0, false, true, $altura_x, 'M'); #-- NOTAS DE PREGUNTAS
            $pos_xc1+=$anchoCelda1;
        }

        //////////////////////
        // PROMEDIO GENERAL //
        //////////////////////

        $pdf->SetFillColor(0,176,240);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetFont(FONT_NAME, 'B', 9);
        $pdf->MultiCell(25,$altura_x, round($prom_suma/$cont,2) ,1, 'C', 1, 0, $pos_xc, $y_start, true, 0, false, true, $altura_x, 'M');

        $pdf->SetFont(FONT_NAME, 'B', 9);
        $pdf->MultiCell(25,$altura_x, round($prom_porc/$cont).'%' ,1, 'C', 1, 0, $pos_xc, $y_start+5, true, 0, false, true, $altura_x, 'M');

        $anchoCelda2 = (25/3);

        $pdf->MultiCell($anchoCelda2,$altura_x, round($prom_buena),1, 'C', 1, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
        $pos_xc1+=$anchoCelda2;

        $pdf->MultiCell($anchoCelda2,$altura_x, round($prom_mala) ,1, 'C', 1, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
        $pos_xc1+=$anchoCelda2;

        $pdf->MultiCell($anchoCelda2,$altura_x, round($prom_blanco) ,1, 'C', 1, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
        $pos_xc1+=$anchoCelda2;

        $pdf->lastPage();
        $pdf->output();
    }

    function reporte_eta_grado($data)
    {
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

        $mg=1;

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(true, 15);

        $pdf->AddPage();

        $pdf->SetFont(FONT_BOLD,'',25);
        $pdf->SetWidths(array(150));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array("REPORTE ETA POR GRADO"),12,0);

        $pdf->SetFont(FONT_NAME,'',15);
        $pdf->Row(array($row_c[5]." ".$row_c[1]),10,0);

        $pdf->SetFont(FONT_NAME,'B',10);
        $pdf->SetFillColor(166,166,166);
        $pdf->SetWidths(array(18,60,20,25,20,12,20,10,26,21,19,15,22));
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C','C'));
        $pdf->SetFills(array(1,0,1,0,1,0,1,0,1,0,1,1,0));


        $arrayName = array("TUTORES:",$nombreTutor[0]." ".$nombreTutor[1],"NIVEL:",$nombreNivel,"GRADO:",$nombreGrado,"SECCION:",$nombreSeccion[0]."|".$nombreSeccion[1],"EVALUACIÓN:",$row_s[3],$row_u[3],"FECHA:",$row_s[4]);
        $pdf->Row($arrayName,10,1);

        $pos_x = 5;
        $pos_y = 55;
        $altura = 5;

        $pdf->SetFont(FONT_NAME, 'B', 9);
        $pdf->SetFillColor(0,176,240);
        $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(10,$altura,"N°",1, 'C', 1, 0, $pos_x, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(45,$altura,"NOMBRE Y APELLIDO",1, 'C', 1, 0, $pos_x+10, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(10,$altura,"MG",1, 'C', 1, 0, $pos_x+55, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(18,$altura,"SECCION",1, 'C', 1, 0, $pos_x+65, $pos_y, true, 0, false, true, $altura, 'M');

        $pos_xc = $pos_x+83;
        foreach ($rs_c as $row_c) {
            $pdf->MultiCell(20,$altura,$row_c[3],1, 'C', 1, 0, $pos_xc , $pos_y, true, 0, false, true, $altura, 'M');
            $pos_xc+=20;
        }
        $pdf->MultiCell(25,$altura,"PROMEDIO",1, 'C', 1, 0, $pos_xc, $pos_y, true, 0, false, true, $altura, 'M');


        ///////////////////////
        // LISTA ESTUDIANTES //
        ///////////////////////
        $suma_nota = $suma_proc = array();

        $pos_x = 5;
        $pos_y = 55;
        $altura = 15;
        $altura_x = 5;

        $mg = 0;
        $pdf->SetFont(FONT_NAME, '', 9);

        foreach($rs_e as $rows){

            $mg++;

            $y_start = $pdf->GetY()+5;

            $valor = ($mg%2 == 0) ? 1 : 0;

            $pdf->SetFillColor(242,242,242);
            $pdf->SetTextColor(0,0,0);
            $pdf->MultiCell(10,$altura,$rows[3],1, 'C', $valor, 0, $pos_x, $y_start, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(45,$altura,$rows[5]." ".$rows[4],1, 'C', $valor, 0, $pos_x+10, $y_start, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(10,$altura,$mg.'°',1, 'C', $valor, 0, $pos_x+55, $y_start, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(18,$altura,$rows[7],1, 'C', $valor, 0, $pos_x+65, $y_start, true, 0, false, true, $altura, 'M');

            $pos_xc     = $pos_x+83;
            $pos_xc1    = $pos_xc;
            $anchoCelda = 20;

            $cont = 0;
            for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {
                $cont++;

                $valor_nota = $rows[$u];
                $valor_porc = $rows[$u-1];

                $suma_nota[$u] += $valor_nota;
                $suma_proc[$u-1] += $valor_porc;

                if ($valor_nota <= 10) {
                    $pdf->SetFillColor(255,188,0);
                }elseif ($valor_nota>=11 && $valor_nota<=17){
                    $pdf->SetFillColor(162,207,66);
                } elseif ($valor_nota>=18 && $valor_nota<= 20){
                    $pdf->SetFillColor(255,255,0);
                }
                $pdf->SetFont(FONT_NAME, 'B', 9);
                $pdf->MultiCell($anchoCelda,$altura_x,$valor_nota,1, 'C', 1, 0, $pos_xc , $y_start, true, 0, false, true, $altura_x, 'M'); #-- NOTA CURSO
                $pdf->SetFillColor(242,242,242);
                $pdf->SetFont(FONT_NAME, '', 9);
                $pdf->MultiCell($anchoCelda,$altura_x,$valor_porc. '%' ,1, 'C', $valor, 0, $pos_xc , $y_start+5, true, 0, false, true, $altura_x, 'M'); #-- PORCENTAJE NOTA

                $pos_xc+=$anchoCelda;
            }

            $anchoCelda1 = ($anchoCelda/3);

            for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {

                $suma_buena[$j] += $rows[$j];
                $pdf->MultiCell($anchoCelda1,$altura_x, $rows[$j] ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda1;

                $suma_mala[$j+1] += $rows[$j+1];
                $pdf->MultiCell($anchoCelda1,$altura_x, $rows[$j+1] ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda1;

                $suma_blanco[$j+2] += $rows[$j+2];
                $pdf->MultiCell($anchoCelda1,$altura_x, $rows[$j+2] ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda1;
            }

            /////////////////////////
            // PROMEDIO POR ALUMNO //
            /////////////////////////
            $pdf->SetFont(FONT_NAME, 'B', 9);
            $pdf->MultiCell(25,$altura_x, round($rows[$inicioTotalCalificacion+4]/$cont,2) ,1, 'C', $valor, 0, $pos_xc, $y_start, true, 0, false, true, $altura_x, 'M');

            $pdf->SetFont(FONT_NAME, '', 9);
            $pdf->MultiCell(25,$altura_x, $rows[$inicioTotalCalificacion+3].'%' ,1, 'C', $valor, 0, $pos_xc, $y_start+5, true, 0, false, true, $altura_x, 'M');

            $anchoCelda2 = (25/3);

            for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {

                $pdf->MultiCell($anchoCelda2,$altura_x, round($rows[$j]) ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda2;
                $pdf->MultiCell($anchoCelda2,$altura_x, round($rows[$j+1]) ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda2;
                $pdf->MultiCell($anchoCelda2,$altura_x, round($rows[$j+2]) ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda2;
            }


            $pdf->pagebreak(15);

        }


        ////////////////////////
        // RESULTADOS FINALES //
        ////////////////////////

        $y_start = $pdf->GetY()+5;

        $pdf->SetFillColor(198,217,241);
        $pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(10,$altura,$y_start,1, 'C', 1, 0, $pos_x, $y_start, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(45,$altura,'',1, 'C', 1, 0, $pos_x+10, $y_start, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(10,$altura,'',1, 'C', 1, 0, $pos_x+55, $y_start, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(18,$altura,'',1, 'C', 1, 0, $pos_x+65, $y_start, true, 0, false, true, $altura, 'M');

        $pos_xc     = $pos_x+83;
        $pos_xc1    = $pos_xc;
        $anchoCelda = 20;

        $prom_suma = $prom_porc = 0;

        for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {

            $prom_suma += ($suma_nota[$u]/$mg);
            $prom_porc += ($suma_proc[$u-1]/$mg);

            $pdf->SetFont(FONT_NAME, 'B', 9);
            $pdf->MultiCell($anchoCelda,$altura_x, round($suma_nota[$u]/$mg,2) ,1, 'C', 1, 0, $pos_xc , $y_start, true, 0, false, true, $altura_x, 'M'); #-- NOTA CURSO

            $pdf->SetFillColor(198,217,241);
            $pdf->SetFont(FONT_NAME, '', 9);
            $pdf->MultiCell($anchoCelda,$altura_x, round($suma_proc[$u-1]/$mg) . '%' ,1, 'C', 1, 0, $pos_xc , $y_start+5, true, 0, false, true, $altura_x, 'M'); #-- PORCENTAJE NOTA

            $pos_xc+=$anchoCelda;
        }

        $anchoCelda1 = ($anchoCelda/3);

        for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {

            $prom_buena += round($suma_buena[$j]/$mg,2);
            $pdf->MultiCell($anchoCelda1,$altura_x, round($suma_buena[$j]/$mg),1, 'C', 1, 0, $pos_xc1 , $y_start+10, true, 0, false, true, $altura_x, 'M'); #-- NOTAS DE PREGUNTAS
            $pos_xc1+=$anchoCelda1;

            $prom_mala += round($suma_mala[$j+1]/$mg,2);
            $pdf->MultiCell($anchoCelda1,$altura_x, round($suma_mala[$j+1]/$mg) ,1, 'C', 1, 0, $pos_xc1 , $y_start+10, true, 0, false, true, $altura_x, 'M'); #-- NOTAS DE PREGUNTAS
            $pos_xc1+=$anchoCelda1;

            $prom_blanco += round($suma_blanco[$j+2]/$mg,2);
            $pdf->MultiCell($anchoCelda1,$altura_x, round($suma_blanco[$j+2]/$mg) ,1, 'C', 1, 0, $pos_xc1 , $y_start+10, true, 0, false, true, $altura_x, 'M'); #-- NOTAS DE PREGUNTAS
            $pos_xc1+=$anchoCelda1;
        }

        //////////////////////
        // PROMEDIO GENERAL //
        //////////////////////

        $pdf->SetFont(FONT_NAME, 'B', 9);

        $pdf->SetFillColor(0,176,240);
        $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(25,$altura_x, round($prom_suma/$cont,2) ,1, 'C', 1, 0, $pos_xc, $y_start, true, 0, false, true, $altura_x, 'M');
        $pdf->MultiCell(25,$altura_x, round($prom_porc/$cont).'%' ,1, 'C', 1, 0, $pos_xc, $y_start+5, true, 0, false, true, $altura_x, 'M');

        $anchoCelda2 = (25/3);

        $pdf->MultiCell($anchoCelda2,$altura_x, round($prom_buena),1, 'C', 1, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
        $pos_xc1+=$anchoCelda2;

        $pdf->MultiCell($anchoCelda2,$altura_x, round($prom_mala) ,1, 'C', 1, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
        $pos_xc1+=$anchoCelda2;

        $pdf->MultiCell($anchoCelda2,$altura_x, round($prom_blanco) ,1, 'C', 1, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
        $pos_xc1+=$anchoCelda2;

        $pdf->output();
    }

    function reporte_eta_grupo($data)
    {
        list($unidad,$semana) = $data;

        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
        $row_s = gestorSemana::set_semana($semana);

        list( $idNivel, $nombreNivel, $abrvNivel) = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $nombreSeccion = $nombreGrado = array();

        $data1 = array(ETA,$_SESSION['colegio'][0],$_SESSION['anio'][0],$semana);
        $data2 = array(ETA,$_SESSION['anio'][0]);

        $rs_e  = gestorRegistroEta::get_eta_calificacion_grupo($data1,0,ETA_TABLA);
        $rs_r  = gestorRegistroEta::get_eta_grupo($data2);
        $rs_c  = gestorCursoEta::get_eta_curso(array($_SESSION['anio'][0],ETA));


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

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->AddPage();

        $pdf->SetFont(FONT_BOLD,'',25);
        $pdf->SetWidths(array(150));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array("REPORTE ETA POR GRUPO"),12,0);

        $pdf->SetFont(FONT_NAME,'',15);
        $pdf->Row(array($row_c[5]." ".$row_c[1]),10,0);

        $pdf->SetFont(FONT_NAME,'B',10);

        $pdf->SetFillColor(166,166,166);
        $pdf->SetWidths(array(20,25,20,30,20,10,26,28,20,15,25));
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C'));
        $pdf->SetFills(array(1,0,1,0,1,0,1,0,1,1,0));

        $arrayName = array("NIVEL:",$nombreNivel,"GRADO:",$nombreGrado[0]."|".$nombreGrado[2]."|".$nombreGrado[4],"SECCION:",$nombreSeccion[0]."|".$nombreSeccion[1],"EVALUACIÓN:",$row_s[3],$row_u[3]);
        $pdf->Row($arrayName,10,1);

        $pos_x = 5;
        $pos_y = 55;
        $altura = 5;

        $pdf->SetFont(FONT_NAME, 'B', 9);
        $pdf->SetFillColor(0,176,240);
        $pdf->SetTextColor(255,255,255);
        // $pdf->MultiCell(12,$altura,"",1, 'C', 1, 0, $pos_x, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(72,$altura,"NOMBRE Y APELLIDO",1, 'C', 1, 0, $pos_x, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(10,$altura,"MG",1, 'C', 1, 0, $pos_x+72, $pos_y, true, 0, false, true, $altura, 'M');

        $pos_xc = $pos_x+82;
        foreach ($rs_c as $row_c) {
            $pdf->MultiCell(20,$altura,$row_c[3],1, 'C', 1, 0, $pos_xc , $pos_y, true, 0, false, true, $altura, 'M');
            $pos_xc+=20;
        }
        $pdf->MultiCell(25,$altura,"PROMEDIO",1, 'C', 1, 0, $pos_xc, $pos_y, true, 0, false, true, $altura, 'M');


        ///////////////////////
        // LISTA ESTUDIANTES //
        ///////////////////////

        $suma_nota = $suma_proc = array();

        $pos_x = 5;
        $pos_y = 55;
        $altura = 15;
        $altura_x = 5;
        $mg=0;

        $pdf->SetFont(FONT_NAME, '', 9);
        foreach($rs_e as $rows){
            $mg++;

            $y_start = $pdf->GetY()+5;

            $valor = ($mg%2 == 0) ? 1 : 0;

            $pdf->SetFillColor(242,242,242);
            $pdf->SetTextColor(0,0,0);

            // $pdf->MultiCell(12,$altura,,1, 'C', $valor, 0, $pos_x, $y_start, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(72,$altura,$rows[5]." ".$rows[4]."\n ( ".$rows[6]." ".$rows[7]." ".$rows[8]." )",1, 'C', $valor, 0, $pos_x, $y_start, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(10,$altura,$mg.'°',1, 'C', $valor, 0, $pos_x+72, $y_start, true, 0, false, true, $altura, 'M');

            $pos_xc     = $pos_x+82;
            $pos_xc1    = $pos_xc;
            $anchoCelda = 20;

            $cont = 0;
            for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {
                $cont++;

                $valor_nota = $rows[$u];
                $valor_porc = $rows[$u-1];

                $suma_nota[$u] += $valor_nota;
                $suma_proc[$u-1] += $valor_porc;

                if ($valor_nota <= 10) {
                    $pdf->SetFillColor(255,188,0);
                }elseif ($valor_nota>=11 && $valor_nota<=17){
                    $pdf->SetFillColor(162,207,66);
                } elseif ($valor_nota>=18 && $valor_nota<= 20){
                    $pdf->SetFillColor(255,255,0);
                }

                $pdf->SetFont(FONT_NAME, 'B', 9);
                $pdf->MultiCell($anchoCelda,$altura_x,$valor_nota,1, 'C', 1, 0, $pos_xc , $y_start, true, 0, false, true, $altura_x, 'M'); #-- NOTA CURSO

                $pdf->SetFont(FONT_NAME, '', 9);
                $pdf->SetFillColor(242,242,242);
                $pdf->MultiCell($anchoCelda,$altura_x,$valor_porc . '%' ,1, 'C', $valor, 0, $pos_xc , $y_start+5, true, 0, false, true, $altura_x, 'M'); #-- PORCENTAJE NOTA

                $pos_xc+=$anchoCelda;
            }

            $anchoCelda1 = ($anchoCelda/3);

            for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {

                $suma_buena[$j] += $rows[$j];
                $pdf->MultiCell($anchoCelda1,$altura_x, $rows[$j] ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda1;

                $suma_mala[$j+1] += $rows[$j+1];
                $pdf->MultiCell($anchoCelda1,$altura_x, $rows[$j+1] ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda1;

                $suma_blanco[$j+2] += $rows[$j+2];
                $pdf->MultiCell($anchoCelda1,$altura_x, $rows[$j+2] ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda1;
            }

            /////////////////////////
            // PROMEDIO POR ALUMNO //
            /////////////////////////
            $pdf->SetFont(FONT_NAME, 'B', 9);
            $pdf->MultiCell(25,$altura_x, round($rows[$inicioTotalCalificacion+4]/$cont,2) ,1, 'C', $valor, 0, $pos_xc, $y_start, true, 0, false, true, $altura_x, 'M');

            $pdf->SetFont(FONT_NAME, '', 9);
            $pdf->MultiCell(25,$altura_x, round($rows[$inicioTotalCalificacion+3]).'%' ,1, 'C', $valor, 0, $pos_xc, $y_start+5, true, 0, false, true, $altura_x, 'M');

            $anchoCelda2 = (25/3);

            for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {
                $pdf->MultiCell($anchoCelda2,$altura_x, round($rows[$j]) ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda2;
                $pdf->MultiCell($anchoCelda2,$altura_x, round($rows[$j+1]) ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda2;
                $pdf->MultiCell($anchoCelda2,$altura_x, round($rows[$j+2]) ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                $pos_xc1+=$anchoCelda2;
            }

            $pdf->pagebreak(15);

        }

        ////////////////////////
        // RESULTADOS FINALES //
        ////////////////////////

        $y_start = $pdf->GetY()+5;

        $pdf->SetFillColor(198,217,241);
        $pdf->SetTextColor(0,0,0);
        // $pdf->MultiCell(12,$altura,'',1, 'C', 1, 0, $pos_x, $y_start+15, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(72,$altura,'',1, 'C', 1, 0, $pos_x, $y_start, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(10,$altura,'',1, 'C', 1, 0, $pos_x+72, $y_start, true, 0, false, true, $altura, 'M');

        $pos_xc     = $pos_x+82;
        $pos_xc1    = $pos_xc;
        $anchoCelda = 20;

        $prom_suma = $prom_porc = 0;

        for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {

            $prom_suma += round($suma_nota[$u]/$mg,2);
            $prom_porc += round($suma_proc[$u-1]/$mg,2);

            $pdf->SetFont(FONT_NAME, 'B', 9);
            $pdf->MultiCell($anchoCelda,$altura_x,round($suma_nota[$u]/$mg,2),1, 'C', 1, 0, $pos_xc , $y_start, true, 0, false, true, $altura_x, 'M'); #-- NOTA CURSO

            $pdf->SetFont(FONT_NAME, '', 9);
            $pdf->SetFillColor(198,217,241);
            $pdf->MultiCell($anchoCelda,$altura_x,round($suma_proc[$u-1]/$mg) . '%' ,1, 'C', 1, 0, $pos_xc , $y_start+5, true, 0, false, true, $altura_x, 'M'); #-- PORCENTAJE NOTA

            $pos_xc+=$anchoCelda;
        }

        $anchoCelda1 = ($anchoCelda/3);

        for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {

            $prom_buena += round($suma_buena[$j]/$mg);
            $pdf->MultiCell($anchoCelda1,$altura_x, round($suma_buena[$j]/$mg) ,1, 'C', 1, 0, $pos_xc1 , $y_start+10, true, 0, false, true, $altura_x, 'M'); #-- NOTAS DE PREGUNTAS
            $pos_xc1+=$anchoCelda1;

            $prom_mala += round($suma_mala[$j+1]/$mg,2);
            $pdf->MultiCell($anchoCelda1,$altura_x, round($suma_mala[$j+1]/$mg) ,1, 'C', 1, 0, $pos_xc1 , $y_start+10, true, 0, false, true, $altura_x, 'M'); #-- NOTAS DE PREGUNTAS
            $pos_xc1+=$anchoCelda1;

            $prom_blanco += round($suma_blanco[$j+2]/$mg,2);
            $pdf->MultiCell($anchoCelda1,$altura_x, round($suma_blanco[$j+2]/$mg) ,1, 'C', 1, 0, $pos_xc1 , $y_start+10, true, 0, false, true, $altura_x, 'M'); #-- NOTAS DE PREGUNTAS
            $pos_xc1+=$anchoCelda1;
        }

        //////////////////////
        // PROMEDIO GENERAL //
        //////////////////////


        $pdf->SetFont(FONT_NAME, 'B', 9);
        $pdf->SetFillColor(0,176,240);
        $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(25,$altura_x, round($prom_suma/$cont,2),1, 'C', 1, 0, $pos_xc, $y_start, true, 0, false, true, $altura_x, 'M');
        $pdf->MultiCell(25,$altura_x, round($prom_porc/$cont).'%' ,1, 'C', 1, 0, $pos_xc, $y_start+5, true, 0, false, true, $altura_x, 'M');

        $anchoCelda2 = (25/3);


        $pdf->MultiCell($anchoCelda2,$altura_x, round($prom_buena),1, 'C', 1, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
        $pos_xc1+=$anchoCelda2;

        $pdf->MultiCell($anchoCelda2,$altura_x, round($prom_mala) ,1, 'C', 1, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
        $pos_xc1+=$anchoCelda2;

        $pdf->MultiCell($anchoCelda2,$altura_x, round($prom_blanco) ,1, 'C', 1, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
        $pos_xc1+=$anchoCelda2;

        $pdf->output();
    }

    function reporte_eta_estudiante($data)
    {
        list($estudiante,$unidad) = $data;

        $row_i = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_e = gestorEstudiante::set_estudiante($estudiante);
        $row_f = gestorFicha::set_fichaEstudiante($estudiante);

        list( $idGrado, $nombreGrado)     = GestorGrado::set_grado($row_f[4]);
        list( $idSeccion, $nombreSeccion) = GestorSeccion::set_seccion($row_f[5]);
        list( $idNivel, $nombreNivel)     = GestorNivel::set_nivel($row_f[6]);

        $rs_c         = gestorCursoEta::get_eta_curso(array($_SESSION['anio'][0],ETA));
        $r_eta        = gestorRegistroEta::get_eta_configuracion(ETA);
        $CantCampo    = gestorRegistroEta::get_registro_campos(ETA_TABLA);
        $CantPregunta = $r_eta[2];
        $CantUsuario  = $r_eta[3];
        $CantDetalle  = $r_eta[4];

        $inicioRespuestaCorrecta = $CantUsuario + $CantPregunta + $CantDetalle;
        $inicioTotalCalificacion = $CantUsuario + $CantPregunta;

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, 0);

        foreach ($unidad as $value) {

            $data1 = array($row_f[7],$_SESSION['colegio'][0],$_SESSION['anio'][0],$value);
            $row_u = gestorPeriodo::set_periodo(array($value,$_SESSION['anio'][0]));
            $row_s = gestorSemana::get_semana_periodo($value);
            $rs_e  = gestorRegistroEta::get_eta_calificacion_estudiante($data1,ETA_TABLA);

            $pdf->AddPage();

            $pdf->SetFillColor(255,255,255);
            $pdf->SetTextColor(0,0,0);

            $pdf->SetFont(FONT_BOLD,'',25);
            $pdf->SetWidths(array(150));
            $pdf->SetAligns(array('L'));
            $pdf->SetFills(array(0));
            $pdf->Row(array("REPORTE ETA POR ESTUDIANTE"),12,0);

            $pdf->SetFont(FONT_NAME,'',15);
            $pdf->SetFills(array(0));
            $pdf->Row(array($row_i[5]." ".$row_i[1]),10,0);

            $pdf->SetFont(FONT_NAME,'B',10);

            $pdf->SetFillColor(166,166,166);
            $pdf->SetWidths(array(25,60,20,15,20,25,20,12,20,10,21,15,25));
            $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C','C'));
            $pdf->SetFills(array(1,0,1,0,1,0,1,0,1,0,1,1,0));

            $arrayName = array("ESTUDIANTE:",$row_e[3]." ".$row_e[4]." ".$row_e[5],"CODIGO:",$row_f[7],"NIVEL:",$nombreNivel,"GRADO:",$nombreGrado,"SECCION:",$nombreSeccion,$row_u[3]);
            $pdf->Row($arrayName,10,1);

            $pos_x = 5;
            $pos_y = 55;
            $altura = 5;

            $pdf->SetFont(FONT_NAME, 'B', 9);
            $pdf->SetFillColor(0,176,240);
            $pdf->SetTextColor(255,255,255);
            $pdf->MultiCell(12,$altura,"N°",1, 'C', 1, 0, $pos_x, $pos_y, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(60,$altura,"ETA",1, 'C', 1, 0, $pos_x+12, $pos_y, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(10,$altura,"MG",1, 'C', 1, 0, $pos_x+72, $pos_y, true, 0, false, true, $altura, 'M');

            $pos_xc = $pos_x+82;
            foreach ($rs_c as $row_c) {
                $pdf->MultiCell(20,$altura,$row_c[3],1, 'C', 1, 0, $pos_xc , $pos_y, true, 0, false, true, $altura, 'M');
                $pos_xc+=20;
            }
            $pdf->MultiCell(25,$altura,"PROMEDIO",1, 'C', 1, 0, $pos_xc, $pos_y, true, 0, false, true, $altura, 'M');


            ///////////////////////
            // LISTA ESTUDIANTES //
            ///////////////////////

            $suma_nota = $suma_proc = array();

            $pos_x = 5;
            $pos_y = 55;
            $altura = 15;
            $altura_x = 5;

            $mg = 0;

            $pdf->SetFont(FONT_NAME, '', 9);
            foreach($rs_e as $rows){

                $row_s = gestorSemana::get_semana_registro($rows[1]);

                $y_start = $pdf->GetY()+$altura_x;
                $valor = ($mg%2 == 0) ? 1 : 0;

                $mg++;
                $pdf->SetFillColor(242,242,242);
                $pdf->SetTextColor(0,0,0);
                $pdf->MultiCell(12,$altura,$row_s[0],1, 'C', $valor, 0, $pos_x, $y_start, true, 0, false, true, $altura, 'M');
                $pdf->MultiCell(60,$altura,$row_s[3],1, 'C', $valor, 0, $pos_x+12, $y_start, true, 0, false, true, $altura, 'M');
                $pdf->MultiCell(10,$altura,$mg.'°',1, 'C', $valor, 0, $pos_x+72, $y_start, true, 0, false, true, $altura, 'M');

                $pos_xc     = $pos_x+82;
                $pos_xc1    = $pos_xc;
                $anchoCelda = 20;


                $cont = 0;
                for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {
                    $cont++;

                    $valor_nota = $rows[$u];
                    $valor_porc = $rows[$u-1];

                    $suma_nota[$u] += $valor_nota;
                    $suma_proc[$u-1] += $valor_porc;

                    if ($valor_nota <= 10) {
                        $pdf->SetFillColor(255,188,0);
                    }elseif ($valor_nota>=11 && $valor_nota<=17){
                        $pdf->SetFillColor(162,207,66);
                    } elseif ($valor_nota>=18 && $valor_nota<= 20){
                        $pdf->SetFillColor(255,255,0);
                    }
                    $pdf->SetFont(FONT_NAME, 'B', 9);
                    $pdf->MultiCell($anchoCelda,$altura_x,$valor_nota,1, 'C', 1, 0, $pos_xc , $y_start, true, 0, false, true, $altura_x, 'M'); #-- NOTA CURSO

                    $pdf->SetFont(FONT_NAME, '', 9);
                    $pdf->SetFillColor(242,242,242);
                    $pdf->MultiCell($anchoCelda,$altura_x, $valor_porc. '%' ,1, 'C', $valor, 0, $pos_xc , $y_start+5, true, 0, false, true, $altura_x, 'M'); #-- PORCENTAJE NOTA

                    $pos_xc+=$anchoCelda;
                }

                $anchoCelda1 = ($anchoCelda/3);

                for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {

                    $suma_buena[$j] += $rows[$j];
                    $pdf->MultiCell($anchoCelda1,$altura_x, $rows[$j] ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                    $pos_xc1+=$anchoCelda1;

                    $suma_mala[$j+1] += $rows[$j+1];
                    $pdf->MultiCell($anchoCelda1,$altura_x, $rows[$j+1] ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                    $pos_xc1+=$anchoCelda1;

                    $suma_blanco[$j+2] += $rows[$j+2];
                    $pdf->MultiCell($anchoCelda1,$altura_x, $rows[$j+2] ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                    $pos_xc1+=$anchoCelda1;
                }

                /////////////////////////
                // PROMEDIO POR ALUMNO //
                /////////////////////////
                $pdf->SetFont(FONT_NAME, 'B', 9);
                $pdf->MultiCell(25,$altura_x, round($rows[$inicioTotalCalificacion+4]/$cont,2) ,1, 'C', $valor, 0, $pos_xc, $y_start, true, 0, false, true, $altura_x, 'M');

                $pdf->SetFont(FONT_NAME, '', 9);
                $pdf->MultiCell(25,$altura_x, $rows[$inicioTotalCalificacion+3].'%' ,1, 'C', $valor, 0, $pos_xc, $y_start+5, true, 0, false, true, $altura_x, 'M');

                $anchoCelda2 = (25/3);

                for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {

                    $pdf->MultiCell($anchoCelda2,$altura_x, round($rows[$j]) ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                    $pos_xc1+=$anchoCelda2;
                    $pdf->MultiCell($anchoCelda2,$altura_x, round($rows[$j+1]) ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                    $pos_xc1+=$anchoCelda2;
                    $pdf->MultiCell($anchoCelda2,$altura_x, round($rows[$j+2]) ,1, 'C', $valor, 0, $pos_xc1, $y_start+10, true, 0, false, true, $altura_x, 'M');
                    $pos_xc1+=$anchoCelda2;
                }

                $pos_y += $altura;
            }


        }

        $pdf->output();
    }

    function reporte_eta_porcentual($data)
    {
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

        $nombreTutor = $nombreTutor = $row_t[3]." ".$row_t[4]." ".$row_t[5];

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->AddPage();

        $pdf->SetFont(FONT_BOLD,'',25);
        $pdf->SetWidths(array(200));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array("REPORTE PORCENTUAL DE RESPUESTA"),12,0);

        $pdf->SetFont(FONT_NAME,'',15);
        $pdf->Row(array($row_c[5]." ".$row_c[1]),10,0);

        $pdf->SetFont(FONT_NAME,'B',10);

        $pdf->SetFillColor(166,166,166);
        $pdf->SetWidths(array(15,60,20,25,20,12,20,12,26,24,18,15,21));
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C','C'));
        $pdf->SetFills(array(1,0,1,0,1,0,1,0,1,0,1,1,0));


        $arrayName = array("TUTOR:",$nombreTutor,"NIVEL:",$nombreNivel,"GRADO:",$nombreGrado,"SECCION:",$nombreSeccion,"EVALUACIÓN:",$row_s[3],$row_u[3],"FECHA:",$row_r[7]);
        $pdf->Row($arrayName,10,1);

        $arrayName2 = array('A','B','C','D','E','BLAN','ANUL');

        $pos_x       = 5;
        $pos_y       = 55;
        $altura      = 5;
        $anchoCelda1 = 73/7;

        $pdf->SetFont(FONT_NAME, 'B', 9);
        $pdf->SetFillColor(0,176,240);
        $pdf->SetTextColor(255,255,255);

        $pdf->MultiCell(10,$altura,"N°",1, 'C', 1, 0, $pos_x, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(58,$altura,"CURSO",1, 'C', 1, 0, $pos_x+10, $pos_y, true, 0, false, true, $altura, 'M');
        $pos_xc = $pos_x+68;
        foreach ($arrayName2 as $value) {
            $pdf->MultiCell($anchoCelda1,$altura,$value,1, 'C', 1, 0, $pos_xc , $pos_y, true, 0, false, true, $altura, 'M');
            $pos_xc+=$anchoCelda1;
        }

        $pos_x  = 152;

        $pdf->MultiCell(10,$altura,"N°",1, 'C', 1, 0, $pos_x, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(58,$altura,"CURSO",1, 'C', 1, 0, $pos_x+10, $pos_y, true, 0, false, true, $altura, 'M');
        $pos_xc = $pos_x+68;
        foreach ($arrayName2 as $value) {
            $pdf->MultiCell($anchoCelda1,$altura,$value,1, 'C', 1, 0, $pos_xc , $pos_y, true, 0, false, true, $altura, 'M');
            $pos_xc+=$anchoCelda1;
        }

        $nroRespuesta = 4;

        $pdf->SetFont(FONT_NAME, '', 9);

        $altura      = 5;
        $n           = 0 ;
        $y_start1    = 60;

        foreach ($rs_c as $row_c) { #for ($c=1; $c <= 9; $c++) { #-- cantidad de curso

            $valor = (ETA == 1) ? 4 : 9;
            # -- consulta indique la cantidda de pregunta por curso

            $page_start = $pdf->getPage();
            $y_start = $pdf->GetY()+5;

            if($row_c[0] <= $valor){

                $cursoEta = gestorCursoEta::set_eta_curso_configuracion(array($_SESSION['anio'][0],$row_c[1],ETA));

                $pos_x = 5;

                for ($r=1;$r<= $cursoEta[4] ;$r++){
                    $n++;

                    $respuesta = $row_v[$nroRespuesta];
                    $row_p = gestorRespuestaEta::get_eta_porcentaje(array($row_v[1],$_SESSION['anio'][0],$n),ETA_RESPUESTA,ETA_TABLA);
                    $mayor = max($row_p[0],$row_p[1],$row_p[2],$row_p[3],$row_p[4],$row_p[5],$row_p[6]);

                    $pdf->SetFont(FONT_NAME, '', 9);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->MultiCell(10,$altura,$n,0, 'C', 0, 0, $pos_x, $y_start, true, 0, false, true, $altura, 'M');
                    $pdf->MultiCell(58,$altura,$row_c[2],0, 'C', 0, 0, $pos_x+10, $y_start, true, 0, false, true, $altura, 'M');
                    $pos_xc1 = $pos_x+68;

                    $key = 0;

                    foreach ($arrayName2 as $value) {
                        $pdf->SetFillColor(191,191,191);
                        $valor_color = ($value == $respuesta) ? 1 : 0;
                        if($row_p[$key] == $mayor and $value == $respuesta) {
                            $pdf->SetFont(FONT_NAME, 'B', 9);
                        } else if ($respuesta == $value) {
                            $pdf->SetFont(FONT_NAME, '', 9);
                        } else if ($row_p[$key] == $mayor) {
                            $pdf->SetFont(FONT_NAME, 'B', 9);
                        } else{
                            $pdf->SetFont(FONT_NAME, '', 9);
                        }

                        $pdf->MultiCell($anchoCelda1,$altura, $row_p[$key].'%' ,0, 'C', $valor_color, 0, $pos_xc1 , $y_start, true, 0, false, true, $altura, 'M');
                        $pos_xc1+=$anchoCelda1;

                        $key++;

                    }
                    $y_start += $altura;

                    $nroRespuesta++;
                }

            } else{

                $pos_x = 152;
                $page_start = $pdf->getPage();
                $cursoEta = gestorCursoEta::set_eta_curso_configuracion(array($_SESSION['anio'][0],$row_c[1],ETA));


                for ($r=1; $r <= $cursoEta[4]; $r++) {
                    $n++;

                    $respuesta = $row_v[$nroRespuesta];
                    $row_p = gestorRespuestaEta::get_eta_porcentaje(array($row_v[1],$_SESSION['anio'][0],$n),ETA_RESPUESTA,ETA_TABLA);
                    $mayor = max($row_p[0],$row_p[1],$row_p[2],$row_p[3],$row_p[4],$row_p[5],$row_p[6]);

                    $pdf->SetFont(FONT_NAME, '', 9);
                    $pdf->MultiCell(10,$altura,$n,0, 'C', 0, 0, $pos_x, $y_start1, true, 0, false, true, $altura, 'M');
                    $pdf->MultiCell(58,$altura,$row_c[2],0, 'C', 0, 0, $pos_x+10, $y_start1, true, 0, false, true, $altura, 'M',true);

                    $pos_xc = $pos_x+68;
                    $key = 0;
                    foreach ($arrayName2 as $value) {
                        $pdf->SetFillColor(191,191,191);

                        $valor_color = ($value == $respuesta) ? 1 : 0;

                        if($row_p[$key] == $mayor and $value == $respuesta) {
                            $pdf->SetFont(FONT_NAME, 'B', 9);
                        } else if ($respuesta == $value) {
                            $pdf->SetFont(FONT_NAME, '', 9);
                        } else if ($row_p[$key] == $mayor) {
                            $pdf->SetFont(FONT_NAME, 'B', 9);
                        } else{
                            $pdf->SetFont(FONT_NAME, '', 9);
                        }

                        $pdf->MultiCell($anchoCelda1,$altura,$row_p[$key].'%',0, 'C',$valor_color, 0, $pos_xc , $y_start1, true, 0, false, true, $altura, 'M');
                        $pos_xc+=$anchoCelda1;

                        $key++;
                    }
                    $y_start1 += $altura;

                    $nroRespuesta++;
                }
            }

        }

        $pdf->output();
    }

    function reporte_merito_aula($data)
    {
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

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, 30);
        $pdf->AddPage();

        $pdf->SetFont(FONT_NAME,'B',25);
        $pdf->SetWidths(array(150));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array("MERITO GENERAL POR AULA"),12,0);

        $pdf->SetFont(FONT_NAME,'B',15);
        $pdf->Row(array($row_c[5]." ".$row_c[1]),10,0);

        $pdf->SetFont(FONT_NAME,'B',18);
        $pdf->Row(array("LOS ".$cantidad." PRIMEROS PUESTOS"),10,0);

        $pdf->SetFont(FONT_NAME,'B',10);

        $pdf->SetFillColor(166,166,166);
        $pdf->SetWidths(array(15,60,20,25,20,12,20,10,26,25,15,15,25));
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C','C'));
        $pdf->SetFills(array(1,0,1,0,1,0,1,0,1,0,1,1,0));

        $arrayName = array("TUTOR:",$nombreTutor,"NIVEL:",$nombreNivel,"GRADO:",$nombreGrado,"SECCION:",$nombreSeccion,"EVALUACIÓN:",$row_s[3],$row_u[3],"FECHA:",$row_r[7]);
        $pdf->Row($arrayName,10,1);

        $pos_x = 66;
        $pos_y = 70;
        $altura = 15;
        $altura_x = 15;

        $pdf->SetFont(FONT_NAME, '', 11);
        $pdf->SetFillColor(0,176,240);
        $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(30,$altura,"PUESTO",1, 'C', 1, 0, $pos_x, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(90,$altura,"NOMBRES Y APELLIDOS",1, 'C', 1, 0, $pos_x+30, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(30,$altura,"PROMEDIO",1, 'C', 1, 0, $pos_x+120, $pos_y, true, 0, false, true, $altura, 'M');

        ///////////////////////
        // LISTA ESTUDIANTES //
        ///////////////////////
        $mg=0;
        $rcurso = count(gestorCursoEta::get_eta_curso(array($_SESSION['anio'][0],ETA)));
        $pdf->SetFont(FONT_NAME, '', 12);
        foreach($rs_e as $rows){
            $mg++;
            $y_start = $pdf->GetY()+$altura_x;
            $valor = ($mg%2 == 0) ? 1 : 0;
            $u = (ETA == 1) ? 53 : 43;
            $pdf->SetFillColor(242,242,242);
            $pdf->SetTextColor(0,0,0);
            $pdf->MultiCell(30,$altura_x,$mg.'°',1, 'C', $valor, 0, $pos_x, $y_start, true, 0, false, true, $altura_x, 'M');
            $pdf->MultiCell(90,$altura_x,$rows[4]." ".$rows[5],1, 'C', $valor, 0, $pos_x+30, $y_start, true, 0, false, true, $altura_x, 'M');
            $pdf->MultiCell(30,$altura_x, round($rows[$u]/$rcurso,2)." ( ".$rows[$u-1]."% )",1, 'C', $valor, 0, $pos_x+120, $y_start, true, 0, false, true, $altura_x, 'M');

            $pdf->pagebreak(25);
        }


        $pdf->output();
    }

    function reporte_merito_grado($data)
    {
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

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, 30);
        $pdf->AddPage();

        $pdf->SetFont(FONT_NAME,'B',25);
        $pdf->SetWidths(array(150));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array("REPORTE ETA POR GRADO"),12,0);

        $pdf->SetFont(FONT_NAME,'B',15);
        $pdf->Row(array($row_c[5]." ".$row_c[1]),10,0);

        $pdf->SetFont(FONT_NAME,'B',18);
        $pdf->Row(array("LOS ".$cantidad." PRIMEROS PUESTOS"),10,0);
        $pdf->SetFont(FONT_NAME,'B',10);
        $pdf->SetFillColor(166,166,166);
        $pdf->SetWidths(array(18,60,20,25,20,12,20,10,26,21,19,15,22));
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C','C'));
        $pdf->SetFills(array(1,0,1,0,1,0,1,0,1,0,1,1,0));


        $arrayName = array("TUTORES:",$nombreTutor[0]." ".$nombreTutor[1],"NIVEL:",$nombreNivel,"GRADO:",$nombreGrado,"SECCION:",$nombreSeccion[0]."|".$nombreSeccion[1],"EVALUACIÓN:",$row_s[3],$row_u[3],"FECHA:",$row_s[4]);
        $pdf->Row($arrayName,10,1);

        $pos_x = 66;
        $pos_y = 70;
        $altura = 15;
        $altura_x = 15;

        $pdf->SetFont(FONT_NAME, '', 11);
        $pdf->SetFillColor(0,176,240);
        $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(30,$altura,"PUESTO",1, 'C', 1, 0, $pos_x, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(90,$altura,"NOMBRES Y APELLIDOS",1, 'C', 1, 0, $pos_x+30, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(30,$altura,"PROMEDIO",1, 'C', 1, 0, $pos_x+120, $pos_y, true, 0, false, true, $altura, 'M');
        // $pdf->ln(0);

        ///////////////////////
        // LISTA ESTUDIANTES //
        ///////////////////////
        $pdf->SetFont(FONT_NAME, '', 12);
        $mg=0;

        // $y_start = $pdf->GetY()+$altura;
        $rcurso = count(gestorCursoEta::get_eta_curso(array($_SESSION['anio'][0],ETA)));

        foreach($rs_e as $rows){
            $mg++;

            $y_start = $pdf->GetY()+$altura_x;

            $valor = ($mg%2 == 0) ? 1 : 0;

            $u = (ETA == 1) ? 53 : 43;

            $pdf->SetFillColor(242,242,242);
            $pdf->SetTextColor(0,0,0);
            $pdf->MultiCell(30,$altura_x,$mg.'°',1, 'C', $valor, 0, $pos_x, $y_start, true, 0, false, true, $altura_x, 'M');
            $pdf->MultiCell(90,$altura_x,$rows[4]." ".$rows[5]."\n".$rows[6]." ".$rows[7]." ".$rows[8],1, 'C', $valor, 0, $pos_x+30, $y_start, true, 0, false, true, $altura_x, 'M');
            $pdf->MultiCell(30,$altura_x, round($rows[$u]/$rcurso,2)." ( ".$rows[$u-1]."% )",1, 'C', $valor, 0, $pos_x+120, $y_start, true, 0, false, true, $altura_x, 'M');

            $pdf->pagebreak(25);
        }

        $pdf->output();
    }

    function reporte_merito_grupo($data)
    {
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

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, 30);
        $pdf->AddPage();

        $pdf->SetFont(FONT_NAME,'B',25);
        $pdf->SetWidths(array(150));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array("REPORTE ETA POR GRUPO"),12,0);

        $pdf->SetFont(FONT_NAME,'B',15);
        $pdf->Row(array($row_c[5]." ".$row_c[1]),10,0);

        $pdf->SetFont(FONT_NAME,'B',18);
        $pdf->Row(array("LOS ".$cantidad." PRIMEROS PUESTOS"),10,0);
        $pdf->SetFont(FONT_NAME,'B',10);
        $pdf->SetFillColor(166,166,166);

        $pdf->SetWidths(array(20,25,20,30,20,10,26,28,20,15,25));
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C'));
        $pdf->SetFills(array(1,0,1,0,1,0,1,0,1,1,0));

        $arrayName = array("NIVEL:",$nombreNivel,"GRADO:",$nombreGrado[0]."|".$nombreGrado[2]."|".$nombreGrado[4],"SECCION:",$nombreSeccion[0]."|".$nombreSeccion[1],"EVALUACIÓN:",$row_s[3],$row_u[3],"FECHA:",$row_s[4]);
        $pdf->Row($arrayName,10,1);

        $pos_x = 66;
        $pos_y = 70;
        $altura = 15;
        $altura_x = 15;

        $pdf->SetFont(FONT_NAME, '', 11);
        $pdf->SetFillColor(0,176,240);
        $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(30,$altura,"PUESTO",1, 'C', 1, 0, $pos_x, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(90,$altura,"NOMBRES Y APELLIDOS",1, 'C', 1, 0, $pos_x+30, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(30,$altura,"PROMEDIO",1, 'C', 1, 0, $pos_x+120, $pos_y, true, 0, false, true, $altura, 'M');

        ///////////////////////
        // LISTA ESTUDIANTES //
        ///////////////////////
        $pdf->SetFont(FONT_NAME, '', 12);
        $mg=0;
        $rcurso = count(gestorCursoEta::get_eta_curso(array($_SESSION['anio'][0],ETA)));
        foreach($rs_e as $rows){
            $mg++;
            $y_start = $pdf->GetY()+$altura_x;

            $valor = ($mg%2 == 0) ? 1 : 0;

            $u = (ETA == 1) ? 53 : 43;

            $pdf->SetFillColor(242,242,242);
            $pdf->SetTextColor(0,0,0);
            $pdf->MultiCell(30,$altura_x,$mg.'°',1, 'C', $valor, 0, $pos_x, $y_start, true, 0, false, true, $altura_x, 'M');
            $pdf->MultiCell(90,$altura_x,$rows[4]." ".$rows[5]."\n".$rows[6]." ".$rows[7]." ".$rows[8],1, 'C', $valor, 0, $pos_x+30, $y_start, true, 0, false, true, $altura_x, 'M');
            $pdf->MultiCell(30,$altura_x,round($rows[$u]/$rcurso,2)." ( ".$rows[$u-1]."% )",1, 'C', $valor, 0, $pos_x+120, $y_start, true, 0, false, true, $altura_x, 'M');

            $pdf->pagebreak(25);
        }

        $pdf->output();
    }

    function reporte_eta_semana($data)
    {
        list($unidad,$semana) = $data;

        $data1  = array($_SESSION['tutor']['grado'],$_SESSION['tutor']['seccion'],$_SESSION['tutor']['nivel'],$_SESSION['colegio'][0],$_SESSION['anio'][0]);

        list( $idGrado, $nombreGrado)     = GestorGrado::set_grado($_SESSION['tutor']['grado']);
        list( $idSeccion, $nombreSeccion) = GestorSeccion::set_seccion($_SESSION['tutor']['seccion']);
        list( $idNivel, $nombreNivel)     = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_s = gestorSemana::set_semana($semana);
        $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
        $row_t = gestorTutor::get_eta_tutor($data1);

        $nombreTutor = $nombreTutor = $row_t[3]." ".$row_t[4]." ".$row_t[5];

        $row_s = gestorSemana::set_semana($semana);
        $row_z = gestorSemana::set_semana($semana+1);

        $rs_e  = gestorEstudiante::get_estudiante_reporte($data1);

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->AddPage();

        $pdf->SetFont(FONT_BOLD,'',25);
        $pdf->SetWidths(array(150));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array("REPORTE MIS METAS ETA"),12,0);

        $pdf->SetFont(FONT_NAME,'',15);
        $pdf->Row(array($row_c[5]." ".$row_c[1]),10,0);

        $pdf->SetFont(FONT_NAME,'B',10);

        $pdf->SetFillColor(166,166,166);
        $pdf->SetWidths(array(15,60,20,25,20,12,20,10,26,25,21));
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C'));
        $pdf->SetFills(array(1,0,1,0,1,0,1,0,1,0,1));

        $arrayName = array("TUTOR:",$nombreTutor,"NIVEL:",$nombreNivel,"GRADO:",$nombreGrado,"SECCION:",$nombreSeccion,"EVALUACIÓN:",$row_s[3],$row_u[3]);
        $pdf->Row($arrayName,10,1);

        $pdf->SetFont(FONT_BOLD,'',15);
        $pdf->ln(5);
        // $pdf->SetFillColor(242,242,242);
        $pdf->SetTextColor(0,0,0);

        $arrayWidth = array(21,78);
        $arrayaling = array('C','C');
        $arrayFills = array(1,1);

        $arrayName = array("COD.","NOMBRES Y APELLIDOS");

        $ancoCelda = 24;

        array_push($arrayName,'ETA '.$row_s[0]);
        array_push($arrayWidth,$ancoCelda);
        array_push($arrayaling,'C');
        array_push($arrayFills,1);

        array_push($arrayName,'META ETA '.($row_s[0]+1));
        array_push($arrayWidth,$ancoCelda);
        array_push($arrayaling,'C');
        array_push($arrayFills,1);

        array_push($arrayName, 'ETA '.$row_z[0]);
        array_push($arrayWidth,$ancoCelda);
        array_push($arrayaling,'C');
        array_push($arrayFills,1);

        $pdf->SetWidths($arrayWidth);
        $pdf->SetAligns($arrayaling);
        $pdf->SetFills($arrayFills);
        $pdf->Row($arrayName,15,1);

        // $pdf->SetFont(FONT_NAME,'',21);
        $a = 0;
        foreach ($rs_e as $row_e){
            $a++;
            $s=0;
            $suma_eta = 0;

            $rows1 = gestorEstudiante::set_estudiante($row_e[3]);
            $rows2 = gestorFicha::set_fichaEstudiante($row_e[3]);

            $valor = 1; //($a%2 == 0) ? 1 : 0;

            $arrayName  = array($rows2[7],$rows1[3]." ".$rows1[4]." ".$rows1[5]);
            $arrayWidth = array(21,78);
            $arrayaling = array('C','C');
            $arrayFills = array($valor,$valor);
            $arrayColor = array(array(255,255,255),array(255,255,255));

            $v_nota = $v_meta = array();

            $data1 = array($rows2[7],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_s[0]);
            $data2 = array($rows2[7],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_z[0]);
            $data3 = array($rows1[0],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_s[0]);

            $rows3 = gestorRegistroEta::get_eta_calificacion_semana($data1,ETA_TABLA);
            $rows4 = gestorRegistroEta::get_eta_calificacion_semana($data2,ETA_TABLA);
            $rows5 = gestorMeta::set_meta_semana($data3);

            $valor_nota1 = empty($rows3[57]) ? 'NSP' : $rows3[57]; $s++;
            $valor_nota2 = empty($rows4[57]) ? 0 : $rows4[57];
            $valor_meta  = empty($rows5[5]) ? 0 : $rows5[5];

            $v_nota1[$row_s[0]] = $valor_nota1;
            $v_nota2[$row_z[0]] = $valor_nota2;
            $v_meta[$row_s[0]]  = $valor_meta;

            $index2 = ($v_meta[$row_s[0]] < $v_nota2[$row_z[0]] ) ?  $row_s[0] : 0;

            $class = ($index2 == 0) ? array(255,255,255) : array(255,184,34);

            $suma_eta += $v_nota1[$rows[0]];

            array_push($arrayName, $v_nota1[$row_s[0]] ); #
            array_push($arrayWidth,$ancoCelda);
            array_push($arrayaling,'C');
            array_push($arrayFills,$valor);

            array_push($arrayName,$v_meta[$row_s[0]]);
            array_push($arrayWidth,$ancoCelda);
            array_push($arrayaling,'C');
            array_push($arrayFills,$valor);
            array_push($arrayColor,array(255,255,255));

            array_push($arrayName,$v_nota2[$row_z[0]]);
            array_push($arrayColor,$class);
            array_push($arrayWidth,$ancoCelda);
            array_push($arrayaling,'C');
            array_push($arrayFills,$valor);
            array_push($arrayColor,array(255,255,255));

            $pdf->SetWidths($arrayWidth);
            $pdf->SetAligns($arrayaling);
            $pdf->SetFills($arrayFills);
            $pdf->Setcolors($arrayColor);

            $pdf->SetFont(FONT_NAME,'',12);
            $pdf->Row_Colors($arrayName,10,1);
        }

        $pdf->output();
    }

    function reporte_eta_sabana($data)
    {
        list($unidad,$semana) = $data;

        $data1  = array($_SESSION['tutor']['grado'],$_SESSION['tutor']['seccion'],$_SESSION['tutor']['nivel'],$_SESSION['colegio'][0],$_SESSION['anio'][0]);

        list( $idGrado, $nombreGrado)     = GestorGrado::set_grado($_SESSION['tutor']['grado']);
        list( $idSeccion, $nombreSeccion) = GestorSeccion::set_seccion($_SESSION['tutor']['seccion']);
        list( $idNivel, $nombreNivel)     = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);
        $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
        $row_t = gestorTutor::get_eta_tutor($data1);

        $nombreTutor = $nombreTutor = $row_t[3]." ".$row_t[4]." ".$row_t[5];

        $rs_e    = gestorEstudiante::get_estudiante_reporte($data1);

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->AddPage();

        $pdf->SetFont(FONT_BOLD,'',25);
        $pdf->SetWidths(array(150));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array("REPORTE SÁBANA ETA"),12,0);

        $pdf->SetFont(FONT_NAME,'',15);
        $pdf->Row(array($row_c[5]." ".$row_c[1]),10,0);

        $pdf->SetFont(FONT_NAME,'B',10);

        $pdf->SetFillColor(166,166,166);
        $pdf->SetWidths(array(15,60,20,25,20,12,20,10,26,25,21));
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C'));
        $pdf->SetFills(array(1,0,1,0,1,0,1,0,1,0,1));

        $arrayName = array("TUTOR:",$nombreTutor,"NIVEL:",$nombreNivel,"GRADO:",$nombreGrado,"SECCION:",$nombreSeccion,"EVALUACIÓN:",'',$row_u[3]);
        $pdf->Row($arrayName,10,1);

        $pdf->SetFont(FONT_BOLD,'',15);
        $pdf->ln(5);
        // $pdf->SetFillColor(242,242,242);
        $pdf->SetTextColor(0,0,0);

        $arrayWidth = array(21,78);
        $arrayaling = array('C','C');
        $arrayFills = array(1,1);

        $arrayName = array("COD.","NOMBRES Y APELLIDOS");

        $ancoCelda = 21;

        $rs_s = gestorSemana::get_semanaAcademica($unidad);

        foreach($rs_s as $rows){
            array_push($arrayName,'ETA '.$rows[0]);
            array_push($arrayWidth,$ancoCelda);
            array_push($arrayaling,'C');
            array_push($arrayFills,1);

            array_push($arrayName,'META ETA '.($rows[0]+1));
            array_push($arrayWidth,$ancoCelda);
            array_push($arrayaling,'C');
            array_push($arrayFills,1);
        }

        array_push($arrayName, 'PROM.');
        array_push($arrayWidth,$ancoCelda);
        array_push($arrayaling,'C');
        array_push($arrayFills,1);

        $pdf->SetWidths($arrayWidth);
        $pdf->SetAligns($arrayaling);
        $pdf->SetFills($arrayFills);
        $pdf->Row($arrayName,15,1);

        $pdf->SetFont(FONT_NAME,'',21);
        $a = 0;
        foreach ($rs_e as $row_e){
            $a++;
            $s=0;
            $suma_eta = 0;

            $rows1 = gestorEstudiante::set_estudiante($row_e[3]);
            $rows2 = gestorFicha::set_fichaEstudiante($row_e[3]);

            $valor = 1; //($a%2 == 0) ? 1 : 0;

            $arrayName  = array($rows2[7],$rows1[3]." ".$rows1[4]." ".$rows1[5]);
            $arrayWidth = array(21,78);
            $arrayaling = array('C','C');
            $arrayFills = array($valor,$valor);
            $arrayColor = array(array(255,255,255),array(255,255,255));

            $v_nota = $v_meta = array();

            foreach($rs_s as $row_s){

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
            }

            foreach($rs_s as $rows){

                // $index1 = ($v_meta[$rows[0]] < $v_nota2[$rows[0]+1] ) ? $row_e[3] : $row_e[3];
                $index2 = ($v_meta[$rows[0]] > $v_nota2[$rows[0]+1] ) ?  $rows[0] : 0;

                $class = ($index2 == 0) ? array(255,255,255) : array(255,184,34);

                $suma_eta += $v_nota1[$rows[0]];

                array_push($arrayName, $v_nota1[$rows[0]] ); #
                array_push($arrayColor,$class);
                array_push($arrayWidth,$ancoCelda);
                array_push($arrayaling,'C');
                array_push($arrayFills,$valor);

                array_push($arrayName,$valor_meta);
                array_push($arrayWidth,$ancoCelda);
                array_push($arrayaling,'C');
                array_push($arrayFills,$valor);
                array_push($arrayColor,array(255,255,255));
            }

            array_push($arrayName,round($suma_eta/$s,2));
            array_push($arrayWidth,$ancoCelda);
            array_push($arrayaling,'C');
            array_push($arrayFills,$valor);
            array_push($arrayColor,array(255,255,255));

            $pdf->SetWidths($arrayWidth);
            $pdf->SetAligns($arrayaling);
            $pdf->SetFills($arrayFills);
            $pdf->Setcolors($arrayColor);

            $pdf->SetFont(FONT_NAME,'',21);
            $pdf->Row_Colors($arrayName,51,1);
        }

        $pdf->output();
    }

    function reporte_eta_cuadro($data)
    {
        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);

        list( $idGrado, $nombreGrado)     = GestorGrado::set_grado($_SESSION['tutor']['grado']);
        list( $idSeccion, $nombreSeccion) = GestorSeccion::set_seccion($_SESSION['tutor']['seccion']);
        list( $idNivel, $nombreNivel)     = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $mayorPuntaje  = JsonHandler::$mayorPuntaje;
        $menorPuntaje  = JsonHandler::$menorPuntaje;
        $notaAnterior  = JsonHandler::$notaAnterior;
        $notaActual    = JsonHandler::$notaActual;

        $mayorError    = JsonHandler::$mayorError;
        $menorError    = JsonHandler::$menorError;
        $errorAnterior = JsonHandler::$errorAnterior;
        $errorActual   = JsonHandler::$errorActual;

        $meritoGrupo = JsonHandler::$meritoGrupo;
        $meritoAula  = JsonHandler::$meritoAula;

        $cursoMayor = JsonHandler::$cursoMayor;
        $cursoMenor = JsonHandler::$cursoMenor;

        $cantidad = 5;
        $merito = $aula = "";
        $nro = $pts = 0;

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->AddPage();

        $pdf->setY(14);
        $pdf->SetFont(FONT_NAME,'B',25);
        $pdf->SetWidths(array(300));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array("ANALISIS DE RESULTADO SEMANAL"),12,0);

        $pdf->SetFont(FONT_NAME,'',15);
        $pdf->Row(array($row_c[5]." ".$row_c[1]." | ".JsonHandler::$semanaEta),10,0);

        $pdf->SetFont(FONT_NAME,'',12);

        $pos_x = 14;
        $pos_y = 45;
        $altura = 5;
        $anchoCelda = 20;
        $altura_x = 18;
        $altura_y = 60;


        $pdf->SetFillColor(242,242,242);
        $pdf->SetTextColor(0,0,0);

        $pdf->SetFont(FONT_NAME,'B',12);
        $pdf->MultiCell(180,$altura_x,'ANÁLISIS DE RESULTADOS SEMANAL',1, 'C', 1, 0, $pos_x, $pos_y, true, 0, false, true, $altura_x, 'M');
        $pdf->MultiCell(90,$altura_x,"META DEL AULA: ".JsonHandler::$metaAula."% \nPROMEDIO META: ".JsonHandler::$metaEta."%",1, 'C', 1, 0, $pos_x+180, $pos_y, true, 0, false, true, $altura_x, 'M');

        $pdf->SetFont(FONT_NAME,'',12);

        $pdf->setCellPaddings(6, 0, 2, 0);
        $pdf->MultiCell(90,$altura_y,"PROMEDIO ANTERIOR: ".$notaAnterior."\n\nPROMEDIO ACTUAL: ".$notaActual." \n\nPROMEDIO MAYOR DEL AULA: ".$mayorPuntaje."\n\nPROMEDIO MENOR DEL AULA: ".$menorPuntaje,1, 'L', 0, 0, $pos_x, $pos_y+=$altura_x, true, 0, false, true, $altura_y, 'M');

        $pdf->setCellPaddings(6, 0, 2, 0);
        $pdf->MultiCell(90,$altura_y,"PROMEDIO ANTERIOR: ".$errorAnterior."\n\nPROMEDIO ACTUAL: ".$errorActual."\n\nPROMEDIO MAYOR DEL AULA: ".$mayorError."\n\nPROMEDIO MENOR DEL AULA: ".$menorError,1, 'L',0, 0, $pos_x+90, $pos_y, true, 0, false, true, $altura_y, 'M');

        $pdf->MultiCell(90,$altura_y, $cursoMayor ,1, 'C', 0, 0, $pos_x+180, $pos_y, true, 0, false, true, $altura_y, 'M');

        $pdf->SetFont(FONT_NAME,'',11);
        $pdf->setCellPaddings(6, 0, 2, 0);
        $pdf->MultiCell(90,$altura_y,$meritoGrupo,1, 'L', 0, 0, $pos_x, $pos_y+=$altura_y, true, 0, false, true, $altura_y, 'M');

        $pdf->setCellPaddings(6, 0, 2, 0);
        $pdf->MultiCell(90,$altura_y,$meritoAula,1, 'L', 0, 0, $pos_x+90, $pos_y, true, 0, false, true, $altura_y, 'M');

        $pdf->SetFont(FONT_NAME,'',12);
        $pdf->MultiCell(90,$altura_y,$cursoMenor,1, 'C', 0, 0, $pos_x+180, $pos_y, true, 0, false, true, $altura_y, 'M');

        $pdf->output();
    }

    // ETA II
    function reporte_etas_aula($data)
    {
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

        $nombreTutor = $nombreTutor = $row_t[3]." ".$row_t[4]." ".$row_t[5];

        $r_eta        = gestorRegistroEta::get_eta_configuracion(ETA);
        $CantCampo    = gestorRegistroEta::get_registro_campos(ETA_TABLA);
        $CantPregunta = $r_eta[2];
        $CantUsuario  = $r_eta[3];
        $CantDetalle  = $r_eta[4];

        $inicioRespuestaCorrecta = $CantUsuario + $CantPregunta + $CantDetalle;
        $inicioTotalCalificacion = $CantUsuario + $CantPregunta;

        $mg=1;

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->AddPage();

        $pdf->SetFont(FONT_BOLD,'',25);
        $pdf->SetWidths(array(150));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array("REPORTE ETA POR AULA"),12,0);

        $pdf->SetFont(FONT_NAME,'',15);
        $pdf->Row(array($row_c[5]." ".$row_c[1]),10,0);

        $pdf->SetFont(FONT_NAME,'B',10);

        $pdf->SetFillColor(166,166,166);
        $pdf->SetWidths(array(15,60,20,25,20,12,20,10,26,25,18,15,21));
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C','C'));
        $pdf->SetFills(array(1,0,1,0,1,0,1,0,1,0,1,1,0));

        $arrayName = array("TUTOR:",$nombreTutor,"NIVEL:",$nombreNivel,"GRADO:",$nombreGrado,"SECCION:",$nombreSeccion,"EVALUACIÓN:",$row_s[3],$row_u[3],"FECHA:",$row_r[7]);
        $pdf->Row($arrayName,10,1);

        $pos_x  = 5;
        $pos_y  = 55;
        $altura = 10;
        $valor  = 0;
        $pdf->SetFont(FONT_NAME, 'B', 9);
        $pdf->SetFillColor(0,176,240);
        // $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(12,$altura,"COD",1, 'C', $valor, 0, $pos_x, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(100,$altura,"NOMBRE Y APELLIDO",1, 'C', $valor, 0, $pos_x+12, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(10,$altura,"MG",1, 'C', $valor, 0, $pos_x+112, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(30,$altura,"CORRECTAS",1, 'C', $valor, 0, $pos_x+122, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(30,$altura,"INCORRECTAS",1, 'C', $valor, 0, $pos_x+152, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(30,$altura,"BLANCO",1, 'C', $valor, 0, $pos_x+182, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(30,$altura,"PORCENTAJE",1, 'C', $valor, 0, $pos_x+212, $pos_y, true, 0, false, true, $altura, 'M');

        $pos_xc = $pos_x+242;
        $pdf->MultiCell(30,$altura,'PUNTAJE',1, 'C', $valor, 0, $pos_xc, $pos_y, true, 0, false, true, $altura, 'M');

        $pos_x = 5;
        $pos_y = 55;
        $altura = 10;
        $altura_x = 5;

        $mg=0;

        $suma_nota = array();

        $pdf->SetFont(FONT_NAME, '', 10);

        $suma_buena = $suma_mala = $suma_blanco = $suma_proc = $suma_nota = 0 ;

        foreach($rs_e as $rows){
            $mg++;

            $y_start = $pdf->GetY();

            $valor = ($mg%2 == 0) ? 1 : 0;

            $pdf->SetFillColor(242,242,242);
            $pdf->SetTextColor(0,0,0);
            $pdf->MultiCell(12,$altura,$rows[3],1, 'C', $valor, 0, $pos_x, $y_start+10, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(100,$altura,$rows[4]." ".$rows[5],1, 'C', $valor, 0, $pos_x+12, $y_start+10, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(10,$altura,$mg.'°',1, 'C', $valor, 0, $pos_x+112, $y_start+10, true, 0, false, true, $altura, 'M');

            $pos_xc     = $pos_x+122;
            $anchoCelda = 30;

            $pdf->SetFont(FONT_NAME, '', 9);

            for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {

                $suma_buena += $rows[$j];
                $pdf->MultiCell($anchoCelda,$altura, $rows[$j] ,1, 'C', $valor, 0, $pos_xc, $y_start+10, true, 0, false, true, $altura, 'M');
                $pos_xc+=$anchoCelda;

                $suma_mala += $rows[$j+1];
                $pdf->MultiCell($anchoCelda,$altura, $rows[$j+1] ,1, 'C', $valor, 0, $pos_xc, $y_start+10, true, 0, false, true, $altura, 'M');
                $pos_xc+=$anchoCelda;

                $suma_blanco += $rows[$j+2];
                $pdf->MultiCell($anchoCelda,$altura, $rows[$j+2] ,1, 'C', $valor, 0, $pos_xc, $y_start+10, true, 0, false, true, $altura, 'M');
                $pos_xc+=$anchoCelda;
            }

            $suma_proc += $rows[$inicioTotalCalificacion+3];
            $pdf->MultiCell($anchoCelda,$altura,$rows[$inicioTotalCalificacion+3].'%',1, 'C', $valor, 0, $pos_xc , $y_start+10, true, 0, false, true, $altura, 'M'); #-- NOTA CURSO

            $suma_nota += $rows[$inicioTotalCalificacion+4];
            $pdf->MultiCell($anchoCelda,$altura,$rows[$inicioTotalCalificacion+4] ,1, 'C', $valor, 0, $pos_xc+$anchoCelda , $y_start+10, true, 0, false, true, $altura, 'M'); #-- PORCENTAJE NOTA


        $pdf->pagebreak(15);

        }

        $y_start = $pdf->GetY()+10;
        $valor = 0;

        $pdf->SetFillColor(242,242,242);
        $pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(122,$altura,'PROMEDIOS',1, 'C', $valor, 0, $pos_x, $y_start, true, 0, false, true, $altura, 'M');

        $pos_x      = 5;
        $pos_xc     = $pos_x + 122;
        $anchoCelda = 30;

        $pdf->SetFont(FONT_NAME, 'B', 9);

        for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {
            $pdf->MultiCell($anchoCelda,$altura, round($suma_buena/$mg) ,1, 'C', $valor, 0, $pos_xc, $y_start, true, 0, false, true, $altura, 'M');
            $pos_xc+=$anchoCelda;

            $pdf->MultiCell($anchoCelda,$altura, round($suma_mala/$mg),1, 'C', $valor, 0, $pos_xc, $y_start, true, 0, false, true, $altura, 'M');
            $pos_xc+=$anchoCelda;

            $pdf->MultiCell($anchoCelda,$altura, round($suma_blanco/$mg) ,1, 'C', $valor, 0, $pos_xc, $y_start, true, 0, false, true, $altura, 'M');
            $pos_xc+=$anchoCelda;
        }

        $pdf->MultiCell($anchoCelda,$altura, round($suma_proc/$mg).'%', 1, 'C', $valor, 0, $pos_xc , $y_start, true, 0, false, true, $altura, 'M'); #-- NOTA CURSO
        $pdf->MultiCell($anchoCelda,$altura, round($suma_nota/$mg,2) ,1, 'C', $valor, 0, $pos_xc+$anchoCelda , $y_start, true, 0, false, true, $altura, 'M'); #-- PORCENTAJE NOTA


        $pdf->output();
    }

    function reporte_etas_grado($data)
    {
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

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->AddPage();

        $pdf->SetFont(FONT_BOLD,'',25);
        $pdf->SetWidths(array(150));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array("REPORTE ETA POR GRADO"),12,0);

        $pdf->SetFont(FONT_NAME,'',15);
        $pdf->Row(array($row_c[5]." ".$row_c[1]),10,0);

        $pdf->SetFont(FONT_NAME,'B',10);
        $pdf->SetFillColor(166,166,166);
        $pdf->SetWidths(array(18,60,20,25,20,12,20,10,26,21,19,15,22));
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C','C','C'));
        $pdf->SetFills(array(1,0,1,0,1,0,1,0,1,0,1,1,0));


        $arrayName = array("TUTORES:",$nombreTutor[0]." ".$nombreTutor[1],"NIVEL:",$nombreNivel,"GRADO:",$nombreGrado,"SECCION:",$nombreSeccion[0]."|".$nombreSeccion[1],"EVALUACIÓN:",$row_s[3],$row_u[3],"FECHA:",$row_s[4]);
        $pdf->Row($arrayName,10,1);

        $pos_x  = 5;
        $pos_y  = 55;
        $altura = 10;
        $valor  = 0;
        $pdf->SetFont(FONT_NAME, 'B', 9);
        $pdf->SetFillColor(0,176,240);
        // $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(12,$altura,"COD",1, 'C', $valor, 0, $pos_x, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(90,$altura,"NOMBRE Y APELLIDO",1, 'C', $valor, 0, $pos_x+12, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(10,$altura,"MG",1, 'C', $valor, 0, $pos_x+102, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(20,$altura,"SECCION",1, 'C', $valor, 0, $pos_x+112, $pos_y, true, 0, false, true, $altura, 'M');

        $pdf->MultiCell(30,$altura,"CORRECTAS",1, 'C', $valor, 0, $pos_x+132, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(30,$altura,"INCORRECTAS",1, 'C', $valor, 0, $pos_x+162, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(30,$altura,"BLANCO",1, 'C', $valor, 0, $pos_x+192, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(30,$altura,"PORCENTAJE",1, 'C', $valor, 0, $pos_x+222, $pos_y, true, 0, false, true, $altura, 'M');

        $pos_xc = $pos_x+252;
        $pdf->MultiCell(30,$altura,'PUNTAJE',1, 'C', $valor, 0, $pos_xc, $pos_y, true, 0, false, true, $altura, 'M');

        $pos_x = 5;
        $pos_y = 55;
        $altura = 10;
        $altura_x = 5;
        $mg = 0;

        $pdf->SetFont(FONT_NAME, '', 9);
        $suma_buena = $suma_mala = $suma_blanco = $suma_proc = $suma_nota = 0 ;
        foreach($rs_e as $rows){
            $mg++;

            $y_start = $pdf->GetY();

            $valor = ($mg%2 == 0) ? 1 : 0;

            $pdf->SetFillColor(242,242,242);
            $pdf->SetTextColor(0,0,0);
            $pdf->MultiCell(12,$altura,$rows[3],1, 'C', $valor, 0, $pos_x, $y_start+10, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(90,$altura,$rows[4]." ".$rows[5],1, 'C', $valor, 0, $pos_x+12, $y_start+10, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(10,$altura,$mg.'°',1, 'C', $valor, 0, $pos_x+102, $y_start+10, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(20,$altura,$rows[7],1, 'C', $valor, 0, $pos_x+112, $y_start+10, true, 0, false, true, $altura, 'M');

            $pos_xc     = $pos_x+132;
            $anchoCelda = 30;

            for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {

                $suma_buena += $rows[$j];
                $pdf->MultiCell($anchoCelda,$altura, $rows[$j] ,1, 'C', $valor, 0, $pos_xc, $y_start+10, true, 0, false, true, $altura, 'M');
                $pos_xc+=$anchoCelda;

                $suma_mala += $rows[$j+1];
                $pdf->MultiCell($anchoCelda,$altura, $rows[$j+1] ,1, 'C', $valor, 0, $pos_xc, $y_start+10, true, 0, false, true, $altura, 'M');
                $pos_xc+=$anchoCelda;

                $suma_blanco += $rows[$j+2];
                $pdf->MultiCell($anchoCelda,$altura, $rows[$j+2] ,1, 'C', $valor, 0, $pos_xc, $y_start+10, true, 0, false, true, $altura, 'M');
                $pos_xc+=$anchoCelda;
            }

            $suma_proc += $rows[$inicioTotalCalificacion+3];
            $pdf->MultiCell($anchoCelda,$altura,$rows[$inicioTotalCalificacion+3].'%',1, 'C', $valor, 0, $pos_xc , $y_start+10, true, 0, false, true, $altura, 'M'); #-- NOTA CURSO

            $suma_nota += $rows[$inicioTotalCalificacion+4];
            $pdf->MultiCell($anchoCelda,$altura,$rows[$inicioTotalCalificacion+4] ,1, 'C', $valor, 0, $pos_xc+$anchoCelda , $y_start+10, true, 0, false, true, $altura, 'M'); #-- PORCENTAJE NOTA

            $pdf->pagebreak(15);
        }

        $y_start = $pdf->GetY()+10;

        $valor = 0;

        $pdf->SetFillColor(242,242,242);
        $pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(132,$altura,'PROMEDIOS',1, 'C', $valor, 0, $pos_x, $y_start, true, 0, false, true, $altura, 'M');

        $pos_x      = 5;
        $pos_xc     = $pos_x + 132;
        $anchoCelda = 30;

        $pdf->SetFont(FONT_NAME, 'B', 9);

        for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {
            $pdf->MultiCell($anchoCelda,$altura, round($suma_buena/$mg) ,1, 'C', $valor, 0, $pos_xc, $y_start, true, 0, false, true, $altura, 'M');
            $pos_xc+=$anchoCelda;

            $pdf->MultiCell($anchoCelda,$altura, round($suma_mala/$mg),1, 'C', $valor, 0, $pos_xc, $y_start, true, 0, false, true, $altura, 'M');
            $pos_xc+=$anchoCelda;

            $pdf->MultiCell($anchoCelda,$altura, round($suma_blanco/$mg) ,1, 'C', $valor, 0, $pos_xc, $y_start, true, 0, false, true, $altura, 'M');
            $pos_xc+=$anchoCelda;
        }

        $pdf->MultiCell($anchoCelda,$altura, round($suma_proc/$mg).'%', 1, 'C', $valor, 0, $pos_xc , $y_start, true, 0, false, true, $altura, 'M'); #-- NOTA CURSO
        $pdf->MultiCell($anchoCelda,$altura, round($suma_nota/$mg,2) ,1, 'C', $valor, 0, $pos_xc+$anchoCelda , $y_start, true, 0, false, true, $altura, 'M'); #-- PORCENTAJE NOTA

        $pdf->output();
    }

    function reporte_etas_grupo($data)
    {

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

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, 20);
        $pdf->AddPage();

        $pdf->SetFont(FONT_BOLD,'',25);
        $pdf->SetWidths(array(150));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array("REPORTE ETA POR GRUPO"),12,0);

        $pdf->SetFont(FONT_NAME,'',15);
        $pdf->Row(array($row_c[5]." ".$row_c[1]),10,0);

        $pdf->SetFont(FONT_NAME,'B',10);

        $pdf->SetFillColor(166,166,166);
        $pdf->SetWidths(array(20,25,20,30,20,10,26,28,20,15,25));
        $pdf->SetAligns(array('C','C','C','C','C','C','C','C','C','C','C'));
        $pdf->SetFills(array(1,0,1,0,1,0,1,0,1,1,0));

        $arrayName = array("NIVEL:",$nombreNivel,"GRADO:",$nombreGrado[0]."|".$nombreGrado[2],"SECCION:",$nombreSeccion[0]."|".$nombreSeccion[1],"EVALUACIÓN:",$row_s[3],$row_u[3]);
        $pdf->Row($arrayName,10,1);

        $pos_x = 5;
        $pos_y = 55;
        $altura = 15;
        $valor  = 0;
        $pdf->SetFont(FONT_NAME, 'B', 9);
        $pdf->SetFillColor(0,176,240);
        // $pdf->SetTextColor(255,255,255);
        $pdf->MultiCell(12,$altura,"COD",1, 'C', $valor, 0, $pos_x, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(100,$altura,"NOMBRE Y APELLIDO",1, 'C', $valor, 0, $pos_x+12, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(10,$altura,"MG",1, 'C', $valor, 0, $pos_x+112, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(30,$altura,"CORRECTAS",1, 'C', $valor, 0, $pos_x+122, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(30,$altura,"INCORRECTAS",1, 'C', $valor, 0, $pos_x+152, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(30,$altura,"BLANCO",1, 'C', $valor, 0, $pos_x+182, $pos_y, true, 0, false, true, $altura, 'M');
        $pdf->MultiCell(30,$altura,"PORCENTAJE",1, 'C', $valor, 0, $pos_x+212, $pos_y, true, 0, false, true, $altura, 'M');

        $pos_xc = $pos_x+242;
        $pdf->MultiCell(30,$altura,'PUNTAJE',1, 'C', $valor, 0, $pos_xc, $pos_y, true, 0, false, true, $altura, 'M');

        $mg=0;

        $suma_nota = array();

        $pdf->SetFont(FONT_NAME, '', 10);
        $suma_buena = $suma_mala = $suma_blanco = $suma_proc = $suma_nota = 0 ;
        foreach($rs_e as $rows){
            $mg++;
            $page_start = $pdf->getPage();
            $y_start = $pdf->GetY();

            $valor = ($mg%2 == 0) ? 1 : 0;

            $pdf->SetFillColor(242,242,242);
            $pdf->SetTextColor(0,0,0);
            $pdf->MultiCell(12,$altura,$rows[3],1, 'C', $valor, 0, $pos_x, $y_start+15, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(100,$altura,$rows[4]." ".$rows[5]."\n ( ".$rows[6]." ".$rows[7]." ".$rows[8]." )",1, 'C', $valor, 0, $pos_x+12, $y_start+15, true, 0, false, true, $altura, 'M');
            $pdf->MultiCell(10,$altura,$mg.'°',1, 'C', $valor, 0, $pos_x+112, $y_start+15, true, 0, false, true, $altura, 'M');

            $pos_xc     = $pos_x+122;
            $anchoCelda = 30;

            $pdf->SetFont(FONT_NAME, '', 9);

            for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {

                $suma_buena += $rows[$j];
                $pdf->MultiCell($anchoCelda,$altura, $rows[$j] ,1, 'C', $valor, 0, $pos_xc, $y_start+15, true, 0, false, true, $altura, 'M');
                $pos_xc+=$anchoCelda;

                $suma_mala += $rows[$j+1];
                $pdf->MultiCell($anchoCelda,$altura, $rows[$j+1] ,1, 'C', $valor, 0, $pos_xc, $y_start+15, true, 0, false, true, $altura, 'M');
                $pos_xc+=$anchoCelda;

                $suma_blanco += $rows[$j+2];
                $pdf->MultiCell($anchoCelda,$altura, $rows[$j+2] ,1, 'C', $valor, 0, $pos_xc, $y_start+15, true, 0, false, true, $altura, 'M');
                $pos_xc+=$anchoCelda;
            }

            $suma_proc += $rows[$inicioTotalCalificacion+3];
            $pdf->MultiCell($anchoCelda,$altura,$rows[$inicioTotalCalificacion+3].'%',1, 'C', $valor, 0, $pos_xc , $y_start+15, true, 0, false, true, $altura, 'M'); #-- NOTA CURSO

            $suma_nota += $rows[$inicioTotalCalificacion+4];
            $pdf->MultiCell($anchoCelda,$altura,$rows[$inicioTotalCalificacion+4] ,1, 'C', $valor, 0, $pos_xc+$anchoCelda , $y_start+15, true, 0, false, true, $altura, 'M'); #-- PORCENTAJE NOTA

            $pdf->pagebreak(15);
        }

        $y_start = $pdf->GetY()+15;
        $valor = 0;

        $pdf->SetFillColor(242,242,242);
        $pdf->SetTextColor(0,0,0);
        $pdf->MultiCell(122,$altura,'PROMEDIOS',1, 'C', $valor, 0, $pos_x, $y_start, true, 0, false, true, $altura, 'M');

        $pos_x      = 5;
        $pos_xc     = $pos_x + 122;
        $anchoCelda = 30;

        $pdf->SetFont(FONT_NAME, 'B', 9);

        for ($j = $inicioTotalCalificacion ; $j < ($inicioTotalCalificacion+4) ;$j+=$CantDetalle) {
            $pdf->MultiCell($anchoCelda,$altura, round($suma_buena/$mg) ,1, 'C', $valor, 0, $pos_xc, $y_start, true, 0, false, true, $altura, 'M');
            $pos_xc+=$anchoCelda;

            $pdf->MultiCell($anchoCelda,$altura, round($suma_mala/$mg),1, 'C', $valor, 0, $pos_xc, $y_start, true, 0, false, true, $altura, 'M');
            $pos_xc+=$anchoCelda;

            $pdf->MultiCell($anchoCelda,$altura, round($suma_blanco/$mg) ,1, 'C', $valor, 0, $pos_xc, $y_start, true, 0, false, true, $altura, 'M');
            $pos_xc+=$anchoCelda;
        }

        $pdf->MultiCell($anchoCelda,$altura, round($suma_proc/$mg).'%', 1, 'C', $valor, 0, $pos_xc , $y_start, true, 0, false, true, $altura, 'M'); #-- NOTA CURSO
        $pdf->MultiCell($anchoCelda,$altura, round($suma_nota/$mg,2) ,1, 'C', $valor, 0, $pos_xc+$anchoCelda , $y_start, true, 0, false, true, $altura, 'M'); #-- PORCENTAJE NOTA


        $pdf->output();
    }

    function reporte_etas_cuadro($data)
    {
        $row_c = gestorColegio::set_colegio($_SESSION['colegio'][0]);

        list( $idGrado, $nombreGrado)     = GestorGrado::set_grado($_SESSION['tutor']['grado']);
        list( $idSeccion, $nombreSeccion) = GestorSeccion::set_seccion($_SESSION['tutor']['seccion']);
        list( $idNivel, $nombreNivel)     = GestorNivel::set_nivel($_SESSION['tutor']['nivel']);

        $mayorPuntaje  = JsonHandler::$mayorPuntaje;
        $menorPuntaje  = JsonHandler::$menorPuntaje;
        $notaAnterior  = JsonHandler::$notaAnterior;
        $notaActual    = JsonHandler::$notaActual;

        $mayorError    = JsonHandler::$mayorError;
        $menorError    = JsonHandler::$menorError;
        $errorAnterior = JsonHandler::$errorAnterior;
        $errorActual   = JsonHandler::$errorActual;

        $meritoGrupo = JsonHandler::$meritoGrupo;
        $meritoAula  = JsonHandler::$meritoAula;

        $cursoMayor = JsonHandler::$cursoMayor;
        $cursoMenor = JsonHandler::$cursoMenor;

        $cantidad = 5;
        $merito = $aula = "";
        $nro = $pts = 0;

        $pdf = new MYPDF(PAGE_ORIENTATION,'mm','A4');
        $pdf->SetMargins(MARGIN_RIGHT,MARGIN_TOP, MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(5);
        $pdf->setPrintHeader(true); //no imprime la cabecera ni la linea
        $pdf->setPrintFooter(true);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->AddPage();

        $pdf->setY(14);
        $pdf->SetFont(FONT_NAME,'B',25);
        $pdf->SetWidths(array(300));
        $pdf->SetAligns(array('L'));
        $pdf->Row(array("ANALISIS DE RESULTADO SEMANAL"),12,0);

        $pdf->SetFont(FONT_NAME,'',15);
        $pdf->Row(array($row_c[5]." ".$row_c[1]." | ".JsonHandler::$semanaEta),10,0);

        $pdf->SetFont(FONT_NAME,'',12);

        $pos_x = 14;
        $pos_y = 45;
        $altura = 5;
        $anchoCelda = 20;
        $altura_x = 18;
        $altura_y = 60;


        $pdf->SetFillColor(242,242,242);
        $pdf->SetTextColor(0,0,0);

        $pdf->SetFont(FONT_NAME,'B',12);
        $pdf->MultiCell(180,$altura_x,'ANÁLISIS DE RESULTADOS SEMANAL',1, 'C', 1, 0, $pos_x, $pos_y, true, 0, false, true, $altura_x, 'M');
        $pdf->MultiCell(90,$altura_x,"META DEL AULA: ".JsonHandler::$metaAula."% \nPROMEDIO META: ".JsonHandler::$metaEta."%",1, 'C', 1, 0, $pos_x+180, $pos_y, true, 0, false, true, $altura_x, 'M');

        $pdf->SetFont(FONT_NAME,'',12);

        $pdf->setCellPaddings(6, 0, 2, 0);
        $pdf->MultiCell(90,$altura_y,"PROMEDIO ANTERIOR: ".$notaAnterior."\n\nPROMEDIO ACTUAL: ".$notaActual." \n\nPROMEDIO MAYOR DEL AULA: ".$mayorPuntaje."\n\nPROMEDIO MENOR DEL AULA: ".$menorPuntaje,1, 'L', 0, 0, $pos_x, $pos_y+=$altura_x, true, 0, false, true, $altura_y, 'M');

        $pdf->setCellPaddings(6, 0, 2, 0);
        $pdf->MultiCell(90,$altura_y,"PROMEDIO ANTERIOR: ".$errorAnterior."\n\nPROMEDIO ACTUAL: ".$errorActual."\n\nPROMEDIO MAYOR DEL AULA: ".$mayorError."\n\nPROMEDIO MENOR DEL AULA: ".$menorError,1, 'L',0, 0, $pos_x+90, $pos_y, true, 0, false, true, $altura_y, 'M');

        $pdf->MultiCell(90,$altura_y, $cursoMayor ,1, 'C', 0, 0, $pos_x+180, $pos_y, true, 0, false, true, $altura_y, 'M');

        $pdf->SetFont(FONT_NAME,'',11);
        $pdf->setCellPaddings(6, 0, 2, 0);
        $pdf->MultiCell(90,$altura_y,$meritoGrupo,1, 'L', 0, 0, $pos_x, $pos_y+=$altura_y, true, 0, false, true, $altura_y, 'M');

        $pdf->setCellPaddings(6, 0, 2, 0);
        $pdf->MultiCell(90,$altura_y,$meritoAula,1, 'L', 0, 0, $pos_x+90, $pos_y, true, 0, false, true, $altura_y, 'M');

        $pdf->SetFont(FONT_NAME,'',12);
        $pdf->MultiCell(90,$altura_y,$cursoMenor,1, 'C', 0, 0, $pos_x+180, $pos_y, true, 0, false, true, $altura_y, 'M');

        $pdf->output();
    }
?>
