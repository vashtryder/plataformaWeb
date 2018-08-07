<?php 

	include_once "Api/core/ControladorBase.php";

	class GestorColegio
	{
		public static function newColegioAjax()
        {
            $row = colegioController::getColegioId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['direccion']);
            array_push($data, $_REQUEST['telefono1']);
            array_push($data, $_REQUEST['telefono2']);
            array_push($data, $_REQUEST['acronimo']);
            array_push($data, $_REQUEST['website']);
            array_push($data, $_REQUEST['facebook']);
            array_push($data, $_REQUEST['youtube']);
            array_push($data, $_REQUEST['correo']);
            return colegioController::getColegioNew($data);
        }

        public static function updateColegioAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['direccion']);
            array_push($data, $_REQUEST['telefono1']);
            array_push($data, $_REQUEST['telefono2']);
            array_push($data, $_REQUEST['acronimo']);
            array_push($data, $_REQUEST['website']);
            array_push($data, $_REQUEST['facebook']);
            array_push($data, $_REQUEST['youtube']);
            array_push($data, $_REQUEST['correo']);
            array_push($data, $_REQUEST['id']);
            return colegioController::getColegioUpdate($data);
        }

        public static function deleteColegioAjax()
        {
			return colegioController::getColegioDelete($_REQUEST['id']);
		}
	}

	if(isset($_REQUEST["new_colegio"])){
        GestorColegio::newColegioAjax();
    } else if(isset($_REQUEST["update_colegio"])){
        GestorColegio::updateColegioAjax();
    } else if(isset($_REQUEST["delete_colegio"])){
        GestorColegio::deleteColegioAjax();
    }
?>