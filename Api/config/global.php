<?php
	$root_view   	= 'view/html/';
	$root_media  	= 'assets/media/img/';
	$root_plugins   = 'assets/plugins/';
	$root_report 	= 'Api/report/';
	$root_json   	= 'Api/json';

	$scanned_directory = array_diff(scandir($root_plugins), array('..', '.','*.php'));
    foreach ($scanned_directory as $key => $value) {
        $variable_global = 'ROOT_'.mb_strtoupper($value,'UTF-8');
		define($variable_global, $root_plugins.$value.'/' );
		// print_r($variable_global.'<br>');
	}

	$scanned_directory = array_diff(scandir($root_report), array('..', '.','*.php'));
    foreach ($scanned_directory as $key => $value) {
        $variable_global = 'ROOT_'.mb_strtoupper($value,'UTF-8');
		define($variable_global, $root_report.$value.'/' );
		// print_r($variable_global.'<br>');
	}

	$scanned_directory = array_diff(scandir($root_json), array('..', '.','*.php'));
    foreach ($scanned_directory as $key => $value) {
        $variable_global = 'ROOT_'.mb_strtoupper($value,'UTF-8');
		define($variable_global, $root_json.$value.'/' );
		// print_r($variable_global.'<br>');
	}

	$scanned_directory = array_diff(scandir($root_media), array('..', '.','*.php'));
    foreach ($scanned_directory as $key => $value) {
        $variable_global = 'ROOT_'.mb_strtoupper($value,'UTF-8');
		define($variable_global, $root_media.$value.'' );
		// print_r($root_report.$value.'/'.'<br>');
	}

    $scanned_directory = array_diff(scandir($root_view), array('..', '.','*.php'));
    foreach ($scanned_directory as $key => $value) {
        $variable_global = 'ROOT_HTML_'.mb_strtoupper($value,'UTF-8');
		define($variable_global, $root_view.$value.'/' );
		// print_r($variable_global.'<br>');
	}

	$root_padre  	=  realpath(dirname('global.php'));
	$root_img	  	= 'assets'. DIRECTORY_SEPARATOR .'media'. DIRECTORY_SEPARATOR .'img'. DIRECTORY_SEPARATOR;

	$scanned_directory = array_diff(scandir($root_img), array('..', '.','*.php'));
    foreach ($scanned_directory as $key => $value) {
        $variable_global = 'ROOT_MEDIA_'.mb_strtoupper($value,'UTF-8');
		define($variable_global, $root_padre . DIRECTORY_SEPARATOR . $root_img . $value . DIRECTORY_SEPARATOR);
		// print_r($variable_global.'<br>');
	}
?>
