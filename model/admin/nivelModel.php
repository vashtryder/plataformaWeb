<?php
	class nivelModel extends EntidadBase
	{
		private static $table = 'tb_colegio_nivel';

		public function __construct() {
			self::$table;
		}

		public static function getNivelModel()
        {
            $sql = "SELECT * FROM " . self::$table;
            return EntidadBase::consultaArray($sql);
        }

        public static function setNivelModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_NIVEL = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function setNivelAcademicoModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE NIVELNOMBRE = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getNivelIdModel()
        {
            $sql = "SELECT MAX(ID_NIVEL) FROM " . self::$table . "";
            return EntidadBase::consultaForech($sql);
        }

        public static function getNivelNewModel($data)
        {
            $sql = "INSERT INTO " . self::$table . "(ID_NIVEL, NIVELNOMBRE, NIVELABREVIATURA) VALUES
            ('".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."')";
            return EntidadBase::consulta($sql);
        }

        public static function getNivelUpdateModel($data)
        {
            $sql = "UPDATE " . self::$table . " SET
            NIVELNOMBRE='".EntidadBase::real_escape_string($data[0])."'
            WHERE ID_NIVEL= '".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consulta($sql);
            // return $sql;
        }

        public static function getNivelDeleteModel($data)
        {
            $sql = "DELETE FROM " . self::$table . " WHERE ID_NIVEL = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
        }
    }
?>