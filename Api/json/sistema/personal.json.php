<?php
    include('../../../conf.ini.php');
    $COLEGIO = empty($_SESSION['colegio'][0]) ? '' : $_SESSION['colegio'][0];
    $rs = gestorPersonal::get_personalAcademico($COLEGIO);
    $arrayName = array();
    foreach($rs as $row){
        $arrayName[] = array(
            'id' => $row[0],
            'text' => $row[3]." ".$row[4]." ".$row[5]
        );
    }
    sistema::imprimir(json_encode($arrayName))
?>