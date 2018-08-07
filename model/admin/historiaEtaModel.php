<?php
	class historiaEtaModel extends EntidadBase
	{
		private static $table = 'tb_administrador_evento';

		public function __construct() {
			self::$table;
		}

		public static function getHistoriaEtaModel()
        {
            $sql = "SELECT * FROM " . self::$table;
            return EntidadBase::consultaArray($sql);
        }

        public static function setHistoriaEtaModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE id = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getHistoriaEtaIdModel()
        {
            $sql = "SELECT MAX(id) FROM " . self::$table . "";
            return EntidadBase::consultaForech($sql);
        }

        public static function getHistoriaEtaNewModel($data)
        {
           $sql = "INSERT INTO `" . self::$table . "`(`id`,`title`,`description`,`location`,`contact`,`url`,`start`,`end`) VALUES (
            '".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."',
            '".EntidadBase::real_escape_string($data[3])."',
            '".EntidadBase::real_escape_string($data[4])."',
            '".EntidadBase::real_escape_string($data[5])."',
            '".EntidadBase::real_escape_string($data[6])."',
            '".EntidadBase::real_escape_string($data[7])."')";
            return EntidadBase::consulta($sql);
            // return $sql;
        }

        public static function getHistoriaEtaUpdateModel($data)
        {
            $sql = "UPDATE " . self::$table . " SET
            title       = '".EntidadBase::real_escape_string($data[0])."',
            description = '".EntidadBase::real_escape_string($data[1])."',
            location    = '".EntidadBase::real_escape_string($data[2])."',
            contact     = '".EntidadBase::real_escape_string($data[3])."',
            url         = '".EntidadBase::real_escape_string($data[4])."',
            start       = '".EntidadBase::real_escape_string($data[5])."',
            end         = '".EntidadBase::real_escape_string($data[6])."'
            WHERE id= '".EntidadBase::real_escape_string($data[7])."'";
            return EntidadBase::consulta($sql);
        }

        public static function getHistoriaEtaUpdateSimpleModel($data)
        {
            $sql = "UPDATE " . self::$table . " SET
            title       = '".EntidadBase::real_escape_string($data[0])."',
            description = '".EntidadBase::real_escape_string($data[1])."',
            start       = '".EntidadBase::real_escape_string($data[2])."',
            end         = '".EntidadBase::real_escape_string($data[3])."'
            WHERE id = '".EntidadBase::real_escape_string($data[4])."'";
            return EntidadBase::consulta($sql);
        }

        public static function getHistoriaEtaDeleteModel($data)
        {
            $sql = "DELETE FROM " . self::$table . " WHERE id = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
        }
    }
?>


   