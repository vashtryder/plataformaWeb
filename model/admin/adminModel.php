<?php 
	class adminModel extends EntidadBase
	{
		private static $table = 'tb_administrador_login';

		public function __construct() {
			self::$table;
		}

		public static function getAdministradorModel(){
			$sql = "SELECT * FROM " . self::$table;
            return EntidadBase::consultaArray($sql);
		}

		public static function getAdministradorLoginModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . "
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
	}
?>