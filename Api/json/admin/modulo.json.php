<?php
	include_once "../../core/ControladorBase.php";
    $rs = moduloController::getModuloModel();
    $arrayName = array();
    foreach($rs as $row){
        $arrayName[] = array(
            'id' => $row[0],
            'text' => $row[1]
        );
    }
    sistema::imprimir(json_encode($arrayName))
?>