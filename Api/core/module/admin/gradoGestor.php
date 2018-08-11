<?php 
	include_once "../../../core/ControladorBase.php";
	include_once "../../../config/sistema.php";
	
	class GestorGrado
	{
		public static function newGradoAjax()
        {
            $row = gradoController::getGradoId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['grado']);
            array_push($data, sistema::substr($_REQUEST['grado'],3));
			$r = gradoController::getGradoNew($data);
			$enviarDatos = ($r !== false) ? array(1,GUARDADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function updateGradoAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['grado']);
            array_push($data, $_REQUEST['id']);
			$r = gradoController::getGradoUpdate($data);
			$enviarDatos = ($r !== false) ? array(1,ACTUALIZADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function deleteGradoAjax()
        {
			$r = gradoController::getGradoDelete($_REQUEST['id']);
			$enviarDatos = ($r !== false) ? array(1,ELIMINADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
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