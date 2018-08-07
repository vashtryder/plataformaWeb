<?php 
	include_once "Api/core/ControladorBase.php";
	
	class GestorItem
    {
		public static function newItemAjax()
        {
            $row = itemController::getItemId();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['proceso']);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['item']);
            array_push($data, 0);
            return itemController::getItemNew($data);
        }

        public static function updateItemAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['proceso']);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['item']);
            array_push($data, 0);
            array_push($data, $_REQUEST['id']);
            return itemController::getItemUpdate($data);
        }

        public static function deleteItemAjax()
        {
			return itemController::getItemDelete($_REQUEST['id']);
        }
	}

	if(isset($_REQUEST["new_item"])){
        GestorItem::newItemAjax();
    } else if(isset($_REQUEST["update_item"])){
        GestorItem::updateItemAjax();
    } else if(isset($_REQUEST["delete_item"])){
        GestorItem::deleteItemAjax();
    }

?>