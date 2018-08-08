<?php
	class anioController extends anioModel
	{
		public static function getAnio(){
			return anioModel::getAnioModel();
		}

		public static function setAnio($data){
			return anioModel::setAnioModel($data);
		}

		public static function setAnioAcademico($data){
			return anioModel::setAnioAcademicoModel($data);
		}

		public static function getAnioId(){
			return anioModel::getAnioIdModel();
		}

		public static function getAnioNew($data){
			return anioModel::getAnioNewModel($data);
		}

		public static function getAnioUpdate($data){
			return anioModel::getAnioUpdateModel($data);
		}

		public static function getAnioDelete($data){
			return anioModel::getAnioDeleteModel($data);
		}

		public static function getAnioEstado($data){
			return anioModel::getAnioEstadoModel($data);
		}
	}
?>

   