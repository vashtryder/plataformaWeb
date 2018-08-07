<?php
	class procesoEtaModel extends EntidadBase
	{
		private static $table = 'tb_administrador_proceso';

		public function __construct() {
			self::$table;
		}

		public static function getProcesoEtaModel()
        {
            $sql = "SELECT * FROM " . self::$table;
            return EntidadBase::consultaArray($sql);
        }

        public static function setProcesoEtaModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_PROCESO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getProcesoEtaIdModel()
        {
            $sql = "SELECT MAX(ID_PROCESO) FROM " . self::$table . "";
            return EntidadBase::consultaForech($sql);
        }

        public static function getProcesoEtaNewModel($data)
        {
            $sql = "INSERT INTO " . self::$table . "(ID_PROCESO, PROCESOTITULO, PROCESOORDEN)
            VALUES (
            '".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."')";
            return EntidadBase::consulta($sql);
        }

        public static function getProcesoEtaUpdateModel($data)
        {
            $sql = "UPDATE " . self::$table . " SET
            PROCESOTITULO    = '".EntidadBase::real_escape_string($data[0])."',
            PROCESOORDEN     = '".EntidadBase::real_escape_string($data[1])."'
            WHERE ID_PROCESO = '".EntidadBase::real_escape_string($data[2])."'";
            return EntidadBase::consulta($sql);
        }

        public static function getProcesoEtaDeleteModel($data)
        {
            $sql = "DELETE FROM " . self::$table . " WHERE ID_PROCESO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
        }
    }
?>