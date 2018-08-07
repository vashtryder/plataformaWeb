<?php 

	include_once "Api/core/ControladorBase.php";

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
            return semanaEtaController::getSemanaEtaNew($data);
        }

        public static function updateSemanaAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['unidad']);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['fechaini']);
            array_push($data, $_REQUEST['fechafin']);
            array_push($data, $_REQUEST['id']);
            return semanaEtaController::getSemanaEtaUpdate($data);
        }

        public static function deleteSemanaAjax()
        {
            return semanaEtaController::getSemanaEtaDelete($data);
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