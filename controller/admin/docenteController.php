<?php 
	class docenteController extends docenteModel
	{
		public static function getPersonal(){
			return docenteModel::getPersonalModel();
		}

		public static function getPersonalVista(){
			return docenteModel::getPersonalVistaModel();
		}

		public static function getPersonalAcademico($data){
			return docenteModel::getPersonalAcademicoModel($data);
		}

		public static function setPersonal($data){
			return docenteModel::setPersonalModel($data);
		}

		public static function getPersonalColegio($data){
			return docenteModel::getPersonalColegioModel($data);
		}

		public static function getPersonalNew($data){
			return docenteModel::getPersonalNewModel($data);
		}

		public static function getPersonalUpdate($data){
			return docenteModel::getPersonalUpdateModel($data);
		}

		public static function getPersonalDelete(){
			return docenteModel::getPersonalDeleteModel($data);
		}

		
	}
?>