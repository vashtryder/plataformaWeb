<?php
	session_start();
	require_once 'Conectar.php';
	require_once 'EntidadBase.php';

	$strFileRoot = glob($_SERVER["DOCUMENT_ROOT"]."/plataformaWeb/*");
	
	$strFileController 	=  	$strFileRoot[2] . '/';
	$strFileModel      	=  	$strFileRoot[4] . '/';

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
?>