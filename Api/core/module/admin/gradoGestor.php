<?php 

	include_once "Api/core/ControladorBase.php";

	class GestorGrado
	{
		public static function newGradoAjax()
        {
            $row = gradoController::getGradoId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['grado']);
            array_push($data, sistema::substr($_REQUEST['grado'],3));
            return gradoController::getGradoNew($data);
        }

        public static function updateGradoAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['grado']);
            array_push($data, $_REQUEST['id']);
            return gradoController::getGradoUpdate($data);
        }

        public static function deleteGradoAjax()
        {
			return gradoController::getGradoDelete($_REQUEST['id']);
		}
	}

	if(isset($_REQUEST["new_grado"])){
		GestorGrado::newGradoAjax();
	} else if(isset($_REQUEST["update_grado"])){
		GestorGrado::updateGradoAjax();
	} else if(isset($_REQUEST["delete_grado"])){
		GestorGrado::deleteGradoAjax();
	}
?>