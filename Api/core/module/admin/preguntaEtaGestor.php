<?php 
	include_once "../../../core/ControladorBase.php";

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
			$r = preguntaEtaController::getPreguntaEtaNew($data);
			$enviarDatos = ($r !== false) ? array(1,GUARDADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function updatePreguntaAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['curso']);
            array_push($data, $_REQUEST['eta']);
            array_push($data, $_REQUEST['cantidad']);
            array_push($data, $_REQUEST['id']);
			$r = preguntaEtaController::getPreguntaEtaUpdate($data);
			$enviarDatos = ($r !== false) ? array(1,ACTUALIZADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function deletePreguntaAjax()
        {
			$r = preguntaEtaController::getPreguntaEtaDelete($_REQUEST['id']);
			$enviarDatos = ($r !== false) ? array(1,ELIMINADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
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