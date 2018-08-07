<?php
	
	include_once "Api/core/ControladorBase.php";
	
	class GestorRegistroEta
    {
	   
		public static function newRegistroEtaAjax()
        {

            $seccion = $_REQUEST['seccion'];

            $g = $_REQUEST['g'];
            $s = $_REQUEST['s'];
            $n = $_REQUEST['n'];

            $grupo = $_REQUEST['grupo'];

            foreach ($seccion as $key => $value) {

                $ETA_TABLA  = $SP_TABLA = '';

                switch ($g[$key]) {
                    case 1 : case 2: case 3:
                        $ETA_TABLA = 'tb_eta_calificacion1';
                        $SP_TABLA  = 'sp_guardarCalificacion_1';
                        break;
                    case 4 : case 5:
                        $ETA_TABLA = 'tb_eta_calificacion2';
                        $SP_TABLA = 'sp_guardarCalificacion_2';
                        break;
                    default:
                        $ETA_TABLA = 'tb_eta_calificacion1';

                        $SP_TABLA = 'sp_guardarCalificacion_1';
                        break;
                }

                $data = $data1 = array();

				$idCalificacion = calificacionEtaController::getCalificacionEtaId($ETA_TABLA);
                $idRegistroEta  = registroEtaController::getRegistroEtaId();

                $idCalificacion = empty($idCalificacion[0]) ? 0 : $idCalificacion[0];
                $idEta          = empty($idRegistroEta[0]) ? 0: $idRegistroEta[0];

                $idEta++;

                $row_tu = gestorTutor::get_tutor_reporte(array($g[$key],$s[$key],$n[$key],$_REQUEST['colegio'],$_SESSION['anio'][0]));

                array_push($data,$idCalificacion);
                array_push($data,$idEta);
                array_push($data,$_SESSION['anio'][0]);
                array_push($data,$value);
                array_push($data,'calificaciones');
                array_push($data,'cd360');
                array_push($data,$_REQUEST['tabla']);
                array_push($data,$ETA_TABLA);

				calificacionEtaController::getCalificacionEtaNew($data,$SP_TABLA);

                array_push($data1,$idEta);
                array_push($data1,$_REQUEST['colegio']);
                array_push($data1,$_REQUEST['anio']);
                array_push($data1,$_REQUEST['semana']);
                array_push($data1,$grupo[$key]);
                array_push($data1,$row_tu[0]);
                array_push($data1,'REGISTRO_ETA_'.$_REQUEST['grado'].'_'.$value.'_'.$_REQUEST['nivel'].'_SEMANA_'.$_REQUEST['semana']);
                array_push($data1,date('Y-m-d'));

				registroEtaController::getRegistroEtaNew($data1);

            }

            $data2 = array();
            array_push($data2,'calificaciones');
            array_push($data2,$_REQUEST['tabla']);
			return registroEtaController::getRegistroEtaDelete($data2);
		}
		
		public static function deleteRegistroEtaAjax()
        {
            $data2 = array();
            array_push($data2,'calificaciones');
            array_push($data2,$_REQUEST['tabla']);
            return registroEtaController::getRegistroEtaDelete($data2);
        }
    }

    if(isset($_REQUEST["new_registro"])){
        GestorRegistroEta::newRegistroEtaAjax();
    } else if(isset($_REQUEST["delete_registro"])){
        GestorRegistroEta::deleteRegistroEtaAjax();
    }else if(isset($_REQUEST["avatar_token"])){
        GestorRegistroEta::updateDocenteAjax();
    }
?>