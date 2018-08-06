<?php 
	include_once "Api/core/ControladorBase.php";
	
	class procesoEtaGestor
    {
		public static function newProcesoAjax()
        {
            $row = gestorProceso::get_id_proceso();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, 0);
            return gestorProceso::new_proceso($data);
        }

        public static function updateProcesoAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['nombre']);
            array_push($data, 0);
            array_push($data, $_REQUEST['id']);
            return gestorProceso::update_proceso($data);
        }

        public static function deleteProcesoAjax()
        {
            return gestorProceso::delete_proceso($_REQUEST['id']);
        }

	}

	if(isset($_REQUEST["new_proceso"])){
        GestorUsuarioModel::newProcesoAjax();
    } else if(isset($_REQUEST["update_proceso"])){
        GestorUsuarioModel::updateProcesoAjax();
    } else if(isset($_REQUEST["delete_proceso"])){
        GestorUsuarioModel::deleteProcesoAjax();
    }
?>