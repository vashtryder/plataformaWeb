<?php
    // include_once '../../../conf.ini.php';
    require_once 'tutorReporteExcel.php';
    $arrayName = array();
    array_push($arrayName, $_REQUEST['unidad']);
    array_push($arrayName, $_REQUEST['semana']);
    reporte_eta_porcental($arrayName);
?>