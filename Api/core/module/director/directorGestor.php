<?php 

	include_once "Api/core/ControladorBase.php";

	class directorGestor
	{
		public static function updateLoginDocenteAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['estado']);
            array_push($data, $_REQUEST['id']);
            return gestorUsuario::update_estado_docente($data);
		}
	}

	if(isset($_REQUEST["estado_director"])){
        GestorUsuarioModel::updateLoginDocenteAjax();
    }
?>