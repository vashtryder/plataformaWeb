<?php
    include_once "../../core/ControladorBase.php";
	$rs = docenteController::getPersonalAcademico($_REQUEST['e']);
    $arrayName = array();
    foreach($rs as $row){
        $arrayName[] = array(
            'id' => $row[0],
            'text' => $row[3]." ".$row[4]." ".$row[5]
        );
    }
    print_r(json_encode($arrayName))
?>