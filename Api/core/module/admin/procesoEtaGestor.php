<?php 
	include_once "../../../core/ControladorBase.php";
	
	class GestorProcesoEta
    {
		public static function newProcesoAjax()
        {
            $row = procesoEtaController::getProcesoEtaId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, 0);
			$r = procesoEtaController::getProcesoEtaNew($data);
			$enviarDatos = ($r !== false) ? array(1,GUARDADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function updateProcesoAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['nombre']);
            array_push($data, 0);
            array_push($data, $_REQUEST['id']);
			$r = procesoEtaController::getProcesoEtaUpdate($data);
			$enviarDatos = ($r !== false) ? array(1,ACTUALIZADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function deleteProcesoAjax()
        {
			$r = procesoEtaController::getProcesoEtaDelete($_REQUEST['id']);
			$enviarDatos = ($r !== false) ? array(1,ELIMINADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
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