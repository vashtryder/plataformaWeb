<?php
    include_once '../../../conf.ini.php';
    $rows = gestorEvento::set_evento($_REQUEST['id']);
    $arrayName = array(
        'event_id'          => $rows[0],
        'event_title'       => $rows[1],
        'event_descripcion' => $rows[2],
        'event_location'    => $rows[3],
        'event_contact'     => $rows[4],
        'event_url'         => $rows[5],
        'event_start'       => $rows[6],
        'event_end'         => $rows[7]
    );

    sistema::imprimir(json_encode($arrayName));
?>
