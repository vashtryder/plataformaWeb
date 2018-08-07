<?php 

	include_once "Api/core/ControladorBase.php";

	class GestorCurso
	{
		public static function newCursoAjax()
        {
            $row = cursoController::getCursoId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['idanio']);
            array_push($data, $_REQUEST['area']);
            array_push($data, $_REQUEST['curso']);
            array_push($data, sistema::get_format_string($_REQUEST['curso']));
            array_push($data, 0);
            return cursoController::getCursoNew($data);
        }

        public static function updateCursoAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['area']);
            array_push($data, $_REQUEST['curso']);
            array_push($data, sistema::get_format_string($_REQUEST['curso']));
            array_push($data, 0);
            array_push($data, $_REQUEST['id']);
            return cursoController::getCursoUpdate($data);
        }

        public static function deleteCursoAjax()
        {
			return cursoController::getCursoDelete($_REQUEST['id']);
        }
	}

	if(isset($_REQUEST["new_curso"])){
		GestorCurso::newCursoAjax();
	} else if(isset($_REQUEST["update_curso"])){
		GestorCurso::updateCursoAjax();
	} else if(isset($_REQUEST["delete_curso"])){
		GestorCurso::deleteCursoAjax();
	}
?>