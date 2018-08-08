<?php 
	class adminController extends adminModel
	{
		public static function getAdministrador(){
			return adminModel::getAdministradorModel();
		}

		public static function setAdministrador($data){
			return adminModel::setAdministradorModel($data);
		}

		public static function getAdministradorId(){
			return adminModel::getAdministradorIdModel();
		}

		public static function getAdministradorLogin($data){
			return adminModel::getAdministradorLoginModel($data);
		}

		public static function getAdministradorUpdate($data){
			return adminModel::getAdministradorUpdateModel($data);
		}

		public static function getAdministradorPassword($data){
			return adminModel::getAdministradorPasswordModel($data);
		}

		public static function getAdministradorAvatar($data){
			return adminModel::getAdministradorAvatarModel($data);
		}
	}
?>