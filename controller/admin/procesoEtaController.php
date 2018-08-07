<?php
	class procesoEtaController extends procesoEtaModel
	{
		public static function getProcesoEta(){
			return procesoEtaModel::getProcesoEtaModel();
		}

		public static function setProcesoEta($data){
			return procesoEtaModel::setProcesoEtaModel($data);
		}

		public static function getProcesoEtaId(){
			return procesoEtaModel::getProcesoEtaIdModel();
		}

		public static function getProcesoEtaNew($data){
			return procesoEtaModel::getProcesoEtaNewModel($data);
		}

		public static function getProcesoEtaUpdate($data){
			return procesoEtaModel::getProcesoEtaUpdateModel($data);
		}

		public static function getProcesoEtaDelete($data){
			return procesoETaModel::getProcesoEtaDeleteModel($data);
		}
	}
?>
