<?php 

	include_once "Api/core/ControladorBase.php";

	class anioGestor
	{
		public static function newAnioAjax()
        {
            $row = gestorAnio::get_id_Anio();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['anio']);
            array_push($data, 1);
            return gestorAnio::new_anio($data);
        }

        public static function updateAnioAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['anio']);
            array_push($data, $_REQUEST['id']);
            return gestorAnio::update_anio($data);
        }

        public static function deleteAnioAjax()
        {
            return gestorAnio::delete_anio($_REQUEST['id']);
		}
	}

	if(isset($_REQUEST["new_anio"])){
		GestorUsuarioModel::newAnioAjax();
	} else if(isset($_REQUEST["update_anio"])){
		GestorUsuarioModel::updateAnioAjax();
	} else if(isset($_REQUEST["delete_anio"])){
		GestorUsuarioModel::deleteAnioAjax();
	}
?>