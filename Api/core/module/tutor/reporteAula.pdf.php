<?php
    require_once '../../gestorReporte.php';
    $data = array($_REQUEST['unidad'],$_REQUEST['semana']);
    define ('PAGE_ORIENTATION','L');
    require_once 'tutorReporte.php';
    switch ($_SESSION['tutor']['grado']) {
        case 1 : case 2: case 3:
            reporte_eta_aula($data);
            break;
        case 5 : case 4:
            reporte_etas_aula($data);
            break;
        default:
            reporte_eta_aula($data);
            break;
    }
?>