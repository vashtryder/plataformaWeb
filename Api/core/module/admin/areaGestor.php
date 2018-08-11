<?php 
	include_once "../../../core/ControladorBase.php";
	include_once "../../../config/sistema.php";
	class GestorArea
	{
		public static function newAreaAjax()
        {
            $row = areaController::getAreaId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['idanio']);
            array_push($data, $_REQUEST['nivel']);
            array_push($data, $_REQUEST['area']);
            array_push($data, sistema::get_format_string($_REQUEST['area']));
            array_push($data, 0);
			$r = areaController::getAreaNew($data);
			$enviarDatos = ($r !== false) ? array(1,GUARDADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function updateAreaAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['nivel']);
            array_push($data, $_REQUEST['area']);
            array_push($data, sistema::get_format_string($_REQUEST['area']));
            array_push($data, 0);
            array_push($data, $_REQUEST['id']);
			$r = areaController::getAreaUpdate($data);
			$enviarDatos = ($r !== false) ? array(1,ACTUALIZADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function deleteAreaAjax()
        {
			$r = areaController::getAreaDelete($_REQUEST['id']);
			$enviarDatos = ($r !== false) ? array(1,ELIMINADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
		}
	}

	if(isset($_REQUEST["new_area"])){
		GestorArea::newAreaAjax();
	} else if(isset($_REQUEST["update_area"])){
		GestorArea::updateAreaAjax();
	} else if(isset($_REQUEST["delete_area"])){
		GestorArea::deleteAreaAjax();
	}
?>