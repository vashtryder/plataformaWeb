<?php
	class colegioModel extends EntidadBase
	{
		private static $table = 'tb_colegio';

		public function __construct() {
			self::$table;
		}

		public static function getColegioModel()
        {
            $sql = "SELECT * FROM " . self::$table;
            return EntidadBase::consultaArray($sql);
        }

        public static function setColegioModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . "  WHERE ID_COLEGIO ='".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getColegioIdModel()
        {
           $sql = "SELECT max(ID_COLEGIO) FROM " . self::$table . " ";
           return EntidadBase::consultaForech($sql);
        }

        public static function getColegioNewModel($data)
        {
            $sql = "INSERT INTO " . self::$table . " (ID_COLEGIO, COLEGIONOMBRE, COLEGIODIRECCION, COLEGIOTELEFONO1, COLEGIOTELEFONO2, COLEGIOACRONIMO, COLEGIOWEBSITE, COLEGIOFACEBOOK, COLEGIOYOUTUBE, COLEGIOEMAIL) VALUES
            (
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
        }

        public static function getColegioUpdateModel($data)
        {
            $sql = "UPDATE " . self::$table . "  SET
            COLEGIONOMBRE    = '".EntidadBase::real_escape_string($data[0])."',
            COLEGIODIRECCION = '".EntidadBase::real_escape_string($data[1])."',
            COLEGIOTELEFONO1 = '".EntidadBase::real_escape_string($data[2])."',
            COLEGIOTELEFONO2 = '".EntidadBase::real_escape_string($data[3])."',
            COLEGIOACRONIMO  = '".EntidadBase::real_escape_string($data[4])."',
            COLEGIOWEBSITE   = '".EntidadBase::real_escape_string($data[5])."',
            COLEGIOFACEBOOK  = '".EntidadBase::real_escape_string($data[6])."',
            COLEGIOYOUTUBE   = '".EntidadBase::real_escape_string($data[7])."',
            COLEGIOEMAIL     = '".EntidadBase::real_escape_string($data[8])."'
            WHERE ID_COLEGIO = '".EntidadBase::real_escape_string($data[9])."'";
            return EntidadBase::consulta($sql);
        }

        public static function getColegioDeleteModel($data)
        {
           $sql = "DELETE FROM " . self::$table . " WHERE ID_COLEGIO = '".EntidadBase::real_escape_string($data)."'";
           return EntidadBase::consulta($sql);
        }
    }
?>

