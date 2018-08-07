<?php 

	include_once "Api/core/ControladorBase.php";

	class GestorPeriodo
	{
		public static function newPeriodoAjax()
        {
			$row   = periodoController::getPeriodoId($_SESSION['anio'][0]);
			$row_v = periodoController::getPeriodoValor($_SESSION['anio'][0]);
            $ValorPeriodo = ($row_v[0] == 4) ? 1 : ($row_v[0]+1);
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['anio']);
            array_push($data, $ValorPeriodo);
            array_push($data, $_REQUEST['periodo']);
            array_push($data, $_REQUEST['observacion']);

            return periodoController::getPeriodoNew($data);
        }

        public static function updatePeriodoAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['periodo']);
            array_push($data, $_REQUEST['observacion']);
            array_push($data, $_REQUEST['id']);
            return periodoController::getPeriodoUpdate($data);
        }

        public static function deletePeriodoAjax()
        {
			return periodoController::getPeriodoDelete($_REQUEST['id']);
		}
	}

	if(isset($_REQUEST["new_periodo"])){
		GestorPeriodo::newPeriodoAjax();
	} else if(isset($_REQUEST["update_periodo"])){
		GestorPeriodo::updatePeriodoAjax();
	} else if(isset($_REQUEST["delete_periodo"])){
		GestorPeriodo::deletePeriodoAjax();
	}
?>
