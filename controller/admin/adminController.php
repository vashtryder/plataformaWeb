<?php 
	class adminController extends adminModel
	{
		public static function getAdministrador(){
			return adminModel::getAdministradorModel();
		}

		public static function getAdministradorId(){
			return adminModel::getAdministradorIdModel();
		}

		public static function getAdministradorLogin($data){
			return adminModel::getAdministradorLoginModel($data);
		}
	}
	
?>