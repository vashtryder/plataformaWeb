<?php 
	include_once "Api/core/ControladorBase.php";
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
            return areaController::getAreaNew($data);
        }

        public static function updateAreaAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['nivel']);
            array_push($data, $_REQUEST['area']);
            array_push($data, sistema::get_format_string($_REQUEST['area']));
            array_push($data, 0);
            array_push($data, $_REQUEST['id']);
            return areaController::getAreaUpdate($data);
        }

        public static function deleteAreaAjax()
        {
            return areaController::getAreaDelete($_REQUEST['id']);
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