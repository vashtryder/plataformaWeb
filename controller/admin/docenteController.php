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

		public static function getPersonalLoginIdModel(){
			return docenteModel::getPersonalLoginIdModel();
		}

		public static function getPersonalLoginModulo($data){
			return docenteModel::getPersonalLoginModuloModel($data);
		}

		public function setPersonalLogin($data){
			return docenteModel::setPersonalLoginModel($data);
		}

		public static function setPersonalLoginModulo($data){
			return docenteController::setPersonalLoginModuloModel($data);
		}

		public static function getPersonalLoginNew($data){
			return docenteController::getPersonalLoginNewModel($data);
		}
	}
?>