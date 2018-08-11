<?php 
	include_once "../../../core/ControladorBase.php";
	include_once "../../../config/sistema.php";
	
	class GestorSeccion
	{
		public static function newSeccionAjax()
        {
            $row = seccionController::getSeccionId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['seccion']);
            array_push($data, sistema::substr($_REQUEST['seccion'],3));
			$r = seccionController::getSeccionNew($data);
			$enviarDatos = ($r !== false) ? array(1,GUARDADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function updateSeccionAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['seccion']);
            array_push($data, $_REQUEST['id']);
			$r = seccionController::getSeccionUpdate($data);
			$enviarDatos = ($r !== false) ? array(1,ACTUALIZADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function deleteSeccionAjax()
        {
			$r = seccionController::getSeccionDeleteModel($_REQUEST['id']);
			$enviarDatos = ($r !== false) ? array(1,ELIMINADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
		}
	}

	if(isset($_REQUEST["new_seccion"])){
		GestorSeccion::newSeccionAjax();
	} else if(isset($_REQUEST["update_seccion"])){
		GestorSeccion::updateSeccionAjax();
	} else if(isset($_REQUEST["delete_seccion"])){
		GestorSeccion::deleteSeccionAjax();
	}
?>