<?php
	class nivelController extends nivelModel
	{
		public static function getNivel(){
			return nivelModel::getNivelModel();
		}

		public static function setNivel($data){
			return nivelModel::setNivelModel($data);
		}

		public static function setNivelAcademico($data){
			return nivelModel::setNivelAcademicoModel($data);
		}

		public static function getNivelId(){
			return nivelModel::getNivelIdModel();
		}

		public static function getNivelNew($data){
			return nivelModel::getNivelNewModel($data);
		}

		public static function getNivelUpdate($data){
			return nivelModel::getNivelUpdateModel($data);
		}

		public static function getNivelDelete($data){
			return nivelModel::getNivelDeleteModel($data);
		}
	}
?>