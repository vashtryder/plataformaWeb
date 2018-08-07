<?php 
	include_once "Api/core/ControladorBase.php";

	class GestorPreguntaEta
	{
		public static function newPreguntaAjax()
        {
            $row = preguntaEtaController::getPreguntaEtaId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['idanio']);
            array_push($data, $_REQUEST['curso']);
            array_push($data, $_REQUEST['eta']);
            array_push($data, $_REQUEST['cantidad']);
            return preguntaEtaController::getPreguntaEtaNew($data);
        }

        public static function updatePreguntaAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['curso']);
            array_push($data, $_REQUEST['eta']);
            array_push($data, $_REQUEST['cantidad']);
            array_push($data, $_REQUEST['id']);
            return preguntaEtaController::getPreguntaEtaUpdate($data);
        }

        public static function deletePreguntaAjax()
        {
			return preguntaEtaController::getPreguntaEtaDelete($_REQUEST['id']);
        }
	}

	if(isset($_REQUEST["new_pregunta"])){
        GestorPreguntaEta::newPreguntaAjax();
    } else if(isset($_REQUEST["update_pregunta"])){
        GestorPreguntaEta::updatePreguntaAjax();
    } else if(isset($_REQUEST["delete_pregunta"])){
        GestorPreguntaEta::deletePreguntaAjax();
    }
?>