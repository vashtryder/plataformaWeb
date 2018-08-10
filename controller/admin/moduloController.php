<?php
	class moduloController extends moduloModel
	{
		public static function getModulo(){
			return moduloModel::getModuloModel();
		}

		public static function setModulo($data){
			return moduloModel::setModuloModel($data);
		}

		public static function setModuloPersonal($data){
			return moduloModel::setModuloPersonalModel($data);
		}
	}
?>