<?php
	class seccionController extends seccionModel
	{
		public static function getSeccion(){
			return seccionModel::getSeccionModel();
		}

		public static function setSeccion($data){
			return seccionModel::setSeccionModel($data);
		}

		public static function setSeccionAcademico($data){
			return seccionModel::setSeccionAcademicoModel($data);
		}

		public static function getSeccionId(){
			return seccionModel::getSeccionIdModel();
		}

		public static function getSeccionNew($data){
			return seccionModel::getSeccionNewModel($data);
		}

		public static function getSeccionUpdate($data){
			return seccionModel::getSeccionUpdateModel($data);
		}

		public static function getSeccionDeleteModel($data){
			return seccionModel::getSeccionDeleteModel($data);
		}
	}
?>