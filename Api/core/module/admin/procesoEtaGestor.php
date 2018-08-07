<?php 
	include_once "Api/core/ControladorBase.php";
	
	class GestorProcesoEta
    {
		public static function newProcesoAjax()
        {
            $row = procesoETaController::getProcesoEtaId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, 0);
            return procesoETaController::getProcesoEtaNew($data);
        }

        public static function updateProcesoAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['nombre']);
            array_push($data, 0);
            array_push($data, $_REQUEST['id']);
            return procesoETaController::getProcesoEtaUpdate($data);
        }

        public static function deleteProcesoAjax()
        {
			return procesoETaController::getProcesoEtaDelete($_REQUEST['id']);
        }

	}

	if(isset($_REQUEST["new_proceso"])){
        GestorProcesoEta::newProcesoAjax();
    } else if(isset($_REQUEST["update_proceso"])){
        GestorProcesoEta::updateProcesoAjax();
    } else if(isset($_REQUEST["delete_proceso"])){
        GestorProcesoEta::deleteProcesoAjax();
    }
?>