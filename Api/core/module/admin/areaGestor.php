<?php 

	include_once "Api/core/ControladorBase.php";

	class areaGestor
	{
		public static function newAreaAjax()
        {
            $row = gestorArea::get_id_area();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['idanio']);
            array_push($data, $_REQUEST['nivel']);
            array_push($data, $_REQUEST['area']);
            array_push($data, sistema::get_format_string($_REQUEST['area']));
            array_push($data, 0);
            return gestorArea::new_area($data);
        }

        public static function updateAreaAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['nivel']);
            array_push($data, $_REQUEST['area']);
            array_push($data, sistema::get_format_string($_REQUEST['area']));
            array_push($data, 0);
            array_push($data, $_REQUEST['id']);
            return gestorArea::update_area($data);
        }

        public static function deleteAreaAjax()
        {
            return gestorArea::delete_area($_REQUEST['id']);
		}
	}

	if(isset($_REQUEST["new_area"])){
		GestorUsuarioModel::newAreaAjax();
	} else if(isset($_REQUEST["update_area"])){
		GestorUsuarioModel::updateAreaAjax();
	} else if(isset($_REQUEST["delete_area"])){
		GestorUsuarioModel::deleteAreaAjax();
	}
?>