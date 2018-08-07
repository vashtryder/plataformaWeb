<?php
	class preguntaEtaController extends preguntaEtaModel
	{
		public static function getPreguntaEta(){
			return preguntaEtaModel::getPreguntaEtaModel();
		}
		
		public static function setPreguntaEta($data){
			return preguntaEtaModel::setPreguntaEtaModel($data);
		}

		public static function getPreguntaEtaId(){
			return preguntaEtaModel::getPreguntaEtaIdModel();
		}

		public static function getPreguntaEtaNew($data){
			return preguntaEtaModel::getPreguntaEtaNewModel($data);
		}

		public static function getPreguntaEtaUpdate($data){
			return preguntaEtaModel::getPreguntaEtaUpdateModel($data);
		}

		public static function getPreguntaEtaDelete($data){
			return preguntaEtaModel::getPreguntaEtaDeleteModel($data);
		}
	}
?>