<?php
	$root_dir = $_SERVER["DOCUMENT_ROOT"]."/plataformaWeb/";
	$strFileRoot = glob( $root_dir . '*' );
	
	$root_media  	= $strFileRoot[1].'/media/';
	$root_plugins   = $strFileRoot[1].'/plugins/';
	$root_report 	= $strFileRoot[1].'/reports/';
	$root_view   	= $strFileRoot[5].'/';

	$dires=array();
	$midir=opendir($root_media);
	$i=$k=0;
	while($archivo=readdir($midir))
	{
	   	if (is_dir($root_media.$archivo) && $archivo!="." && $archivo!=".."){
			$dirs = glob($root_media.$archivo."/*", GLOB_ONLYDIR);
			
			foreach ($dirs as $key => $value) {
				$variable_global = mb_strtoupper('ROOT_' .$archivo.'_'.basename($value),'UTF-8');
				$subRootFile = str_replace( $root_dir , '', $value);
				define($variable_global, $subRootFile . '/' );
			}
		}
	}

	$dires=array();
	$midir=opendir($root_plugins);
	$i=$k=0;
	while($archivo=readdir($midir))
	{
	   	if (is_dir($root_plugins.$archivo) && $archivo!="." && $archivo!=".."){
			$variable_global = mb_strtoupper('ROOT_' .basename($archivo),'UTF-8');
			define($variable_global, $root_plugins.$archivo . '/');
		}
	}

	$dires=array();
	$midir=opendir($root_report);
	$i=$k=0;
	while($archivo=readdir($midir))
	{
	   	if (is_dir($root_report.$archivo) && $archivo!="." && $archivo!=".."){
			$variable_global = mb_strtoupper('ROOT_' .basename($archivo),'UTF-8');
			define($variable_global, $root_report.$archivo . '/');
		}
	}

	$dires=array();
	$midir=opendir($root_view);
	$i=$k=0;
	while($archivo=readdir($midir))
	{
	   	if (is_dir($root_view.$archivo) && $archivo!="." && $archivo!=".."){
			$dirs = glob($root_view.$archivo."/*", GLOB_ONLYDIR);
			foreach ($dirs as $key => $value) {
				$variable_global = mb_strtoupper('ROOT_' .$archivo.'_'.basename($value),'UTF-8');
				$subRootFile = str_replace($root_dir, '', $value);
				define($variable_global, $subRootFile.'/' );
			}
		}
	}
	closedir($midir);
?>