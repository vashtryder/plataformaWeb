<?php
	class semanaEtaController extends semanaEtaModel
	{
		public static function getSemanaEta(){
			return semanaEtaModel::getSemanaEtaModel();
		}

		public static function setSemanaEta($data){
			return semanaEtaModel::setSemanaEtaModel($data);
		}

		public static function getSemanaEtaFecha($data){
			return semanaEtaModel::getSemanaEtaFechaModel($data);
		}

		public static function getSemanaEtaAcademica($data){
			return semanaEtaModel::getSemanaEtaAcademicaModel($data);
		}

		public static function getSemanaEtaRegistro($data){
			return semanaEtaModel::getSemanaEtaRegistroModel($data);
		}

		public static function getSemanaEtaPeriodo($data){
			return semanaEtaModel::getSemanaEtaPeriodoModel($data);
		}

		public static function getSemanaEtaId(){
			return semanaEtaModel::getSemanaEtaIdModel();
		}

		public static function getSemanaEtaNew($data){
			return semanaEtaModel::getSemanaEtaNewModel($data);
		}

		public static function getSemanaEtaUpdate($data){
			return semanaEtaModel::getSemanaEtaUpdateModel($data);
		}

		public static function getSemanaEtaDelete($data){
			return semanaEtaModel::getSemanaEtaDeleteModel($data);
		}
	}
?>
