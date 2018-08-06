<?php 

	include_once "Api/core/ControladorBase.php";

	class nivelGestor
	{
		public static function newNivelAjax()
        {
            $row = gestorNivel::get_id_nivel();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['nivel']);
            array_push($data, sistema::substr($_REQUEST['nivel'],3));
            return gestorNivel::new_nivel($data);
        }

        public static function updateNivelAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['nivel']);
            array_push($data, $_REQUEST['id']);
            return gestorNivel::update_nivel($data);
        }

        public static function deleteNivelAjax()
        {
            return gestorNivel::delete_nivel($_REQUEST['id']);
		}
	}

	if(isset($_REQUEST["new_nivel"])){
		GestorUsuarioModel::newNivelAjax();
	} else if(isset($_REQUEST["update_nivel"])){
		GestorUsuarioModel::updateNivelAjax();
	} else if(isset($_REQUEST["delete_nivel"])){
		GestorUsuarioModel::deleteNivelAjax();
	}
?>