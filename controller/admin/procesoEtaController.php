<?php
	class procesoETaController extends procesoETaModel
	{
		public static function getProcesoEta(){
			return procesoETaModel::getProcesoEtaModel();
		}

		public static function setProcesoEta($data){
			return procesoETaModel::setProcesoEtaModel($data);
		}

		public static function getProcesoEtaId(){
			return procesoETaModel::getProcesoEtaIdModel();
		}

		public static function getProcesoEtaNew($data){
			return procesoETaModel::getProcesoEtaNewModel($data);
		}

		public static function getProcesoEtaUpdate($data){
			return procesoETaModel::getProcesoEtaUpdateModel($data);
		}

		public static function getProcesoEtaDelete($data){
			return procesoETaModel::getProcesoEtaDeleteModel($data);
		}
	}
?>
