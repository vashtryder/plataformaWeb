<?php 

	include_once "Api/core/ControladorBase.php";

	class cursoGestor
	{
		public static function newCursoAjax()
        {
            $row = gestorCurso::get_id_curso();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['idanio']);
            array_push($data, $_REQUEST['area']);
            array_push($data, $_REQUEST['curso']);
            array_push($data, sistema::get_format_string($_REQUEST['curso']));
            array_push($data, 0);
            return gestorCurso::new_curso($data);
        }

        public static function updateCursoAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['area']);
            array_push($data, $_REQUEST['curso']);
            array_push($data, sistema::get_format_string($_REQUEST['curso']));
            array_push($data, 0);
            array_push($data, $_REQUEST['id']);
            return gestorCurso::update_curso($data);
        }

        public static function deleteCursoAjax()
        {
            return gestorCurso::delete_curso($_REQUEST['id']);
        }
	}

	if(isset($_REQUEST["new_curso"])){
		GestorUsuarioModel::newCursoAjax();
	} else if(isset($_REQUEST["update_curso"])){
		GestorUsuarioModel::updateCursoAjax();
	} else if(isset($_REQUEST["delete_curso"])){
		GestorUsuarioModel::deleteCursoAjax();
	}
?>