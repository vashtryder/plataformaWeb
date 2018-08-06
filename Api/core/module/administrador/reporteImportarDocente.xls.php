<?php
    // include_once '../../../conf.ini.php';
    require_once 'administradorReporte.php';
    $var1 = empty($_REQUEST['idcolegio']) ? $_SESSION['colegio'][0] : $_REQUEST['idcolegio'];
    $var2 = $_FILES['userfile'];
    $data = array($var1,$var2);
    get_import_docente($data);
?>