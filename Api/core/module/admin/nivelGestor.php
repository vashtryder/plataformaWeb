<?php 
	include_once "../../../core/ControladorBase.php";
	include_once "../../../config/sistema.php";

	class GestorNivel
	{
		public static function newNivelAjax()
        {
            $row = nivelController::getNivelId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['nivel']);
            array_push($data, sistema::substr($_REQUEST['nivel'],3));
			$r = nivelController::getNivelNew($data);
			$enviarDatos = ($r !== false) ? array(1,GUARDADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function updateNivelAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['nivel']);
            array_push($data, $_REQUEST['id']);
			$r = nivelController::getNivelUpdate($data);
			$enviarDatos = ($r !== false) ? array(1,ACTUALIZADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function deleteNivelAjax()
        {
			$r = nivelController::getNivelDelete($_REQUEST['id']);
			$enviarDatos = ($r !== false) ? array(1,ELIMINADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
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