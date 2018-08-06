<?php

    require_once '../../gestorReporte.php';

    $data = array();

    array_push($data, $_REQUEST['unidad']);
    array_push($data, $_REQUEST['semana']);

    // require_once 'reporteNotas.php';

    class JsonHandler
    {
        public static $mayorPuntaje  = '';
        public static $menorPuntaje  = '';
        public static $notaAnterior  = '';
        public static $notaActual    = '';

        public static $mayorError    = '';
        public static $menorError    = '';
        public static $errorAnterior = '';
        public static $errorActual   = '';

        public static $meritoGrupo   = '';
        public static $meritoAula    = '';
        public static $cursoMayor    = '';
        public static $cursoMenor    = '';

        public static $semanaEta     = '';

        public static $metaAula    = '';
        public static $metaEta     = '';
    }

    $JsonHandler = new JsonHandler();

    list($unidad,$semana) = $data;

    $r_eta        = gestorRegistroEta::get_eta_configuracion(ETA);
    $CantCampo    = gestorRegistroEta::get_registro_campos(ETA_TABLA);
    $CantPregunta = $r_eta[2];
    $CantUsuario  = $r_eta[3];
    $CantDetalle  = $r_eta[4];

    $inicioRespuestaCorrecta = $CantUsuario + $CantPregunta + $CantDetalle;
    $inicioTotalCalificacion = $CantUsuario + $CantPregunta;

    $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
    $row_s = gestorSemana::set_semana($semana);

    JsonHandler::$semanaEta = $row_s[3];

    $data1 = array(ETA,$_SESSION['colegio'][0],$_SESSION['anio'][0],$semana);

    $eta1 = array($_SESSION['tutor']['grado'],$_SESSION['tutor']['seccion'],$_SESSION['tutor']['nivel'],$_SESSION['colegio'][0],$_SESSION['anio'][0],$semana-1);
    $eta2 = array($_SESSION['tutor']['grado'],$_SESSION['tutor']['seccion'],$_SESSION['tutor']['nivel'],$_SESSION['colegio'][0],$_SESSION['anio'][0],$semana);

    $punt_mayor = empty(gestorRegistroEta::get_eta_maximo($eta2,ETA_TABLA)) ? 0 : gestorRegistroEta::get_eta_maximo($eta2,ETA_TABLA);
    $punt_menor = empty(gestorRegistroEta::get_eta_minimo($eta2,ETA_TABLA)) ? 0 : gestorRegistroEta::get_eta_minimo($eta2,ETA_TABLA);

    $erro_mayor = empty(gestorRegistroEta::get_eta_maximo_error($eta2,ETA_TABLA)) ? 0 : gestorRegistroEta::get_eta_maximo_error($eta2,ETA_TABLA);
    $erro_menor = empty(gestorRegistroEta::get_eta_minimo_error($eta2,ETA_TABLA)) ? 0 : gestorRegistroEta::get_eta_minimo_error($eta2,ETA_TABLA);


    $rs1  = gestorRegistroEta::get_eta_registro($eta2);
    $rs_p = gestorRegistroEta::get_eta_promedio(array($rs1[0],$_SESSION['anio'][0],ETA),ETA_TABLA);
    $rs_c = gestorCursoEta::get_eta_curso(array($_SESSION['anio'][0],ETA));


    $re1  = gestorRegistroEta::get_eta_calificacion($eta1,0,ETA_TABLA);

    if($re1){
        $mg = 0;
        $suma_nota = $suma_mala = array();
        foreach($re1 as $rows){
            $mg++;
            $cont = 0;
            for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {
                $cont++;
                $suma_nota[$u] += $rows[$u];
            }

            for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {
                 $suma_mala[$j+1] += $rows[$j+1];
            }
        }

        $prom_suma = $prom_mala = 0;

        for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {
            $prom_suma += round($suma_nota[$u]/$mg,2);
        }

        for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {
            $prom_mala += round($suma_mala[$j+1]/$mg,2);
        }

        JsonHandler::$notaAnterior  = round($prom_suma/$cont,2);
        JsonHandler::$errorAnterior = round($prom_mala);

    } else {

        JsonHandler::$notaAnterior  = 0;
        JsonHandler::$errorAnterior = 0;
    }


    //////////////////////////////////////////////////

    $re2 = gestorRegistroEta::get_eta_calificacion($eta2,0,ETA_TABLA);

    $mg = 0;
    $suma_nota = $suma_mala = array();
    foreach($re2 as $rows){
        $mg++;
        $cont = 0;

        for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {
            $cont++;

            $suma_nota[$u] += $rows[$u];
            $suma_proc[$u-1] += $rows[$u-1];
        }

        for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {
            $suma_mala[$j+1] += $rows[$j+1];
        }
    }



    $prom_suma = $prom_mala = $prom_porc = 0;

    for ($u = ($inicioRespuestaCorrecta+4) ; $u <= $CantCampo ; $u+=$CantDetalle) {
        $prom_suma += round($suma_nota[$u]/$mg,2);
        $prom_porc += round($suma_proc[$u-1]/$mg);

    }

    for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {
        $prom_mala += round($suma_mala[$j+1]/$mg,2);
    }


    JsonHandler::$notaActual   = round($prom_suma/$cont,2);
    JsonHandler::$metaEta      = round($prom_porc/$cont,2);

    JsonHandler::$mayorPuntaje = round($punt_mayor[0]/$cont,2);

    JsonHandler::$menorPuntaje = round($punt_menor[0]/$cont,2);

    JsonHandler::$errorActual  = round($prom_mala);
    JsonHandler::$mayorError   = $erro_mayor[0];
    JsonHandler::$menorError   = $erro_menor[0];

    $rs_1 = gestorRegistroEta::get_eta_calificacion_grupo($data1,5,ETA_TABLA);
    $rs_2 = gestorRegistroEta::get_eta_calificacion($eta2,5,ETA_TABLA);

    $data  = array($_SESSION['colegio'][0],$_SESSION['anio'][0],$semana);
    $row_p = gestorMeta::get_meta_porcentaje($data);

    $mg = 0;
    foreach($rs_1 as $rows){
        $mg++;
        JsonHandler::$meritoGrupo .= $mg.'° '.$rows[6]." ".$rows[7]." ".$rows[8]."\n\n";
    }

    $mg = 0;
    foreach($rs_2 as $rows){
        $mg++;
        JsonHandler::$meritoAula .= $mg.'° '.$rows[4]." ".$rows[5]."\n\n";
    }

    JsonHandler::$metaAula = $row_p[0];


    foreach ($rs_p as $x => $row_p) {
        foreach ($rs_c as $y => $row_c) {
            $meritoCurso[] = array(
                'PROMEDIO' => $row_p[$x++],
                'NOMBRE' => $row_c[2]
            );
        }
    }

    foreach ($meritoCurso as $clave => $fila) {
        $volumen[$clave] = $fila['PROMEDIO'];
        $edición[$clave] = $fila['NOMBRE'];
    }

    array_multisort($volumen, SORT_DESC, $edición, SORT_DESC, $meritoCurso);

    $valor = (ETA == 1) ? 3 : 1;

    for ($i=0; $i < $valor; $i++) {
        $cursoMayor .= $meritoCurso[$i]['NOMBRE']."\n\n";
    }

    array_multisort($volumen, SORT_ASC, $edición, SORT_ASC, $meritoCurso);

    for ($i=0; $i < $valor; $i++) {
        $cursoMenor .= $meritoCurso[$i]['NOMBRE']."\n\n";
    }

    JsonHandler::$cursoMayor = $cursoMayor;
    JsonHandler::$cursoMenor = $cursoMenor;


    define ('PAGE_ORIENTATION','L');
    require_once 'tutorReporte.php';

    switch ($_SESSION['tutor']['grado']) {
        case 1 : case 2: case 3:
            reporte_eta_cuadro($data);
            break;
        case 5 : case 4:
            reporte_etas_cuadro($data);
            break;
        default:
            reporte_eta_aula($data);
            break;
    }
?>