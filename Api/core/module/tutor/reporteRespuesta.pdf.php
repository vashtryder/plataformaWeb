<?php
    require_once '../../gestorReporte.php';
    $data = array($_REQUEST['unidad'],$_REQUEST['semana']);
    define ('PAGE_ORIENTATION','L');
    require_once 'tutorReporte.php';
    reporte_eta_porcentual($data)
?>