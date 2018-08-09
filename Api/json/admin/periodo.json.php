<?php
    include_once "../../core/ControladorBase.php";
    $rs = periodoController::getPeriodo();
    $arrayName = array();
    foreach($rs as $row){
        $arrayName[] = array(
            'id' => $row[0],
            'text' => $row[3]
        );
    }
    print_r(json_encode($arrayName))
?>