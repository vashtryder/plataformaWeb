<?php
    include('../../../conf.ini.php');
    $rs = gestorNivel::get_nivel();
    $arrayName = array();
    foreach($rs as $row){
        $arrayName[] = array(
            'id' => $row[0],
            'text' => $row[1]
        );
    }
    sistema::imprimir(json_encode($arrayName))
?>