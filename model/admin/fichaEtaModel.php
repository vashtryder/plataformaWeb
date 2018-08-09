<?php
	class fichaEtaModel extends EntidadBaseEta
	{
		private static $table = 'tb_colegio_ficha';

		public function __construct() {
			self::$table;
		}

		public static function getFichaEtaTablaModel()
        {
           $sql = "show tables where Tables_in_calificaciones NOT LIKE '%tb_eta_backup%'";
           return EntidadBaseEta::consultaArray($sql);
        }

        public static function getFichaEtaFichaModel($data)
        {
            $sql = "SELECT DISTINCT * FROM `".EntidadBaseEta::real_escape_string($data)."`";
            return EntidadBaseEta::consultaArray($sql);
        }

        public static function getFichaEtaGradoModel($data)
        {
            $sql = "SELECT DISTINCT Grado FROM `".EntidadBaseEta::real_escape_string($data)."` ORDER BY Grado";
            return EntidadBaseEta::consultaForech($sql);
        }

        public static function getFichaEtaSeccionModel($data)
        {
            $sql = "SELECT DISTINCT Seccion FROM `".EntidadBaseEta::real_escape_string($data)."` ORDER BY Seccion";
            return EntidadBaseEta::consultaArray($sql);
        }

        public static function getFichaEtaNivelModel($data)
        {
            $sql = "SELECT DISTINCT Nivel FROM `".EntidadBaseEta::real_escape_string($data)."` ORDER BY Nivel";
            return EntidadBaseEta::consultaForech($sql);
        }

        public static function getFichaEtaCantidadModel($data)
        {
            $sql = "SELECT DISTINCT count(Seccion) FROM `".EntidadBaseEta::real_escape_string($data[0])."`
            WHERE
                Seccion = '".EntidadBaseEta::real_escape_string($data[1])."'
            ORDER BY Seccion";
            return EntidadBaseEta::consultaForech($sql);
        }

	}
?>