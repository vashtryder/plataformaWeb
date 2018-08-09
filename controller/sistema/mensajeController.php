<?php
	class mensajeController extends mensajeModel
	{
		public static function getMensaje(){
			return mensajeModel::getMensajeModel();
		}

		public static function setMensaje($data){
			return mensajeModel::setMensajeModel($data);
		}

		public static function setMensajeEnviado($data){
			return mensajeModel::setMensajeEnviadoModel($data);
		}

		public static function setMensajeRecibido($data){
			return mensajeModel::setMensajeRecibidoModel($data);
		}

		public static function getMensajeId(){
			return mensajeModel::getMensajeIdModel();
		}

		public static function getMensajeNew($data){
			return mensajeModel::getMensajeNewModel($data);
		}

		public static function getMensajeUpdate(){
			return mensajeModel::getMensajeUpdateModel($data);
		}

		public static function getMensajeEnviado(){
			return mensajeModel::getMensajeEnviadoModel($data);
		}

		public static function getMensajeRecibido($data){
			return mensajeModel::getMensajeRecibidoModel($data);
		}

		public static function getMensajeDelete($data){
			return mensajeModel::getMensajeDeleteModel($data);
		}


	}
?>