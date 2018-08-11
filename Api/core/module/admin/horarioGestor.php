<?php 
	include_once "../../ControladorBase.php";
	class GestorHorario
	{
		public static function newHorarioAjax()
        {
			$row = horarioController::getHorarioId(); 
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['colegio']);
            array_push($data, $_REQUEST['docente']);
            array_push($data, $_REQUEST['idanio']);
            array_push($data, $_REQUEST['curso']);
            array_push($data, $_REQUEST['grado']);
            array_push($data, $_REQUEST['seccion']);
            array_push($data, $_REQUEST['nivel']);
			$r = horarioController::getHorarioNew($data);
			$enviarDatos = ($r !== false) ? array(1,GUARDADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function updateHorarioAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['colegio']);
            array_push($data, $_REQUEST['docente']);
            array_push($data, $_REQUEST['curso']);
            array_push($data, $_REQUEST['grado']);
            array_push($data, $_REQUEST['seccion']);
            array_push($data, $_REQUEST['nivel']);
            array_push($data, $_REQUEST['id']);
			$r = horarioController::getHorarioUpdate($data);
			$enviarDatos = ($r !== false) ? array(1,ACTUALIZADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function deleteHorarioAjax()
        {
			$r = horarioController::getHorarioDelete($_REQUEST['id']);
			$enviarDatos = ($r !== false) ? array(1,ELIMINADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }
	}

	if(isset($_REQUEST['new_horario'])){
        GestorHorario::newHorarioAjax();
    } else if(isset($_REQUEST['update_horario'])){
        GestorHorario::updateHorarioAjax();
    } else if(isset($_REQUEST['delete_horario'])){
        GestorHorario::deleteHorarioAjax();
    }
?>