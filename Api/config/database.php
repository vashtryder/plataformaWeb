<?php 
	class Database
	{
		public function getDataConextion()
		{
			return array(
				"driver"    =>"mysql",
				"host"      =>"localhost",
				"user"      =>"root",
				"pass"      =>"root",
				"database"  =>"cd360",
				"charset"   =>"utf8"
			);
		}
	}
	
?>