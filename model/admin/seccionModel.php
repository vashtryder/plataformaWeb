<?php
	class seccionModel extends EntidadBase
	{
		private static $table = 'tb_colegio_seccion';

		public function __construct() {
			self::$table;
		}

		public static function getSeccionModel()
        {
            $sql = "SELECT * FROM " . self::$table;
            return EntidadBase::consultaArray($sql);
        }

        public static function setSeccionModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_SECCION = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function setSeccionAcademicoModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE SECCIONNOMBRE = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getSeccionIdModel()
        {
            $sql = "SELECT MAX(ID_SECCION) FROM " . self::$table . "";
            return EntidadBase::consultaForech($sql);
        }

        public static function getSeccionNewModel($data)
        {
            $sql = "INSERT INTO " . self::$table . "(ID_SECCION, SECCIONNOMBRE, SECCIONABREVIATURA) VALUES
            ('".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."')";
            return EntidadBase::consulta($sql);
        }

        public static function getSeccionUpdateModel($data)
        {
            $sql = "UPDATE " . self::$table . " SET
            SECCIONNOMBRE='".EntidadBase::real_escape_string($data[0])."'
            WHERE ID_SECCION= '".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consulta($sql);
            // return $sql;
        }

        public static function getSeccionDeleteModel($data)
        {
            $sql = "DELETE FROM " . self::$table . " WHERE ID_SECCION = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
        }
    }
?>
