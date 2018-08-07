<?php
	class gradoModel extends EntidadBase
	{
		private static $table = 'tb_colegio_grado';

		public function __construct() {
			self::$table;
		}

		public static function getGradoModel()
        {
            $sql = "SELECT * FROM " . self::$table;
            return EntidadBase::consultaArray($sql);
        }

        public static function setGradoModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_GRADO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function setGradoAcademicoModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE GRADONOMBRE = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }


        public static function getGradoIdModel()
        {
            $sql = "SELECT MAX(ID_GRADO) FROM " . self::$table . "";
            return EntidadBase::consultaForech($sql);
        }

        public static function getGradoNewModel($data)
        {
            $sql = "INSERT INTO " . self::$table . "(ID_GRADO, GRADONOMBRE, GRADOABREVIATURA) VALUES
            ('".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."')";
            return EntidadBase::consulta($sql);
        }

        public static function getGradoUpdateModel($data)
        {
            $sql = "UPDATE " . self::$table . " SET
            GRADONOMBRE='".EntidadBase::real_escape_string($data[0])."'
            WHERE ID_GRADO= '".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consulta($sql);
        }

        public static function getGradoDeleteModel($data)
        {
            $sql = "DELETE FROM " . self::$table . " WHERE ID_GRADO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
        }
    }
?>
