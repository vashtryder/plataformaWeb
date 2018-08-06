<?php
    include('../../../conf.ini.php');
    $rs = gestorEvento::get_evento();
    $arrayName = array();
    foreach($rs as $row){
        $arrayName[] = array(
            'title'       => $row[1],
            'description' => $row[2],
            'location'    => $row[3],
            'contact'     => $row[4],
            'url'         => $row[5],
            'start'       => $row[6],
            'end'         => $row[7],
            'className'   => ($row[4] == 'media') ? "m-fc-event--success" : "m-fc-event--accent",
        );
    }
    sistema::imprimir(json_encode($arrayName))
?>
