<?php
    // include_once '../../../conf.ini.php';
    require_once 'tutorReporteExcel.php';
    $arrayName = array($_REQUEST['estudiante'],$_REQUEST['unidad']);
    reporte_eta_estudiante($arrayName);
?>