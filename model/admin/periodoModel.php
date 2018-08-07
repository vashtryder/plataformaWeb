<?php
	class periodoModel extends EntidadBase
	{
		private static $table = 'tb_colegio_periodo';

		public function __construct() {
			self::$table;
		}

		public static function getPeriodoModel()
        {
            $sql = "SELECT * FROM " . self::$table;
            return EntidadBase::consultaArray($sql);
        }

        public static function setPeriodoModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . "
            WHERE ID_PERIODO = '".EntidadBase::real_escape_string($data[0])."'
            AND ID_ANIO ='".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getPeriodoValorModel($data)
        {
            $sql = "SELECT MAX(PERIODOVALOR) FROM " . self::$table . " WHERE ID_ANIO ='".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getPeriodoIdModel($data)
        {
            $sql = "SELECT MAX(ID_PERIODO) FROM " . self::$table . " WHERE ID_ANIO ='".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getPeriodoNewModel($data)
        {
            $sql = "INSERT INTO " . self::$table . "(ID_PERIODO, ID_ANIO, PERIODOVALOR,PERIODONOMBRE,PERIODOOBSERVACION) VALUES
            ('".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."',
            '".EntidadBase::real_escape_string($data[3])."',
            '".EntidadBase::real_escape_string($data[4])."')";
            return EntidadBase::consulta($sql);
        }

        public static function getPeriodoUpdateModel($data)
        {
            $sql = "UPDATE " . self::$table . " SET
            periodoNOMBRE='".EntidadBase::real_escape_string($data[0])."',
            PERIODOOBSERVACION = '".EntidadBase::real_escape_string($data[1])."'
            WHERE ID_PERIODO= '".EntidadBase::real_escape_string($data[2])."'";
            return EntidadBase::consulta($sql);
        }

        public static function getPeriodoDeleteModel($data)
        {
            $sql = "DELETE FROM tb_colegio_periodo WHERE ID_periodo = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
            // return $sql;
        }
    }
?>