<?php
    require_once '../../gestorReporte.php';
    $arrayName = array();
    array_push($arrayName, $_REQUEST['unidad']);
    array_push($arrayName, $_REQUEST['semana']);

    define ('PAGE_ORIENTATION','L');
    require_once 'tutorReporte.php';

    switch ($_SESSION['tutor']['grado']) {
        case 1 : case 2: case 3:
            reporte_eta_grupo($arrayName);
            break;
        case 5 : case 4:
            reporte_etas_grupo($arrayName);
            break;
        default:
            reporte_eta_grupo($arrayName);
            break;
    }
?>