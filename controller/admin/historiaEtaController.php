<?php
	class historiaEtaController extends historiaEtaModel
	{
		public static function getHistoriaEta(){
			return historiaEtaModel::getHistoriaEtaModel();
		}

		public static function setHistoriaEta($data){
			return historiaEtaModel::setHistoriaEtaModel($data);
		}

		public static function getHistoriaEtaId(){
			return historiaEtaModel::getHistoriaEtaIdModel();
		}

		public static function getHistoriaEtaNew($data){
			return historiaEtaModel::getHistoriaEtaNewModel($data);
		}

		public static function getHistoriaEtaUpdate($data){
			return historiaEtaModel::getHistoriaEtaUpdateModel($data);
		}

		public static function getHistoriaEtaUpdateSimple($data){
			return historiaEtaModel::getHistoriaEtaUpdateSimpleModel($data);
		}

		public static function getHistoriaEtaDelete($data){
			return historiaEtaModel::getHistoriaEtaDeleteModel($data);
		}
	}
?>