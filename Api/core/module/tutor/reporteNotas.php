<?php

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
    }

    $JsonHandler = new JsonHandler();

    list($unidad,$semana,$grupo) = $data;

    $CantCampo    = gestorRegistroEta::get_registro_campos('tb_eta_calificacion1');
    $CantPregunta = 45;
    $CantUsuario  = 9;
    $CantDetalle  = 5;

    $inicioRespuestaCorrecta = $CantUsuario + $CantPregunta + $CantDetalle;
    $inicioTotalCalificacion = $CantUsuario + $CantPregunta;

    $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0]));
    $row_s = gestorSemana::set_semana($semana);

    $data1 = array($grupo,$_SESSION['colegio'][0],$_SESSION['anio'][0],$semana);

    $eta1 = array($_SESSION['tutor']['grado'],$_SESSION['tutor']['seccion'],$_SESSION['tutor']['nivel'],$_SESSION['colegio'][0],$_SESSION['anio'][0],$semana-1);
    $eta2 = array($_SESSION['tutor']['grado'],$_SESSION['tutor']['seccion'],$_SESSION['tutor']['nivel'],$_SESSION['colegio'][0],$_SESSION['anio'][0],$semana);

    $punt_mayor = empty(gestorRegistroEta::get_eta_maximo($eta2)) ? 0 : gestorRegistroEta::get_eta_maximo($eta2);
    $punt_menor = empty(gestorRegistroEta::get_eta_minimo($eta2)) ? 0 : gestorRegistroEta::get_eta_minimo($eta2);

    $erro_mayor = empty(gestorRegistroEta::get_eta_maximo_error($eta2)) ? 0 : gestorRegistroEta::get_eta_maximo_error($eta2);
    $erro_menor = empty(gestorRegistroEta::get_eta_minimo_error($eta2)) ? 0 : gestorRegistroEta::get_eta_minimo_error($eta2);

    $re1 = gestorRegistroEta::get_eta_calificacion($eta1,0);


    if($re1){
        $a = 0;
        $suma_nota = $suma_mala = array();
        foreach($re1 as $rows){
            $a++;
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
            $prom_suma += round($suma_nota[$u]/$a,2);
        }

        for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {
            $prom_mala += round($suma_mala[$j+1]/$a,2);
        }

        JsonHandler::$notaAnterior  = round($prom_suma/$cont,2);
        JsonHandler::$errorAnterior = round($prom_mala);

    } else {

        JsonHandler::$notaAnterior  = 0;
        JsonHandler::$errorAnterior = 0;
    }


    //////////////////////////////////////////////////

    $re2 = gestorRegistroEta::get_eta_calificacion($eta2,0);

    $a = 0;
    $suma_nota = $suma_mala = array();
    foreach($re2 as $rows){
        $a++;
        $cont = 0;

        JsonHandler::$meritoAula .= $a.'° '.$rows[4]." ".$rows[5]."\n";

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
        $prom_suma += round($suma_nota[$u]/$a,2);
    }

    for ($j = $inicioRespuestaCorrecta ; $j <= ($CantCampo-4) ;$j+=$CantDetalle) {
        $prom_mala += round($suma_mala[$j+1]/$a,2);
    }

    JsonHandler::$notaActual   = round($prom_suma/$cont,2);
    JsonHandler::$mayorPuntaje = round($punt_mayor[0]/$cont,2);
    JsonHandler::$menorPuntaje = round($punt_menor[0]/$cont,2);

    JsonHandler::$errorActual  = round($prom_mala);
    JsonHandler::$mayorError   = $erro_mayor[0];
    JsonHandler::$menorError   = $erro_menor[0]

    $rs_e = gestorRegistroEta::get_eta_calificacion_grupo($data1,5);

    foreach($rs_e as $rows){
        $mg++;
        JsonHandler::$meritoGrupo .= $mg.'° '.$rows[4]." ".$rows[5]."\n";
    }




?>

