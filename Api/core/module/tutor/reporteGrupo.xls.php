<?php
    // include_once '../../../conf.ini.php';
    require_once 'tutorReporteExcel.php';
    $arrayName = array();
    array_push($arrayName, $_REQUEST['unidad']);
    array_push($arrayName, $_REQUEST['semana']);

    switch ($_SESSION['tutor']['grado']) {
        case 1 : case 2: case 3:
            array_push($arrayName, 1);
            reporte_eta_grupo($arrayName);
            break;
        case 5 : case 4:
            array_push($arrayName, 2);
            reporte_etas_grupo($arrayName);
            break;
        default:
            array_push($arrayName, 1);
            reporte_eta_grupo($arrayName);
            break;
    }
?>