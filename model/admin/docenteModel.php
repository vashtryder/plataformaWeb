<?php 
	class docenteModel extends EntidadBase
	{
		private static $table = 'tb_colegio_docente';
		private static $table_login = 'tb_colegio_login';

		public function __construct() {
			self::$table;
			self::$table_login;
		}

		public static function getPersonalModel()
        {
            $sql = "SELECT * FROM " . self::$table;
            return EntidadBase::consultaArray($sql);
        }

        public static function getPersonalVistaModel()
        {
            $sql = "SELECT * FROM vb_personal";
            return EntidadBase::consultaArray($sql);
		}
		
		public static function getPersonalAcademicoModel($data)
        {
            if($data == ''){
                $sql = "SELECT * FROM " . self::$table;
            } else {
                $sql = "SELECT * FROM " . self::$table . " WHERE ID_COLEGIO ='".EntidadBase::real_escape_string($data)."'";
            }
            return EntidadBase::consultaArray($sql);
        }

        public static function setPersonalModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_DOCENTE ='".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getPersonalColegioModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_COLEGIO ='".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaArray($sql);
		}

		public static function getPersonalIdModel()
        {
            $sql = "SELECT MAX(ID_DOCENTE) FROM " . self::$table . "";
            return EntidadBase::consultaForech($sql);
		}
		
		public static function getPersonalNewModel($data)
        {
            $sql = "INSERT INTO " . self::$table . "(ID_DOCENTE, ID_COLEGIO, ID_ANIO, DOCENTEPATERNO, DOCENTEMATERNO, DOCENTENOMBRES, DOCENTEDNI, DOCENTESEXO, DOCENTEEMAIL, DOCENTEDIRECCION, DOCENTETELEFONO1, DOCENTETELEFONO2, DOCENTEFECHANAC, DOCENTEFOTO) VALUES (
            '".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."',
            '".EntidadBase::real_escape_string($data[3])."',
            '".EntidadBase::real_escape_string($data[4])."',
            '".EntidadBase::real_escape_string($data[5])."',
            '".EntidadBase::real_escape_string($data[6])."',
            '".EntidadBase::real_escape_string($data[7])."',
            '".EntidadBase::real_escape_string($data[8])."',
            '".EntidadBase::real_escape_string($data[9])."',
            '".EntidadBase::real_escape_string($data[10])."',
            '".EntidadBase::real_escape_string($data[11])."',
            '".EntidadBase::real_escape_string($data[12])."',
            '".EntidadBase::real_escape_string($data[13])."'); ";
            return EntidadBase::consulta($sql);
            // return $sql;

		}
		
		public static function getPersonalUpdateModel($data)
        {
            $sql = "UPDATE " . self::$table . " SET
            ID_COLEGIO       = '".EntidadBase::real_escape_string($data[0])."',
            DOCENTEPATERNO   = '".EntidadBase::real_escape_string($data[1])."',
            DOCENTEMATERNO   = '".EntidadBase::real_escape_string($data[2])."',
            DOCENTENOMBRES   = '".EntidadBase::real_escape_string($data[3])."',
            DOCENTEDNI       = '".EntidadBase::real_escape_string($data[4])."',
            DOCENTESEXO      = '".EntidadBase::real_escape_string($data[5])."',
            DOCENTEEMAIL     = '".EntidadBase::real_escape_string($data[6])."',
            DOCENTEDIRECCION = '".EntidadBase::real_escape_string($data[7])."',
            DOCENTETELEFONO1 = '".EntidadBase::real_escape_string($data[8])."',
            DOCENTETELEFONO2 = '".EntidadBase::real_escape_string($data[9])."',
            DOCENTEFECHANAC  = '".EntidadBase::real_escape_string($data[10])."'
            WHERE ID_DOCENTE = '".EntidadBase::real_escape_string($data[11])."'";
            return EntidadBase::consulta($sql);
            // return $sql;

        }

        public static function getPersonalDeleteModel($data)
        {
            $sql = "DELETE FROM " . self::$table . " WHERE ID_DOCENTE = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
		}
		
		public static function getPersonalLoginIdModel()
        {
            $sql = "SELECT MAX(ID_LOGIN) FROM " . self::$table_login;
            return EntidadBase::consultaForech($sql);
		}
		
		public static function getPersonalLoginModuloModel($data)
        {
            $sql = "SELECT * FROM ". self::$table_login ." WHERE ID_MODULO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaArray($sql);
		}
		
		public static function setPersonalLoginModuloModel($data)
        {
            $sql = "SELECT * FROM ". self::$table_login ." WHERE ID_DOCENTE = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
		}
		
		public static function setPersonalLoginModel($data)
        {
            $sql = "SELECT * FROM ". self::$table_login . " WHERE ID_DOCENTE = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
		}
		
		public static function getPersonalLoginNewModel($data)
        {
            $sql = "INSERT INTO ". self::$table_login . " (ID_LOGIN, ID_DOCENTE, ID_MODULO,LOGINUSUARIO, LOGINPASSWORD, LOGINESTADO) VALUES
            ('".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."',
            '".EntidadBase::real_escape_string($data[3])."',
            '".EntidadBase::real_escape_string($data[4])."',
            '".EntidadBase::real_escape_string($data[5])."');";
            return EntidadBase::consulta($sql);
            // return $sql;
        }

	}
?>