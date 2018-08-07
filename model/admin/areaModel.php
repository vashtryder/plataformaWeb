<?php
	class areaModel extends EntidadBase
	{
		private static $table = 'tb_colegio_area';

		public function __construct() {
			self::$table;
		}

		public static function getAreaModel()
        {
            $sql = "SELECT * FROM " . self::$table;
            return EntidadBase::consultaArray($sql);
        }

        public static function setAreaModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_AREA = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getAreaIdModel()
        {
            $sql = "SELECT MAX(ID_AREA) FROM " . self::$table;
            return EntidadBase::consultaForech($sql);
        }

        public static function getAreaNewModel($data)
        {
            $sql = "INSERT INTO " . self::$table . "(ID_AREA, ID_ANIO, ID_NIVEL, AREANOMBRE, AREAABREVIATURA, AREAORDEN) VALUES
            ('".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."',
            '".EntidadBase::real_escape_string($data[3])."',
            '".EntidadBase::real_escape_string($data[4])."',
            '".EntidadBase::real_escape_string($data[5])."')";
            return EntidadBase::consulta($sql);
        }

        public static function getAreaUpdateModel($data)
        {
            $sql = "UPDATE " . self::$table . " SET
            ID_NIVEL        = '".EntidadBase::real_escape_string($data[0])."',
            AREANOMBRE      = '".EntidadBase::real_escape_string($data[1])."',
            AREAABREVIATURA = '".EntidadBase::real_escape_string($data[2])."',
            AREAORDEN       = '".EntidadBase::real_escape_string($data[3])."'
            WHERE ID_AREA   = '".EntidadBase::real_escape_string($data[4])."'";
            return EntidadBase::consulta($sql);
            // return $sql;
        }

        public static function getAreaDeleteModel($data)
        {
            $sql = "DELETE FROM " . self::$table . " WHERE ID_AREA = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
        }
    }
?>