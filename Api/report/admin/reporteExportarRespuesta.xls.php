<?php
    require_once 'administradorReporte.php';
    $data = array();
    array_push($data, $_REQUEST['colegio']);
    array_push($data, $_REQUEST['unidad']);
    array_push($data, $_REQUEST['semana']);
    array_push($data, $_REQUEST['eta']);
    array_push($data, $_REQUEST['grado']);
    array_push($data, $_REQUEST['seccion']);
    array_push($data, $_REQUEST['nivel']);
    array_push($data, $_SESSION['anio'][0]);
    get_export_respuesta($data);

?>