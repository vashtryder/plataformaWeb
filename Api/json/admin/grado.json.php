<?php
	include_once "../../core/ControladorBase.php";
    $rs = gradoController::getGrado();
    $arrayName = array();
    foreach($rs as $row){
        $arrayName[] = array(
            'id' => $row[0],
            'text' => $row[1]
        );
	}
	print_r(json_encode($arrayName))
?>