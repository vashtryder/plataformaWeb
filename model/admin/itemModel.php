<?php
	class itemModel extends EntidadBase
	{
		private static $table = 'tb_administrador_item';

		public function __construct() {
			self::$table;
		}

		public static function getItemModel()
        {
            $sql = "SELECT * FROM " . self::$table;
            return EntidadBase::consultaArray($sql);
        }

        public static function setItemProcesoModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_PROCESO = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaArray($sql);
        }

        public static function setItemModel($data)
        {
            $sql = "SELECT * FROM " . self::$table . " WHERE ID_ITEM = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consultaForech($sql);
        }

        public static function getItemIdModel()
        {
            $sql = "SELECT MAX(ID_ITEM) FROM " . self::$table . "";
            return EntidadBase::consultaForech($sql);
        }

        public static function getItemNewModel($data)
        {
            $sql = "INSERT INTO " . self::$table . "(ID_ITEM, ID_PROCESO, ITEMTITULO, ITEMCONCEPTO, ITEMORDEN)
            VALUES (
            '".EntidadBase::real_escape_string($data[0])."',
            '".EntidadBase::real_escape_string($data[1])."',
            '".EntidadBase::real_escape_string($data[2])."',
            '".EntidadBase::real_escape_string($data[3])."',
            '".EntidadBase::real_escape_string($data[4])."')";
            return EntidadBase::consulta($sql);
        }

        public static function getItemUpdateModel($data)
        {
            $sql          = "UPDATE " . self::$table . " SET
            ID_PROCESO    = '".EntidadBase::real_escape_string($data[0])."',
            ITEMTITULO    = '".EntidadBase::real_escape_string($data[1])."',
            ITEMCONCEPTO  = '".EntidadBase::real_escape_string($data[2])."',
            ITEMORDEN     = '".EntidadBase::real_escape_string($data[3])."'
            WHERE ID_ITEM = '".EntidadBase::real_escape_string($data[4])."'";
            return EntidadBase::consulta($sql);
        }

        public static function getItemDeleteModel($data)
        {
            $sql = "DELETE FROM tb_administrador_item WHERE ID_ITEM = '".EntidadBase::real_escape_string($data)."'";
            return EntidadBase::consulta($sql);
        }
    }
?>