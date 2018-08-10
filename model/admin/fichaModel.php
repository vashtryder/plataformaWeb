<?php
	class fichaModel extends EntidadBase
	{
		private static $table = 'tb_colegio_ficha';

		public function __construct() {
			self::$table;
		}

		public static function getFichaModel()
        {
            $sql = "SELECT * FROM ".self::$table;
            return EntidadBase::consultaArray($sql);
        }

        public static function setFichaModel($data)
        {
            $sql = "SELECT * FROM ".self::$table." WHERE ID_FICHA = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function setFichaEstudianteModel($data)
        {
            $sql = "SELECT * FROM ".self::$table." WHERE ID_ESTUDIANTE = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getFichaIdModel()
        {
            $sql = "SELECT MAX(ID_FICHA) FROM ".self::$table;
            return EntidadBase::consultaForech($sql);
        }

        public static function getFichaCodigoEtaModel($data)
        {
            $sql = "SELECT MAX(CODETA)-1000 FROM ".self::$table." WHERE ID_COLEGIO='".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getFichaCodigoModel()
        {
            $sql = "SELECT MAX(CODETA)-1000 FROM ".self::$table."";
            return EntidadBase::consultaForech($sql);
        }

        public static function getFichaNewModel($data)
        {
            $sql = "INSERT INTO ".self::$table."(ID_FICHA, ID_COLEGIO, ID_ANIO, ID_ESTUDIANTE, ID_GRADO, ID_SECCION, ID_NIVEL, CODETA, FICHAESTADO, FICHAFECHA, FICHAHORA) VALUES
            ('".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."',
            '".EntidadBase::real_escape_string($data[3])."',
            '".EntidadBase::real_escape_string($data[4])."',
            '".EntidadBase::real_escape_string($data[5])."',
            '".EntidadBase::real_escape_string($data[6])."',
            '".EntidadBase::real_escape_string($data[7])."',
            '".EntidadBase::real_escape_string($data[8])."',
            '".EntidadBase::real_escape_string($data[9])."',
            '".EntidadBase::real_escape_string($data[10])."')";
            return EntidadBase::consulta($sql);
        }

        public static function getFichaUpdateModel($data)
        {
            $sql = "UPDATE ".self::$table." SET
            ID_COLEGIO     ='".EntidadBase::real_escape_string($data[0])."',
            ID_GRADO       ='".EntidadBase::real_escape_string($data[1])."',
            ID_SECCION     ='".EntidadBase::real_escape_string($data[2])."',
            ID_NIVEL       ='".EntidadBase::real_escape_string($data[3])."'
            WHERE ID_FICHA ='".EntidadBase::real_escape_string($data[4])."'";
            return EntidadBase::consulta($sql);
            // return $sql;
        }

        public static function getFichaDeleteModel($data)
        {
            $sql = "DELETE FROM ".self::$table." WHERE ID_ficha = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
        }

        public static function getFichaEstadoModel($data)
        {
            $sql = "UPDATE ".self::$table." SET
            FICHAESTADO    = '".EntidadBase::real_escape_string($data[0])."'
            WHERE ID_FICHA = '".EntidadBase::real_escape_string($data[1])."'";
            return EntidadBase::consulta($sql);
            // return $sql;
        }

	}
?>