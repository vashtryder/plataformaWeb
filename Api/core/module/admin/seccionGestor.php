<?php 

	include_once "Api/core/ControladorBase.php";

	class GestorSeccion
	{
		public static function newSeccionAjax()
        {
            $row = seccionController::getSeccionId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['seccion']);
            array_push($data, sistema::substr($_REQUEST['seccion'],3));
            return seccionController::getSeccionNew($data);
        }

        public static function updateSeccionAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['seccion']);
            array_push($data, $_REQUEST['id']);
            return seccionController::getSeccionUpdate($data);
        }

        public static function deleteSeccionAjax()
        {
			return seccionController::getSeccionDeleteModel($_REQUEST['id']);
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