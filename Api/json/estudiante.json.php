<?php
    include('../../../conf.ini.php');
    $rs = gestorEstudiante::get_estudianteAcademico($_SESSION['colegio'][0]);
    $arrayName = array();
    foreach($rs as $row){
        $arrayName[] = array(
            'id' => $row[0],
            'text' => $row[3]." ".$row[4]." ".$row[5]
        );
    }
    sistema::imprimir(json_encode($arrayName))
?>