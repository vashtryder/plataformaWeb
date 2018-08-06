<?php
    // include_once '../../../conf.ini.php';
    require_once 'direccionReporte.php';
    $data = array();
    array_push($data,$_REQUEST['grado']);
    array_push($data,$_REQUEST['seccion']);
    array_push($data,$_REQUEST['nivel']);
    array_push($data,$_REQUEST['columna']);
    array_push($data,$_REQUEST['option']);
    reporte_lista_xls($data);
?>