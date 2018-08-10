<?php 
	class estudianteController extends estudianteModel
	{
		public static function getEstudianteReporte($data){
			return estudianteModel::getEstudianteReporteModel($data);
		}

		public static function getEstudiante(){
			return estudianteModel::getEstudianteModel();
		}

		public static function getEstudianteVista(){
			return estudianteModel::getEstudianteVistaModel();
		}

		public static function setEstudiante($data){
			return estudianteModel::setEstudianteModel($data);
		}

		public static function getEstudianteId(){
			return estudianteModel::getEstudianteIdModel();
		}

		public static function getEstudianteAcademico($data){
			return estudianteModel::getEstudianteAcademicoModel($data);
		}

		public static function getEstudianteCodigo(){
			return estudianteModel::getEstudianteCodigoModel();
		}

		public static function getEstudianteIdLogin(){
			return estudianteController::getEstudianteIdLoginModel();
		}
		public static function getEstudianteLogin($data){
			return estudianteModel::getEstudianteLoginModel($data);
		}

		public static function getEstudianteNew($data){
			return estudianteModel::getEstudianteNewModel($data);
		}

		public static function getEstudianteUpdate($data){
			return estudianteModel::getEstudianteUpdateModel($data);
		}

		public static function getEstudianteDelete($data){
			return estudianteModel::getEstudianteDeleteModel($data);
		}

		public static function getEstudianteAvatar($data){
			return estudianteModel::getEstudianteAvatarModel($data);
		}

		public static function getEstudianteLoginNew($data){
			return estudianteModel::getEstudianteLoginNewModel($data);
		}


	}
?>