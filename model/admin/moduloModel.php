<?php 
	class moduloModel extends EntidadBase
	{
		private static $table = 'tb_administrador_modulo';

		public function __construct() {
			self::$table;
		}

		public static function getModuloModel()
        {
			return EntidadBase::consultaArray("SELECT * FROM " . self::$table . " 
			WHERE MODULOVALOR='1'");
        }

        public static function setModuloModel($data)
        {
			return EntidadBase::consultaForech("SELECT * FROM " . self::$table . " 
			WHERE ID_MODULO ='".EntidadBase::real_escape_string($data)."'");
        }

        public static function setModuloPersonalModel($data)
        {
			return EntidadBase::consultaForech("SELECT * FROM " . self::$table . "
			WHERE MODULONOMBRE ='".EntidadBase::real_escape_string($data)."'");
        }
	}
?>