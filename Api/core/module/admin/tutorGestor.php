<?php 
	include_once "../../../core/ControladorBase.php";

	class GestorTutor
	{
		public static function newTutorAjax()
        {
            $row = tutorController::getTutorId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['colegio']);
            array_push($data, $_REQUEST['idanio']);
            array_push($data, $_REQUEST['docente']);
            array_push($data, $_REQUEST['grado']);
            array_push($data, $_REQUEST['seccion']);
            array_push($data, $_REQUEST['nivel']);
			$r = tutorController::getTutorNew($data);
			$enviarDatos = ($r !== false) ? array(1,GUARDADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function updateTutorAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['colegio']);
            array_push($data, $_REQUEST['docente']);
            array_push($data, $_REQUEST['grado']);
            array_push($data, $_REQUEST['seccion']);
            array_push($data, $_REQUEST['nivel']);
            array_push($data, $_REQUEST['id']);
			$r = tutorController::getTutorUpdate($data);
			$enviarDatos = ($r !== false) ? array(1,ACTUALIZADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
			
        }

        public static function deleteTutorAjax()
        {
			$r = tutorController::getTutorDelete($_REQUEST['id']);
			$enviarDatos = ($r !== false) ? array(1,ELIMINADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }
	}

	if(isset($_REQUEST['new_tutor'])){
        GestorTutor::newTutorAjax();
    } else if(isset($_REQUEST['update_tutor'])){
        GestorTutor::updateTutorAjax();
    } else if(isset($_REQUEST['delete_tutor'])){
        GestorTutor::deleteTutorAjax();
    }
?>