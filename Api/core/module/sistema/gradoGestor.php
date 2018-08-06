<?php 

	include_once "Api/core/ControladorBase.php";

	class colegioGestor
	{
		public static function newGradoAjax()
        {
            $row = gestorGrado::get_id_grado();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['grado']);
            array_push($data, sistema::substr($_REQUEST['grado'],3));
            return gestorGrado::new_grado($data);
        }

        public static function updateGradoAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['grado']);
            array_push($data, $_REQUEST['id']);
            return gestorGrado::update_grado($data);
        }

        public static function deleteGradoAjax()
        {
            return gestorGrado::delete_grado($_REQUEST['id']);
		}
	}

	if(isset($_REQUEST["new_grado"])){
		GestorUsuarioModel::newGradoAjax();
	} else if(isset($_REQUEST["update_grado"])){
		GestorUsuarioModel::updateGradoAjax();
	} else if(isset($_REQUEST["delete_grado"])){
		GestorUsuarioModel::deleteGradoAjax();
	}
?>