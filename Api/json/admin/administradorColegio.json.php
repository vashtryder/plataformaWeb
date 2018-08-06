<?php
    include('../../../conf.ini.php');

    $rs = gestorColegio::get_colegio();
    $arrayName = array();
    foreach($rs as $row){
        $arrayName[] = array(
            'id' => $row[0],
            'text' => $row[1]
        );
    }
    sistema::imprimir(json_encode($arrayName))
?>