<!DOCTYPE html>
<html lang="es">
	<!-- begin::Head -->
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>
			COLEGIO DIGITAL 360
		</title>
		<meta name="description" content="colegio digital 360">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta content="" name=""/>
		<meta content="" name="colegiodigital360"/>
		<!--begin::Web font -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700","Asap+Condensed:500"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>

        <!--end::Web font -->

        <!--begin::Base Styles -->
        <!--begin::Page Vendors -->
		<link href="assets/vendors/custom/fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <link href="assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors -->

		<!--begin::Page Vendors Styles -->
		<link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		
		<!--RTL version:<link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Page Vendors Styles -->

		<!--begin::Base Styles -->
		<link href="assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" /><!--RTL version:<link href="assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
		<link href="assets/base/style.bundle.css" rel="stylesheet" type="text/css" /><!--RTL version:<link href="assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Base Styles -->

		<!--end::Base Styles -->
		<link rel="shortcut icon" href="favicon.ico" />
	</head>

    <body  class="m--skin- m-page--loading-enabled m-page--loading m-content--skin-light m-header--fixed m-header--fixed-mobile m-aside-left--offcanvas-default m-aside-left--enabled m-aside-left--fixed m-aside-left--skin-dark m-aside--offcanvas-default"  >
	
	 <!-- begin::Page loader -->
	 <div class="m-page-loader m-page-loader--base">
        <div class="m-blockui">
            <span>Cargando...</span>
            <span><div class="m-loader m-loader--brand"></div></span>
        </div>
    </div>

    <!-- end::Page Loader -->

<?php
	$variable = isset($_SESSION['tutor']['grado']) ? $_SESSION['tutor']['grado'] : '';
    switch ($variable) {
        case 1 : case 2: case 3:
            define ('ETA', 1);
            define ('ETA_TABLA', 'tb_eta_calificacion1');
            define ('ETA_RESPUESTA', 'tb_eta_respuesta1');
            break;
        case 5 : case 4:
            define ('ETA', 2);
            define ('ETA_TABLA', 'tb_eta_calificacion2');
            define ('ETA_RESPUESTA', 'tb_eta_respuesta2');
            break;
        default:
            break;
    }
?>