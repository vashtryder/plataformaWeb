<?php
    require_once '../../gestorReporte.php';
    $data = array();
    array_push($data,$_REQUEST['grado']);
    array_push($data,$_REQUEST['seccion']);
    array_push($data,$_REQUEST['nivel']);
    array_push($data,$_REQUEST['columna']);
    array_push($data,$_REQUEST['option']);

    if($_REQUEST['posicion'][0] == 'L'){
        $PAGE_ORIENTATION = 'L';
        $ANCHO_CELDA = 165;
    } else {
        $PAGE_ORIENTATION = 'P';
        $ANCHO_CELDA = 77;
    }

    define ('PAGE_ORIENTATION', $PAGE_ORIENTATION);
    define ('ANCHO_CELDA', $ANCHO_CELDA);

    require_once 'direccionReporte.php';

    reporte_lista_pdf($data);
