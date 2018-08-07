<?php 
	include_once "Api/core/ControladorBase.php";

	class GestorNivel
	{
		public static function newNivelAjax()
        {
            $row = nivelController::getNivelId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['nivel']);
            array_push($data, sistema::substr($_REQUEST['nivel'],3));
            return nivelController::getNivelNew($data);
        }

        public static function updateNivelAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['nivel']);
            array_push($data, $_REQUEST['id']);
            return nivelController::getNivelUpdate($data);
        }

        public static function deleteNivelAjax()
        {
			return nivelController::getNivelDelete($_REQUEST['id']);
		}
	}

	if(isset($_REQUEST["new_nivel"])){
		GestorNivel::newNivelAjax();
	} else if(isset($_REQUEST["update_nivel"])){
		GestorNivel::updateNivelAjax();
	} else if(isset($_REQUEST["delete_nivel"])){
		GestorNivel::deleteNivelAjax();
	}
?>