<?php
    // include_once '../../../conf.ini.php';
    require_once 'administradorReporte.php';
    $var1 = $_REQUEST['colegio'];
    $var2 = $_FILES['userfile'];
    $var3 = $_REQUEST['eta'];
    $data = array($var1,$var2,$var3);
    get_import_respuesta($data);
?>