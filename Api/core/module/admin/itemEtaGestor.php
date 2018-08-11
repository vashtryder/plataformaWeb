<?php 
	include_once "../../../core/ControladorBase.php";
	
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
			$r = itemController::getItemNew($data);
			$enviarDatos = ($r !== false) ? array(1,GUARDADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function updateItemAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['proceso']);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['item']);
            array_push($data, 0);
            array_push($data, $_REQUEST['id']);
			$r = itemController::getItemUpdate($data);
			$enviarDatos = ($r !== false) ? array(1,ACTUALIZADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
        }

        public static function deleteItemAjax()
        {
			$r = itemController::getItemDelete($_REQUEST['id']);
			$enviarDatos = ($r !== false) ? array(1,ELIMINADO) : array(0,ERROR);
			print_r(json_encode($enviarDatos));
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