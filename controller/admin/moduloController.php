<?php
	class moduloController extends moduloModel
	{
		public static function getModulo(){
			return moduloModel::getModuloModel();
		}

		public static function setModulo($data){
			return moduloModel::setModuloModel($data);
		}

		public static function setModuloPersonal(){
			return moduloModel::setModuloPersonalModel($data);
		}
	}
?>