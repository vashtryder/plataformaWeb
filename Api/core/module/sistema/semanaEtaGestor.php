<?php 

	include_once "Api/core/ControladorBase.php";

	class semanaEtaGestor
	{
		public static function newSemanaAjax()
        {
            $row = gestorSemana::get_id_semana();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['unidad']);
            array_push($data, $_REQUEST['idanio']);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['fechaini']);
            array_push($data, $_REQUEST['fechafin']);
            return gestorSemana::new_semana($data);
        }

        public static function updateSemanaAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['unidad']);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['fechaini']);
            array_push($data, $_REQUEST['fechafin']);
            array_push($data, $_REQUEST['id']);
            return gestorSemana::update_semana($data);
        }

        public static function deleteSemanaAjax()
        {
            return gestorSemana::delete_semana($_REQUEST['id']);
		}
	}

	if(isset($_REQUEST["new_semana"])){
		GestorUsuarioModel::newSemanaAjax();
	} else if(isset($_REQUEST["update_semana"])){
		GestorUsuarioModel::updateSemanaAjax();
	} else if(isset($_REQUEST["delete_semana"])){
		GestorUsuarioModel::deleteSemanaAjax();
	}
?>