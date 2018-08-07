<?php
	class colegioController extends colegioModel
	{
		public static function getColegio(){
			return colegioModel::getColegioModel();
		}

		public static function setColegio($data){
			return colegioModel::setColegioModel($data);
		}

		public static function getColegioId(){
			return colegioModel::getColegioIdModel();
		}

		public static function getColegioNew($data){
			return colegioModel::getColegioNewModel($data);
		}

		public static function getColegioUpdate($data){
			return colegioModel::getColegioUpdateModel($data);
		}

		public static function getColegioDelete($data){
			return colegioModel::getColegioDeleteModel($data);
		}

	}
?>