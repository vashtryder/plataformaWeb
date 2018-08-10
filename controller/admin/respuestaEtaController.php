<?php 
	class respuestaEtaController extends respuestaEtaModel
	{
		public static function getRespuestaEtaProcentaje($tabla,$tabla1,$tabla2){
			return respuestaEtaModel::getRespuestaEtaProcentajeModel($tabla,$tabla1,$tabla2);
		}

		public static function getRespuestaEta($data,$tabla){
			return respuestaEtaModel::getRespuestaEtaModel($data,$tabla);
		}

		public static function getRespuestaEtaId($data){
			return respuestaEtaModel::getRespuestaEtaIdModel($data);
		}

		public static function getRespuestaEtaNew($data,$respuestas,$tabla){
			return respuestaEtaModel::getRespuestaEtaNewModel($data,$respuestas,$tabla);
		}
	}
?>