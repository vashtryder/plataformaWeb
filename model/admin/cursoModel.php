<?php
	class cursoModel extends EntidadBase
	{
		private static $table = 'tb_colegio_curso';

		public function __construct() {
			self::$table;
		}

		public static function getCursoModel()
        {
            $sql = "SELECT * FROM " . self::$table;
            return EntidadBase::consultaArray($sql);
        }

        public static function setCursoModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . "  WHERE ID_CURSO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getCursoIdModel()
        {
            $sql = "SELECT MAX(ID_CURSO) FROM " . self::$table . " ";
            return EntidadBase::consultaForech($sql);
        }

        public static function getCursoNew($data)
        {
            $sql = "INSERT INTO " . self::$table . " (ID_CURSO, ID_ANIO, ID_AREA, CURSONOMBRE, CURSOABREVIATURA, CURSOORDEN) VALUES
            ('".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."',
            '".EntidadBase::real_escape_string($data[3])."',
            '".EntidadBase::real_escape_string($data[4])."',
            '".EntidadBase::real_escape_string($data[5])."')";
            return EntidadBase::consulta($sql);

        }

        public static function getCursoUpdateModel($data)
        {
            $sql = "UPDATE " . self::$table . "  SET
            ID_AREA          = '".EntidadBase::real_escape_string($data[0])."',
            CURSONOMBRE      = '".EntidadBase::real_escape_string($data[1])."',
            CURSOABREVIATURA = '".EntidadBase::real_escape_string($data[2])."',
            CURSOORDEN       = '".EntidadBase::real_escape_string($data[3])."'
            WHERE ID_CURSO   = '".EntidadBase::real_escape_string($data[4])."'";
            return EntidadBase::consulta($sql);
                        // return $sql;

        }

        public static function getCursoDeleteModel($data)
        {
            $sql = "DELETE FROM " . self::$table . "  WHERE ID_CURSO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
            // return $sql;
        }
    }
?>