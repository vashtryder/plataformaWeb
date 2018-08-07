<?php
	class preguntaEtaModel extends EntidadBase
	{
		private static $table = 'tb_eta_configuracion';

		public function __construct() {
			self::$table;
		}

		public static function getPreguntaEtaModel()
        {
            $sql = "SELECT * FROM " . self::$table . "";
            return EntidadBase::consultaArray($sql);
        }

        public static function setPreguntaEtaModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_CONFIGURACION = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getPreguntaEtaIdModel()
        {
            $sql = "SELECT MAX(ID_CONFIGURACION) FROM " . self::$table;
            return EntidadBase::consultaForech($sql);
        }

        public static function getPreguntaEtaNewModel($data)
        {
            $sql = "INSERT INTO " . self::$table . "(ID_CONFIGURACION, ID_ANIO, ID_CURSO, CONFIGURARIONETA, CONFIGURACIONPREGUNTA) VALUES (
            '".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."',
            '".EntidadBase::real_escape_string($data[3])."',
            '".EntidadBase::real_escape_string($data[4])."')";
            return EntidadBase::consulta($sql);
        }

        public static function getPreguntaEtaUpdateModel($data)
        {
            $sql = "UPDATE " . self::$table . " SET
            ID_CURSO               = '".EntidadBase::real_escape_string($data[0])."',
            CONFIGURARIONETA       = '".EntidadBase::real_escape_string($data[1])."',
            CONFIGURACIONPREGUNTA  = '".EntidadBase::real_escape_string($data[2])."'
            WHERE ID_CONFIGURACION = '".EntidadBase::real_escape_string($data[3])."'";
            return EntidadBase::consulta($sql);
            // return $sql;
        }

        public static function getPreguntaEtaDeleteModel($data)
        {
            $sql = "DELETE FROM " . self::$table . " WHERE ID_CONFIGURACION = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
            // return $sql;
        }
    }
?>