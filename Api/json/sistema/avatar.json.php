<?php
	include_once "../../config/global.php";
	include_once "../../core/ControladorBase.php";
    $Avatar = ROOT_IMG_PERSONAL . $_SESSION['user'][9];
    $arrayName = array("Avatar" => $Avatar);
    print_r(json_encode($arrayName))
?>