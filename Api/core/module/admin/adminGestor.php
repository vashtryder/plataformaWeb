<?php
	include_once "../../ControladorBase.php";
	class GestorAdmin
    {
        public static function loginAdministradorAjax(){
            $data = array( $_REQUEST['userID'] , $_REQUEST['passID'] );
            $row_login = adminController::getAdministradorLogin($data);
            list($idModuloLogin, $idPersonal, $idModulo, $USER, $PASS, $activo ) = $row_login;
            if($idModuloLogin){
                if($activo != 0){
                    $r_m = moduloController::setModulo($idModulo);
                    $r_p = adminController::setAdministrador($idPersonal);
					$r_a = anioController::setAnioAcademico(date('Y'));
                    $_SESSION['login'][0]  = $idModuloLogin; #-- idLogin
                    $_SESSION['login'][1]  = $USER; #-- Usuario
                    $_SESSION['anio'][0]   = $r_a[0]; #-- idAnio
                    $_SESSION['anio'][1]   = $r_a[1]; #-- año academcio
                    $_SESSION['modulo'][0] = $r_m[0]; #-- idModulo
                    $_SESSION['modulo'][1] = $r_m[1]; #-- nonbre_modulo
                    $_SESSION['user'][0]   = $r_p[0]; #-- IdUsuario
                    $_SESSION["user"][1]   = $r_p[4] ; #DNIusuario
                    $_SESSION["user"][2]   = $r_p[1] ; #paterno
                    $_SESSION["user"][3]   = $r_p[2] ; #materno
                    $_SESSION["user"][4]   = $r_p[3] ; #nombres
                    $_SESSION['user'][5]   = $r_p[5] ; #sexo
                    $_SESSION['user'][6]   = $r_p[8] ; #email
                    $_SESSION['user'][7]   = $r_p[6] ; #celular
                    $_SESSION['user'][8]   = $r_p[6] ; #celular
					$_SESSION['user'][9]   = $r_p[9] ; #avatar
					print_r("administradorPerfil");
                } else {
                   print_r(1);
                }
            } else{
                print_r(2);
            }
        }
		
		public static function updateAdministradorAjax()
        {
            $data = array();

            array_push($data,$_REQUEST['paterno']);
            array_push($data,$_REQUEST['materno']);
            array_push($data,$_REQUEST['nombres']);
            array_push($data,$_REQUEST["celular1"]);
            array_push($data,$_REQUEST["celular2"]);
            array_push($data,$_REQUEST["correo"]);
            array_push($data,$_REQUEST["id"]);

            $_SESSION["user"][2] = $_REQUEST['paterno'];
            $_SESSION["user"][3] = $_REQUEST['materno'];
            $_SESSION["user"][4] = $_REQUEST['nombres'];
            $_SESSION['user'][6] = $_REQUEST["correo"];
            $_SESSION["user"][7] = $_REQUEST["celular1"];
            $_SESSION["user"][8] = $_REQUEST["celular2"];

            return adminController::getAdministradorUpdate($data);
        }

        public static function passwordAdministradorAjax()
        {
            $data = array();
            array_push($data,$_REQUEST["password"]);
            array_push($data,$_REQUEST["id"]);
            return adminController::getAdministradorPassword($data);
		}
		
        public static function avatarAdministradorAjax()
        {
            $data = array();
            array_push($data, $_FILES['foto']);
            array_push($data, $_POST['id']);
            return adminController::getAdministradorAvatar($data);
        }
	}
	if(isset($_REQUEST["token"])){
		GestorAdmin::loginAdministradorAjax();
    } else if(isset($_REQUEST['password_token'])){
        GestorAdmin::passwordAdministradorAjax();
    } else if(isset($_REQUEST["update_token"])){
        GestorAdmin::updateAdministradorAjax();
	} else if(isset($_REQUEST["avatar_token"])){
        GestorAdmin::avatarAdministradorAjax();
	}
?>