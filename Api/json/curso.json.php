<?php
    include('../../../conf.ini.php');
    $rs = gestorCurso::get_curso();
    $arrayName = array();
    foreach($rs as $row){
        $arrayName[] = array(
            'id' => $row[0],
            'text' => $row[3]
        );
    }
    sistema::imprimir(json_encode($arrayName))
?>