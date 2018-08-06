<?php 
	include_once "Api/core/ControladorBase.php";
	
	class itemEtaGestor
    {
		public static function newItemAjax()
        {
            $row = gestorItem::get_id_item();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['proceso']);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['item']);
            array_push($data, 0);
            return gestoritem::new_item($data);
        }

        public static function updateItemAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['proceso']);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['item']);
            array_push($data, 0);
            array_push($data, $_REQUEST['id']);
            return gestorItem::update_item($data);
        }

        public static function deleteItemAjax()
        {
            return gestorItem::delete_item($_REQUEST['id']);
        }
	}

	if(isset($_REQUEST["new_item"])){
        GestorUsuarioModel::newItemAjax();
    } else if(isset($_REQUEST["update_item"])){
        GestorUsuarioModel::updateItemAjax();
    } else if(isset($_REQUEST["delete_item"])){
        GestorUsuarioModel::deleteItemAjax();
    }

?>