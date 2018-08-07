<?php
	class registroEtaController extends registroEtaModel
	{
		public function getRegistroEta(){
			return registroEtaModel::getRegistroEtaModel();
		}

		public static function setRegistroEta($data){
			return registroEtaModel::setRegistroEtaModel($data);
		}

		public static function getRegistroEtaGrupo($data){
			return registroEtaModel::getRegistroEtaGrupoModel($data);
		}

		public static function getRegistroEtaId(){
			return registroEtaModel::getRegistroEtaIdModel();
		}

		public static function getRegistroEtaDelete($data){
			return registroEtaModel::getRegistroEtaDeleteModel($data);
		}

		public static function getRegistroEtaNew($data){
			return registroEtaModel::getRegistroEtaNewModel($data);
		}

		public static function getRegistroEtaEstudianteNew($data){
			return registroEtaModel::getRegistroEtaEstudianteNewModel($data);
		}

		public static function getRegistroEtaAula($data){
			return registroEtaModel::getRegistroEtaAulaModel($data);
		}

		public static function getRegistroEtaGrado($data){
			return registroEtaModel::getRegistroEtaGradoModel($data);
		}

		public static function getRegistroEtaPromedio($data,$tabla){
			return registroEtaModel::getRegistroEtaPromedioModel($data,$tabla);
		}

		public static function getRegistroEtaMaximo($data,$tabla){
			return registroEtaModel::getRegistroEtaMaximoModel($data,$tabla);
		}

		public static function getRegistroEtaMinimo($data,$tabla){
			return registroEtaModel::getRegistroEtaMinimoModel($data,$tabla);
		}

		public static function getRegistroEtaMaximoError($data,$tabla){
			return registroEtaModel::getRegistroEtaMaximoErrorModel($data,$tabla);
		}

		public static function getRegistroEtaMinimoError($data,$tabla){
			return registroEtaModel::getRegistroEtaMinimoErrorModel($data,$tabla);
		}

		public static function getRegistroEtaGrupoAnio($data){
			return registroEtaModel::getRegistroEtaGrupoAnioModel($data);
		}

		public static function getRegistroEtaGrupoAula($data){
			return registroEtaModel::getRegistroEtaGrupoAulaModel($data);
		}

		public static function getRegistroEtaGrupoGrado($data){
			return registroEtaModel::getRegistroEtaGrupoGradoModel($data);
		}

	}
?>