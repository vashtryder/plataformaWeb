<?php
    include('../../../conf.ini.php');
    $Avatar = "view/img/personal/".$_SESSION['user'][9];
    $arrayName = array("Avatar" => $Avatar);
    sistema::imprimir(json_encode($arrayName))
?>