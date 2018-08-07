<?php
	class gradoController extends gradoModel
	{
		public static function getGrado(){
			return gradoModel::getGradoModel();
		}

		public static function setGrado($data){
			return gradoModel::setGradoModel($data);
		}

		public static function getGradoId(){
			return gradoModel::getGradoIdModel();
		}

		public static function setGradoAcademico($data){
			return gradoModel::setGradoAcademicoModel($data);
		}

		public static function getGradoNew($data){
			return gradoModel::getGradoNewModel($data);
		}

		public static function getGradoUpdate($data){
			return gradoModel::getGradoUpdateModel($data);
		}

		public static function getGradoDelete($data){
			return gradoModel::getGradoDeleteModel($data);
		}
	}
?>