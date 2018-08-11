<?php 
	include_once "../../../core/ControladorBase.php";

	class GestorAnio
	{
		public static function newAnioAjax()
        {
            $row = anioController::getAnioId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['anio']);
            array_push($data, 1);
			$r = anioController::getAnioNew($data);
			$enviarDatos = ($r !== false) ? array(1,GUARDADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function updateAnioAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['anio']);
            array_push($data, $_REQUEST['id']);
			$r = anioController::getAnioUpdate($data);
			$enviarDatos = ($r !== false) ? array(1,ACTUALIZADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function deleteAnioAjax()
        {
			$r = anioController::getAnioDelete($_REQUEST['id']);
			$enviarDatos = ($r !== false) ? array(1,ELIMINADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
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