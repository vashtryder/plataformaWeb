<?php 

	include_once "Api/core/ControladorBase.php";

	class colegioGestor
	{
		public static function newColegioAjax()
        {
            $row = gestorColegio::get_id_colegio();
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
            return gestorColegio::new_colegio($data);
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
            return gestorColegio::update_colegio($data);
        }

        public static function deleteColegioAjax()
        {
            return gestorColegio::delete_colegio($_REQUEST['id']);
		}
	}

	if(isset($_REQUEST["new_colegio"])){
        GestorUsuarioModel::newColegioAjax();
    } else if(isset($_REQUEST["update_colegio"])){
        GestorUsuarioModel::updateColegioAjax();
    } else if(isset($_REQUEST["delete_colegio"])){
        GestorUsuarioModel::deleteColegioAjax();
    }
?>