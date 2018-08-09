<?php
	class mensajeModel extends EntidadBase
	{
		private static $table = 'tb_colegio_mensaje';

		public function __construct() {
			self::$table;
		}

		public static function getMensajeModel()
        {
            $sql = "SELECT * FROM ". self::$table;
            return EntidadBase::consultaArray($sql);
        }

        public static function setMensajeModel($data)
        {
            $sql = "SELECT * FROM ". self::$table." WHERE ID_mensaje = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function setMensajeEnviadoModel($data)
        {
            $sql = "SELECT
                *
            FROM
                ". self::$table."
            WHERE
                ID_COLEGIO = '".EntidadBase::real_escape_string($data[0])."' AND
                ID_DE = '".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consultaArray($sql);
        }

        public static function setMensajeRecibidoModel($data)
        {
            $sql = "SELECT
                *
            FROM
                ". self::$table."
            WHERE
                ID_COLEGIO = '".EntidadBase::real_escape_string($data[0])."' AND
                ID_PARA = '".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consultaArray($sql);
        }

        public static function getMensajeIdModel()
        {
            $sql = "SELECT MAX(ID_mensaje) FROM ". self::$table."";
            return EntidadBase::consultaForech($sql);
        }

        public static function getMensajeNewModel($data)
        {
            $sql = "INSERT INTO ". self::$table."(ID_MENSAJE, ID_COLEGIO, ID_MODULO, ID_PARA, ID_DE, LEIDO, FECHA, HORA, ASUNTO, TEXTO) VALUES (
            '".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."',
            '".EntidadBase::real_escape_string($data[3])."',
            '".EntidadBase::real_escape_string($data[4])."',
            '".EntidadBase::real_escape_string($data[5])."',
            '".EntidadBase::real_escape_string($data[6])."',
            '".EntidadBase::real_escape_string($data[7])."',
            '".EntidadBase::real_escape_string($data[8])."',
            '".EntidadBase::real_escape_string($data[9])."')";
            return EntidadBase::consulta($sql);
            // return $sql;
        }

        public static function getMensajeUpdateModel($data)
        {
            $sql = "";
            return EntidadBase::consulta($sql);

        }

        public static function getMensajeEnviadoModel($data)
        {
            $sql = "SELECT COUNT(ID_PARA) FROM `". self::$table."`
            WHERE
                ID_PARA = '".EntidadBase::real_escape_string($data[0])."' AND
                ID_COLEGIO = '".EntidadBase::real_escape_string($data[1])."' AND
                LEIDO NOT LIKE '%0%'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getMensajeRecibidoModel($data)
        {
            $sql = "SELECT COUNT(ID_DE) FROM ". self::$table . "
            WHERE
                ID_DE = '".EntidadBase::real_escape_string($data[0])."' AND
                ID_COLEGIO = '".EntidadBase::real_escape_string($data[1])."' ";
            return EntidadBase::consultaForech($sql);
        }

        public static function getMensajeEstadoModel($data)
        {
            $sql = "UPDATE ". self::$table." SET
                LEIDO ='".EntidadBase::real_escape_string($data[0])."'
            WHERE
                ID_MENSAJE= '".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consulta($sql);
            // return $sql;
        }

        public static function getMensajeDeleteModel($data)
        {
            $sql = "DELETE FROM ". self::$table." WHERE ID_MENSAJE = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
        }

	}
?>