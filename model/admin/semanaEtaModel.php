<?php
	class semanaEtaModel extends EntidadBase
	{
		private static $table = 'tb_eta_semana';

		public function __construct() {
			self::$table;
		}

		public static function getSemanaEtaModel()
        {
            $sql = "SELECT * FROM " . self::$table;
            return EntidadBase::consultaArray($sql);
		}
		
		public static function setSemanaEtaModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_SEMANA = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
		}
		
        public static function getSemanaEtaFechaModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE '".$data."' BETWEEN SEMANAINICIO AND SEMANAFIN";
            return EntidadBase::consultaForech($sql);
        }

        public static function getSemanaEtaAcademicaModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_PERIODO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaArray($sql);
        }

        public static function getSemanaEtaRegistroModel($data)
        {
            $sql = "SELECT
                " . self::$table . ".*
            FROM
                " . self::$table . "
            INNER JOIN tb_eta_registro on tb_eta_registro.ID_SEMANA = " . self::$table . ".ID_SEMANA
            WHERE
                tb_eta_registro.ID_REGISTRO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getSemanaEtaPeriodoModel($data)
        {
            $sql = "SELECT
                DISTINCT " . self::$table . ".*
            FROM
                " . self::$table . "
            INNER JOIN tb_eta_registro ON tb_eta_registro.ID_SEMANA = " . self::$table . ".ID_SEMANA
            WHERE
                " . self::$table . ".ID_PERIODO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaArray($sql);
		}
		
        public static function getSemanaEtaIdModel()
        {
            $sql = "SELECT MAX(ID_SEMANA) FROM " . self::$table . "";
            return EntidadBase::consultaForech($sql);
        }

        public static function getSemanaEtaNewModel($data)
        {
            $sql = "INSERT INTO " . self::$table . "(ID_SEMANA, ID_PERIODO, ID_ANIO, SEMANANOMBRE, SEMANAINICIO, SEMANAFIN) VALUES
            ('".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."',
            '".EntidadBase::real_escape_string($data[3])."',
            '".EntidadBase::real_escape_string($data[4])."',
            '".EntidadBase::real_escape_string($data[5])."')";
            return EntidadBase::consulta($sql);
			// return $sql;
		}

        public static function getSemanaEtaUpdateModel($data)
        {
            $sql = "UPDATE " . self::$table . " SET
            ID_PERIODO='".EntidadBase::real_escape_string($data[0])."',
            SEMANANOMBRE='".EntidadBase::real_escape_string($data[1])."',
            SEMANAINICIO='".EntidadBase::real_escape_string($data[2])."',
            SEMANAFIN='".EntidadBase::real_escape_string($data[3])."'
             WHERE ID_SEMANA='".EntidadBase::real_escape_string($data[4])."'";
            return EntidadBase::consulta($sql);
            
        }

        public static function getSemanaEtaDeleteModel($data)
        {
            $sql = "DELETE FROM " . self::$table . " WHERE ID_SEMANA = '".EntidadBase::real_escape_string($data)."'";
			return EntidadBase::consulta($sql);
			// return $sql;
        }
    }
?>

