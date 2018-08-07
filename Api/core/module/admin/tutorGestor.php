<?php 

	include_once "Api/core/ControladorBase.php";

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
            return tutorController::getTutorNew($data);
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
            return tutorController::getTutorUpdate($data);
        }

        public static function deleteTutorAjax()
        {
			return tutorController::getTutorDelete($_REQUEST['id']);
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