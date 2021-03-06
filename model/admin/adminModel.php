<?php 
	class adminModel extends EntidadBase
	{
		private static $table = 'tb_administrador';
		private static $table_login = 'tb_administrador_login';

		public function __construct() {
			self::$table;
			self::$table_login;
		}

		public static function getAdministradorModel(){
			$sql = "SELECT * FROM " . self::$table;
            return EntidadBase::consultaArray($sql);
		}

		public static function setAdministradorModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_PERSONAL ='".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

		public static function getAdministradorLoginModel($data)
        {
            $sql = "SELECT * FROM " . self::$table_login . "
            WHERE
            	LOGINUSUARIO  = '".EntidadBase::real_escape_string($data[0])."' AND
            	LOGINPASSWORD = '".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consultaForech($sql);
		}
		
		public static function getAdministradorIdModel()
        {
            $sql = "SELECT MAX(ID_LOGIN) FROM " . self::$table;
            return EntidadBase::consultaForech($sql);
		}

		public static function getAdministradorUpdateModel($data)
        {
            $sql = "UPDATE " .self::$table ." SET
            PERSONALPATERNO   = '".EntidadBase::real_escape_string($data[0])."',
            PERSONALMATERNO   = '".EntidadBase::real_escape_string($data[1])."',
            PERSONANOMBRES    = '".EntidadBase::real_escape_string($data[2])."',
            PERSONALTELEFONO1 = '".EntidadBase::real_escape_string($data[3])."',
            PERSONALTELEFONO2 = '".EntidadBase::real_escape_string($data[4])."',
            PERSONALEMAIL     = '".EntidadBase::real_escape_string($data[5])."'
            WHERE ID_PERSONAL = '".EntidadBase::real_escape_string($data[6])."'";
			return EntidadBase::consulta($sql);
			// return $sql;
        }

        public static function getAdministradorPasswordModel($data)
        {
            $sql = "UPDATE " . self::$table_login . " SET
            LOGINPASSWORD  = '".EntidadBase::real_escape_string($data[0])."'
            WHERE ID_LOGIN = '".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consulta($sql);
        }

        public static function getAdministradorAvatarModel($data)
        {
            $sql = "UPDATE " . self::$table . " SET
            PERSONALFOTO  ='".EntidadBase::real_escape_string($data[0])."'
            WHERE ID_PERSONAL ='".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consulta($sql);
        }
	}
?>