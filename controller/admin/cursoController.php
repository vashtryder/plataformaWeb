<?php
	class cursoController extends cursoModel
	{
		public static function getCurso(){
			return cursoModel::getCursoModel();
		}

		public static function setCurso($data){
			return cursoModel::setCursoModel($data);
		}

		public static function getCursoId(){
			return cursoModel::getCursoIdModel();
		}

		public static function getCursoNew($data){
			return cursoModel::getCursoNewModel($data);
		}

		public static function getCursoUpdate($data){
			return cursoModel::getCursoUpdateModel($data);
		}

		public static function getCursoDelete($data){
			return cursoModel::getCursoDeleteModel($data);
		}
	}
?>