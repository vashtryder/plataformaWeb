<?php
	class anioModel extends EntidadBase
	{
		private static $table = 'tb_administrador_anio';

		public function __construct() {
			self::$table;
		}
		
		public static function getAnioModel()
        {
            $sql = "SELECT * FROM " . self::$table;
            return EntidadBase::consultaArray($sql);
        }

        public static function setAnioModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . "  WHERE ID_ANIO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function setAnioAcademicoModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . "  WHERE ANIONOMBRE = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getAnioIdModel()
        {
            $sql = "SELECT MAX(ID_ANIO) FROM " . self::$table;
            return EntidadBase::consultaForech($sql);
        }

        public static function getAnioNewModel($data)
        {
            $sql = "INSERT INTO " . self::$table . " (ID_ANIO, ANIONOMBRE, ANIOESTADO) VALUES
            ('".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."')";
            return EntidadBase::consulta($sql);
        }

        public static function getAnioUpdateModel($data)
        {
            $sql = "UPDATE " . self::$table . "  SET
            ANIONOMBRE='".EntidadBase::real_escape_string($data[0])."'
            WHERE ID_ANIO= '".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consulta($sql);
            // return $sql;
        }


        public static function getAnioEstadoModel($data)
        {
            $sql = "UPDATE " . self::$table . "  SET
            ANIOESTADO='".EntidadBase::real_escape_string($data[0])."'
            WHERE ID_ANIO= '".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consulta($sql);
            // return $sql;
        }

        public static function getAnioDeleteModel($data)
        {
            $sql = "DELETE FROM " . self::$table . "  WHERE ID_ANIO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
        }
	}
?>
