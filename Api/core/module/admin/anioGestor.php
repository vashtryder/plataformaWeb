<?php 

	include_once "Api/core/ControladorBase.php";

	class GestorAnio
	{
		public static function newAnioAjax()
        {
            $row = anioController::getAnioId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['anio']);
            array_push($data, 1);
            return anioController::getAnioNew($data);
        }

        public static function updateAnioAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['anio']);
            array_push($data, $_REQUEST['id']);
            return anioController::getAnioUpdate($data);
        }

        public static function deleteAnioAjax()
        {
			return anioController::getAnioDelete($_REQUEST['id']);
		}
	}

	if(isset($_REQUEST["new_anio"])){
		GestorAnio::newAnioAjax();
	} else if(isset($_REQUEST["update_anio"])){
		GestorAnio::updateAnioAjax();
	} else if(isset($_REQUEST["delete_anio"])){
		GestorAnio::deleteAnioAjax();
	}
?>