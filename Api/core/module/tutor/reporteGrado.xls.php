<?php
    // include_once '../../../conf.ini.php';
    require_once 'tutorReporteExcel.php';
    $arrayName = array();
    array_push($arrayName, $_REQUEST['unidad']);
    array_push($arrayName, $_REQUEST['semana']);
    switch ($_SESSION['tutor']['grado']) {
        case 1 : case 2: case 3:
            reporte_eta_grado($arrayName);
            break;
        case 5 : case 4:
            reporte_etas_grado($arrayName);
            break;
        default:
            reporte_eta_grado($arrayName);
            break;
    }
?>