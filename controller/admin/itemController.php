
<?php
	class itemController extends itemModel
	{
		public static function getItem(){
			return itemModel::getItemModel();
		}

		public static function setItemProceso($data){
			return itemModel::setItemProcesoModel($data);
		}

		public static function setItem($data){
			return itemModel::setItemModel($data)
		}

		public static function getItemId(){
			return itemController::getItemIdModel();
		}

		public static function getItemNew($data){
			return itemController::getItemNewModel($data);
		}

		public static function getItemUpdate($data){
			return itemController::getItemUpdateModel($data);
		}

		public static function getItemDelete($data){
			return itemController::getItemDeleteModel($data);
		}
	}
?>