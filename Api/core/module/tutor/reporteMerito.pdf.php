<?php
    require_once '../../gestorReporte.php';
    $data = array();

    array_push($data, $_REQUEST['unidad']);
    array_push($data, $_REQUEST['semana']);
    array_push($data, $_REQUEST['cantidad']);

    define ('PAGE_ORIENTATION','L');
    require_once 'tutorReporte.php';

    if($_REQUEST['option'] == 1){

        reporte_merito_aula($data);

    } else if($_REQUEST['option'] == 2){

        reporte_merito_grado($data);

    } else{

        switch ($_SESSION['tutor']['grado']) {
            case 1 : case 2: case 3:
                array_push($data, 1);
                break;
            case 5 : case 4:
                array_push($data, 2);
                break;
            default:
                array_push($data, 1);
                break;
        }

        reporte_merito_grupo($data);
    }
?>