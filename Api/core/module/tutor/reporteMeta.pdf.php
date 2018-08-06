<?php
    require_once '../../gestorReporte.php';
    $arrayName = array();
    array_push($arrayName, $_REQUEST['u']);
    array_push($arrayName, $_REQUEST['z']);

    define ('PAGE_ORIENTATION','L');
    require_once 'tutorReporte.php';

    reporte_eta_metas($arrayName);

?>