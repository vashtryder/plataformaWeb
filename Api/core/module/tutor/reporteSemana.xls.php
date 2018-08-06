<?php
    require_once '../../gestorReporte.php';
    $data = array();
    array_push($data, $_REQUEST['unidad']);
    array_push($data, $_REQUEST['semana']);
    define ('PAGE_ORIENTATION','L');
    switch ($_SESSION['tutor']['grado']) {
        case 1 : case 2: case 3:
            define ('ETA_TABLA', 'tb_eta_calificacion1');
            break;
        case 5 : case 4:
            define ('ETA_TABLA', 'tb_eta_calificacion2');
            break;
        default:
            define ('ETA_TABLA', 'tb_eta_calificacion1');
            break;
    }
    require_once 'tutorReporteExcel.php';
    reporte_eta_sabana($data);
?>