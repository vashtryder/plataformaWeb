<?php 

	include_once "Api/core/ControladorBase.php";

	class seccionGestor
	{
		public static function newSeccionAjax()
        {
            $row = gestorSeccion::get_id_seccion();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['seccion']);
            array_push($data, sistema::substr($_REQUEST['seccion'],3));
            return gestorSeccion::new_seccion($data);
        }

        public static function updateSeccionAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['seccion']);
            array_push($data, $_REQUEST['id']);
            return gestorSeccion::update_seccion($data);
        }

        public static function deleteSeccionAjax()
        {
            return gestorSeccion::delete_seccion($_REQUEST['id']);
		}
	}

	if(isset($_REQUEST["new_seccion"])){
		GestorUsuarioModel::newSeccionAjax();
	} else if(isset($_REQUEST["update_seccion"])){
		GestorUsuarioModel::updateSeccionAjax();
	} else if(isset($_REQUEST["delete_seccion"])){
		GestorUsuarioModel::deleteSeccionAjax();
	}
?>