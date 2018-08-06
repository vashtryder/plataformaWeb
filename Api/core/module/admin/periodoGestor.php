<?php 

	include_once "Api/core/ControladorBase.php";

	class periodoGestor
	{
		public static function newPeriodoAjax()
        {
            $row   = gestorPeriodo::get_id_periodo($_SESSION['anio'][0]);
            $row_v = gestorPeriodo::get_id_valor($_SESSION['anio'][0]);
            $ValorPeriodo = ($row_v[0] == 4) ? 1 : ($row_v[0]+1);
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['anio']);
            array_push($data, $ValorPeriodo);
            array_push($data, $_REQUEST['periodo']);
            array_push($data, $_REQUEST['observacion']);

            return gestorPeriodo::new_periodo($data);
        }

        public static function updatePeriodoAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['periodo']);
            array_push($data, $_REQUEST['observacion']);
            array_push($data, $_REQUEST['id']);
            return gestorPeriodo::update_periodo($data);
        }

        public static function deletePeriodoAjax()
        {
            return gestorPeriodo::delete_periodo($_REQUEST['id']);
		}
	}

	if(isset($_REQUEST["new_periodo"])){
		GestorUsuarioModel::newPeriodoAjax();
	} else if(isset($_REQUEST["update_periodo"])){
		GestorUsuarioModel::updatePeriodoAjax();
	} else if(isset($_REQUEST["delete_periodo"])){
		GestorUsuarioModel::deletePeriodoAjax();
	}
?>
