<?php 
	class Database
	{
		public static function getDataConextion()
		{
			return array(
				"driver"    => "mysql",
				"host"      => "localhost",
				"user"      => "root",
				"pass"      => "root",
				"database"  => "cd360",
				"charset"   => "utf8"
			);
		}

		public static function getDataConextionETA()
		{
			return array(
				"driver"    => "mysql",
				"host"      => "localhost",
				"user"      => "root",
				"pass"      => "root",
				"database"  => "calificaciones",
				"charset"   => "utf8"
			);
		}
	}
?>