<?php
    include('../../../conf.ini.php');
    $data = array($_SESSION['user'][0],$_SESSION['colegio'][0]);
    $row1 = gestorMensaje::get_mensaje_recibido($data);
    $row2 = gestorMensaje::get_mensaje_enviado($data);
    $enviado = empty($row1[0]) ? 0 : $row1[0];
    $recibido = empty($row2[0]) ? 0 : $row2[0];
    $arrayName = array( 'enviado' => $enviado,  'recibido' => $recibido);
    sistema::imprimir(json_encode($arrayName))
?>