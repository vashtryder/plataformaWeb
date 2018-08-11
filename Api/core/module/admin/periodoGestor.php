<?php 
	include_once "../../../core/ControladorBase.php";

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

			$r = periodoController::getPeriodoNew($data);
			$enviarDatos = ($r !== false) ? array(1,GUARDADO) : array(0,ERROR);
			// $enviarDatos = ($r !== false) ? array(1,$r) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function updatePeriodoAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['periodo']);
            array_push($data, $_REQUEST['observacion']);
            array_push($data, $_REQUEST['id']);
			$r = periodoController::getPeriodoUpdate($data);
			$enviarDatos = ($r !== false) ? array(1,ACTUALIZADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function deletePeriodoAjax()
        {
			$r = periodoController::getPeriodoDelete($_REQUEST['id']);
			$enviarDatos = ($r !== false) ? array(1,ELIMINADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
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
