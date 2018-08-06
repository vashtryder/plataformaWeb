<?php 
	include_once "Api/core/ControladorBase.php";

	class preguntaEtaGestor
	{
		public static function newPreguntaAjax()
        {
            $row = gestorPregunta::get_id_pregunta();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['idanio']);
            array_push($data, $_REQUEST['curso']);
            array_push($data, $_REQUEST['eta']);
            array_push($data, $_REQUEST['cantidad']);
            return gestorPregunta::new_pregunta($data);
        }

        public static function updatePreguntaAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['curso']);
            array_push($data, $_REQUEST['eta']);
            array_push($data, $_REQUEST['cantidad']);
            array_push($data, $_REQUEST['id']);
            return gestorPregunta::update_pregunta($data);
        }

        public static function deletePreguntaAjax()
        {
            return gestorPregunta::delete_pregunta($_REQUEST['id']);
        }
	}

	if(isset($_REQUEST["new_pregunta"])){
        GestorUsuarioModel::newPreguntaAjax();
    } else if(isset($_REQUEST["update_pregunta"])){
        GestorUsuarioModel::updatePreguntaAjax();
    } else if(isset($_REQUEST["delete_pregunta"])){
        GestorUsuarioModel::deletePreguntaAjax();
    }
?>