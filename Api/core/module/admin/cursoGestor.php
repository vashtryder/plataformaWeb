<?php 
	include_once "../../../core/ControladorBase.php";
	include_once "../../../config/sistema.php";
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
			$r = cursoController::getCursoNew($data);
			$enviarDatos = ($r !== false) ? array(1,GUARDADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function updateCursoAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['area']);
            array_push($data, $_REQUEST['curso']);
            array_push($data, sistema::get_format_string($_REQUEST['curso']));
            array_push($data, 0);
            array_push($data, $_REQUEST['id']);
			$r = cursoController::getCursoUpdate($data);
			$enviarDatos = ($r !== false) ? array(1,ACTUALIZADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function deleteCursoAjax()
        {
			$r = cursoController::getCursoDelete($_REQUEST['id']);
			$enviarDatos = ($r !== false) ? array(1,ELIMINADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
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