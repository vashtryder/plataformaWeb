<?php
	class periodoController extends periodoModel
	{
		public static function getPeriodo(){
			return periodoModel::getPeriodoModel();
		}

		public static function setPeriodo($data){
			return periodoModel::setPeriodoModel($data);
		}

		public static function getPeriodoValor($data){
			return periodoModel::getPeriodoValorModel($data);
		}

		public static function getPeriodoId($data){
			return periodoModel::getPeriodoIdModel($data);
		}

		public static function getPeriodoNew($data){
			return periodoModel::getPeriodoNewModel($data);
		}

		public static function getPeriodoUpdate($data){
			return periodoModel::getPeriodoUpdateModel($data);
		}

		public static function getPeriodoDelete($data){
			return periodoModel::getPeriodoDeleteModel($data);
		}
	}
?>