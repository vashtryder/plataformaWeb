<?php
    require_once '../../gestorReporte.php';
    $data = array($_REQUEST['estudiante'],$_REQUEST['unidad']);
    define ('PAGE_ORIENTATION','L');
    require_once 'tutorReporte.php';
    reporte_eta_estudiante($data)
?>