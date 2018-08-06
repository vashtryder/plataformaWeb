<?php 
	require_once 'Conectar.php';
	require_once 'EntidadBase.php';

	$strFileController='controller/';
	$strFileModel='model/';
	
	//Incluir todos los modelos

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

	//Incluir todos los controladores
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