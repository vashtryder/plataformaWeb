<?php
	session_start();
	require_once 'Conectar.php';
	require_once 'EntidadBase.php';
	require_once 'EntidadBaseEta.php';

	$root_dir 		= $_SERVER["DOCUMENT_ROOT"]."/plataformaWeb/";

	$strFileRoot    = glob( $root_dir . '*' );

	$strFileController 	=  	$strFileRoot[2] . '/';
	$strFileModel      	=  	$strFileRoot[4] . '/';
	$strFilemedia  		=	$strFileRoot[1].'/media/';

	$array_baseController = $array_baseModel = array();
	$scanned_directory = array_diff(scandir($strFileModel), array('..', '.'));
	foreach ($scanned_directory as $key => $value) {
		$array_baseController[] =  $strFileModel.$value;
	}

	foreach ($array_baseController as $value) {
		foreach(glob($value.'/*.php') as $filename){
			require_once $filename;
		}
	}

	$scanned_directory = array_diff(scandir($strFileController), array('..', '.'));
	foreach ($scanned_directory as $key => $value) {
		$array_baseModel[] =  $strFileController.$value;
	}

	foreach ($array_baseModel as $value) {
		foreach(glob($value.'/*.php') as $filename){
			require_once $filename;
		}
	}

	define("GUARDADO", "El registro se guardo correctamente.");
	define("ACTUALIZADO", "El registro se actualizo correctamente.");
	define("ELIMINADO", "El registro fue eliminado correctamente.");
	define("ERROR", "Disculpe, existió un problema.");

	$dires=array();
	$midir=opendir($strFilemedia);
	$i=$k=0;
	while($archivo=readdir($midir))
	{
	   	if (is_dir($strFilemedia.$archivo) && $archivo!="." && $archivo!=".."){
			$dirs = glob($strFilemedia.$archivo."/*", GLOB_ONLYDIR);
			foreach ($dirs as $key => $value) {
				$variable_global = mb_strtoupper($archivo.'_'.basename($value),'UTF-8');
				$subRootFile = str_replace($root_dir, '', $value);
				define('RUTA_'.$variable_global, $value . '/' );
				define('FILE_'.$variable_global, $subRootFile . '/' );
			}
		}
	}
?>