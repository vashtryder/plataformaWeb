<?php
	class tutorController extends tutorModel
	{
		public static function getTutor(){
			return tutorModel::getTutorModel();
		}

		public static function setTutor($data){
			return tutorModel::setTutorModel($data);
		}

		public static function setTutorAcademico($data){
			return tutorModel::setTutorAcademicoModel($data);
		}

		public static function getTutorPersonal($data){
			return tutorModel::getTutorPersonalModel($data);
		}

		public static function getTutorId(){
			return tutorModel::getTutorIdModel();
		}

		public static function getTutorNew($data){
			return tutorModel::getTutorNewModel($data);
		}

		public static function getTutorUpdate($data){
			return tutorModel::getTutorUpdateModel($data);
		}

		public static function getTutorDelete($data){
			return tutorModel::getTutorDeleteModel($data);
		}

		public static function getTutorEta($data){
			return tutorModel::getTutorEtaModel($data);
		}

		public static function getTutorEtaGrado($data){
			return tutorModel::getTutorEtaGradoModel($data);
		}

		public static function getTutorReporte($data){
			return tutorModel::getTutorReporteModel($data);
		}

	}
?>