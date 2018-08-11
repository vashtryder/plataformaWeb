<?php 
	include_once "../../../core/ControladorBase.php";

	class GestorSemanaEta
	{
		public static function newSemanaAjax()
        {
            $row = semanaEtaController::getSemanaEtaId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['unidad']);
            array_push($data, $_REQUEST['idanio']);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['fechaini']);
            array_push($data, $_REQUEST['fechafin']);
			$r = semanaEtaController::getSemanaEtaNew($data);
			$enviarDatos = ($r !== false) ? array(1,GUARDADO) : array(0,ERROR);
			
			print_r(json_encode($enviarDatos));

        }

        public static function updateSemanaAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['unidad']);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['fechaini']);
            array_push($data, $_REQUEST['fechafin']);
            array_push($data, $_REQUEST['id']);
			$r = semanaEtaController::getSemanaEtaUpdate($data);
			$enviarDatos = ($r !== false) ? array(1,ACTUALIZADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
			
        }

        public static function deleteSemanaAjax()
        {
			$r = semanaEtaController::getSemanaEtaDelete($_REQUEST["id"]);
			$enviarDatos = ($r !== false) ? array(1,ELIMINADO) : array(0,ERROR);
			// $enviarDatos = ($r !== false) ? array(1,$r) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
		}
	}

	if(isset($_REQUEST["new_semana"])){
		GestorSemanaEta::newSemanaAjax();
	} else if(isset($_REQUEST["update_semana"])){
		GestorSemanaEta::updateSemanaAjax();
	} else if(isset($_REQUEST["delete_semana"])){
		GestorSemanaEta::deleteSemanaAjax();
	}
?>