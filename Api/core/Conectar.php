<?php

	$strFileRoot = glob($_SERVER["DOCUMENT_ROOT"]."/plataformaWeb/*");
	require_once $strFileRoot[0] ."/config/database.php";
	
    class MySQL{
        public static function connectDB(){
			$db_cfg = Database::getDataConextion();
			$driver		= $db_cfg["driver"];
			$host		= $db_cfg["host"];
			$user		= $db_cfg["user"];
			$pass     	= $db_cfg["pass"];
			$database 	= $db_cfg["database"];
			$charset  	= $db_cfg["charset"];
			$con=new mysqli($host,$user,$pass,$database);
			if (!$con->set_charset($charset)){
				printf("<div class='alert alert-danger alert-dismissible' role='alert'>Error cargando el conjunto de caracteres utf8: %s </div>\n", $con->error);
				exit();
			}
            return $con;
        }

        public static function connectETA(){
			$db_cfg = Database::getDataConextionETA();
			$driver		= $db_cfg["driver"];
			$host		= $db_cfg["host"];
			$user		= $db_cfg["user"];
			$pass     	= $db_cfg["pass"];
			$database 	= $db_cfg["database"];
			$charset  	= $db_cfg["charset"];
			$con=new mysqli($host,$user,$pass,$database);
			if (!$con->set_charset($charset)){
				printf("<div class='alert alert-danger alert-dismissible' role='alert'>Error cargando el conjunto de caracteres utf8: %s </div>\n", $con->error);
				exit();
			}
            return $con;
        }
    }
?>
