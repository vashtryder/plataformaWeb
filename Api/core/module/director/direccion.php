<?php
    include '../../../conf.ini.php';

    class GestorUsuarioModel
    {

        public static function loginDireccionAjax(){

            $data = array( $_REQUEST['userID'] , $_REQUEST['passID'] );

            $row_login = gestorUsuario::get_director_login($data);

            list($idModuloLogin, $idPersonal, $idModulo, $USER, $PASS, $activo ) = $row_login;

            if($idModuloLogin){

                if($activo != 0){

                    $r_m = gestorModulo::set_modulo($idModulo);
                    $r_p = gestorPersonal::set_personal($idPersonal);
                    $r_c = gestorColegio::set_colegio($r_p[1]);
                    $r_a = gestorAnio::set_anioAcademico(date('Y'));

                    $rs_i = gestorSemana::get_eta_semana_fecha(date('Y-m-d'));

                    if($idModulo == 3){
                        $r_t = gestorTutor::get_tutor_personal($idPersonal);

                        $r_g = gestorGrado::set_grado($r_t[4]);
                        $r_s = gestorSeccion::set_seccion($r_t[5]);
                        $r_n = gestorNivel::set_nivel($r_t[6]);

                        $_SESSION['tutor']['grado'] = $r_g[0];
                        $_SESSION['tutor']['seccion'] = $r_s[0];
                        $_SESSION['tutor']['nivel'] = $r_n[0];

                        $_SESSION['tutor']['aula'] = $r_g[1]." ".$r_s[1]." ".$r_n[1];
                    }


                    $_SESSION['login'][0]   = $idModuloLogin; #-- idLogin
                    $_SESSION['login'][1]   = $USER; #-- Usuario

                    $_SESSION['modulo'][0]  = $r_m[0]; #-- idModulo
                    $_SESSION['modulo'][1]  = $r_m[1]; #-- nonbre_modulo

                    $_SESSION['anio'][0]    = $r_a[0]; #-- idAnio
                    $_SESSION['anio'][1]    = $r_a[1]; #-- año academcio

                    $_SESSION['colegio'][0] = $r_c[0]; #-- idCOLEGIO
                    $_SESSION['colegio'][1] = $r_c[1]; #-- idNombreColegio

                    $_SESSION['user'][0]    = $r_p[0]; #-- IdUsuario
                    $_SESSION["user"][1]    = $r_p[6] ; #DNIusuario
                    $_SESSION["user"][2]    = $r_p[3] ; #paterno
                    $_SESSION["user"][3]    = $r_p[4] ; #materno
                    $_SESSION["user"][4]    = $r_p[5] ; #nombres
                    $_SESSION['user'][5]    = $r_p[7] ; #sexo
                    $_SESSION['user'][6]    = $r_p[8] ; #email
                    $_SESSION['user'][7]    = $r_p[10] ; #celular
                    $_SESSION['user'][8]    = $r_p[11] ; #celular
                    $_SESSION['user'][9]    = $r_p[13] ; #avatar

                    $_SESSION['semana'][0]  = $rs_i[0] ; #idsemana
                    $_SESSION['semana'][1]  = $rs_i[1] ; #idperido

                    switch ($idModulo)
                    {
                        case 2:
                            sistema::imprimir("direccionPerfil");
                        break;
                        case 3:
                            sistema::imprimir("tutorPerfil");
                        break;
                    }

                } else {
                   sistema::imprimir(1);
                }

            } else{
                sistema::imprimir(2);
            }

        }

        public static function newEstudianteAjax()
        {

            $row1 = gestorEstudiante::get_id_estudiante();
            $data = $data1 = $data2 = array();
            $idEstudiante = $row1[0] + 1;
            array_push($data, $idEstudiante);
            array_push($data, $_REQUEST['idcolegio']);
            array_push($data, $_REQUEST['idanio']);
            array_push($data, $_REQUEST['paterno']);
            array_push($data, $_REQUEST['materno']);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['dni']);
            array_push($data, $_REQUEST['sexo']);
            array_push($data, $_REQUEST['edad']);
            array_push($data, $_REQUEST['fecnac']);
            array_push($data, $_REQUEST['direccion']);
            array_push($data, $_REQUEST['telefono1']);
            array_push($data, $_REQUEST['telefono2']);
            array_push($data, $_REQUEST['correo']);
            array_push($data, '');

            $r1 = gestorEstudiante::new_estudiante($data);

            $row2 = gestorFicha::get_id_ficha();
            $row3 = gestorFicha::get_codigoEta($_REQUEST['idcolegio']);

            $idFicha = $row2[0] + 1;
            $codigoEta = 1000 + $idFicha;

            array_push($data1, $row2[0] + 1);
            array_push($data1, $_REQUEST['idcolegio']);
            array_push($data1, $_REQUEST['idanio']);
            array_push($data1, $idEstudiante);
            array_push($data1, $_REQUEST['grado']);
            array_push($data1, $_REQUEST['seccion']);
            array_push($data1, $_REQUEST['nivel']);
            array_push($data1, $codigoEta);
            array_push($data1, 1);
            array_push($data1, date('Y-m-d'));
            array_push($data1, date('H:i:s'));

            $r2 = gestorFicha::new_ficha($data1);

            $row3 = gestorUsuario::get_id_padre_login();

            array_push($data2, $row3[0] + 1);
            array_push($data2, $_REQUEST['idcolegio']);
            array_push($data2, $idEstudiante);
            array_push($data2, $_REQUEST['dni']);
            array_push($data2, $_REQUEST['dni']);
            array_push($data2, 1);

            $r3 = gestorUsuario::new_login_padre($data2);

            $enviarDatos = ($r1 !== false && $r2 !== false && $r3 !== false) ? array(1,'REGISTRO GUARDADO') : array(0,"OH, HUBO UN ERROR AL REGISTRAR.");
            // $enviarDatos = array(1,$r2);
            sistema::imprimir(json_encode($enviarDatos));
        }

        public static function updateEstudianteAjax()
        {
            $data = $data1 = array();
            array_push($data, $_REQUEST['idcolegio']);
            array_push($data, $_REQUEST['paterno']);
            array_push($data, $_REQUEST['materno']);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['dni']);
            array_push($data, $_REQUEST['sexo']);
            array_push($data, $_REQUEST['edad']);
            array_push($data, $_REQUEST['fecnac']);
            array_push($data, $_REQUEST['direccion']);
            array_push($data, $_REQUEST['telefono1']);
            array_push($data, $_REQUEST['telefono2']);
            array_push($data, $_REQUEST['correo']);
            array_push($data, $_REQUEST['id']);

            $r1 = gestorEstudiante::update_estudiante($data);

            array_push($data1, $_REQUEST['idcolegio']);
            array_push($data1, $_REQUEST['grado']);
            array_push($data1, $_REQUEST['seccion']);
            array_push($data1, $_REQUEST['nivel']);
            array_push($data1, $_REQUEST['idficha']);

            $r2 = gestorFicha::update_ficha($data1);

            $enviarDatos = ($r1 !== false && $r2 !== false) ? array(1,'REGISTRO ACTUALIZADO') : array(0,"OH, HUBO UN ERROR AL REGISTRAR.");
            // $enviarDatos = array(1,$r1);
            sistema::imprimir(json_encode($enviarDatos));
        }

        public static function deleteEstudianteAjax()
        {
            return gestorEstudiante::delete_estudiante($_REQUEST['id']);
        }

        public static function avatarEstudianteAjax()
        {
            $data = array($_FILES['avatar'],$_REQUEST['id']);
            return gestorEstudiante::update_avatar($data);
        }

        public static function estadoEstudianteAjax()
        {
            $data = array($_REQUEST['estado'],$_REQUEST['id']);
            return gestorFicha::update_estado($data);
        }

        public static function newPersonalAjax()
        {
            $rows = gestorPersonal::get_id_personal();
            $data = array();
            $idPersonal = $rows[0]+1;
            array_push($data, $idPersonal );
            array_push($data, $_REQUEST['idcolegio']);
            array_push($data, $_REQUEST['idanio']);
            array_push($data, $_REQUEST['paterno']);
            array_push($data, $_REQUEST['materno']);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['dni']);
            array_push($data, $_REQUEST['sexo']);
            array_push($data, $_REQUEST['correo']);
            array_push($data, $_REQUEST['direccion']);
            array_push($data, $_REQUEST['telefono1']);
            array_push($data, $_REQUEST['telefono2']);
            array_push($data, $_REQUEST['fecnac']);
            array_push($data, '');

            $r1 = gestorPersonal::new_personal($data);

            $row1 = gestorUsuario::get_id_personal_login();
            $data1 = array();
            array_push($data1, $row1[0]+1);
            array_push($data1, $idPersonal);
            array_push($data1, $_REQUEST['idmodulo']);
            array_push($data1, $_REQUEST['dni']);
            array_push($data1, $_REQUEST['dni']);
            array_push($data1, 1);

            $r2 = gestorUsuario::new_login_personal($data1);

            $enviarDatos = ($r1 !== false && $r2 !== false) ? array(1,'REGISTRO ACTUALIZADO') : array(0,"OH, HUBO UN ERROR AL REGISTRAR.");
            // $enviarDatos = array(1,$r2);
            sistema::imprimir(json_encode($enviarDatos));
        }

        public static function updatePersonalAjax()
        {
            $data = $data1 = array();
            array_push($data, $_REQUEST['idcolegio']);
            array_push($data, $_REQUEST['paterno']);
            array_push($data, $_REQUEST['materno']);
            array_push($data, $_REQUEST['nombre']);
            array_push($data, $_REQUEST['dni']);
            array_push($data, $_REQUEST['sexo']);
            array_push($data, $_REQUEST['correo']);
            array_push($data, $_REQUEST['direccion']);
            array_push($data, $_REQUEST['telefono1']);
            array_push($data, $_REQUEST['telefono2']);
            array_push($data, $_REQUEST['fecnac']);
            array_push($data, $_REQUEST['id']);
            $r1 =  gestorPersonal::update_personal($data);

            array_push($data1, $_REQUEST['idmodulo']);
            array_push($data1, $_REQUEST['idlogin']);

            $r2 = gestorUsuario::update_login_personal($data1);

            $enviarDatos = ($r1 !== false && $r2 !== false) ? array(1,'REGISTRO ACTUALIZADO') : array(0,"OH, HUBO UN ERROR AL REGISTRAR.");
            // $enviarDatos = array(1,$r1);
            sistema::imprimir(json_encode($enviarDatos));
        }

        public static function deletePersonalAjax()
        {
            return gestorPersonal::delete_personal($_REQUEST['id']);
        }

        public static function newTutorAjax()
        {
            $row = gestorTutor::get_id_tutor();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['colegio']);
            array_push($data, $_REQUEST['idanio']);
            array_push($data, $_REQUEST['docente']);
            array_push($data, $_REQUEST['grado']);
            array_push($data, $_REQUEST['seccion']);
            array_push($data, $_REQUEST['nivel']);
            return gestorTutor::new_tutor($data);
        }

        public static function updateTutorAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['colegio']);
            array_push($data, $_REQUEST['docente']);
            array_push($data, $_REQUEST['grado']);
            array_push($data, $_REQUEST['seccion']);
            array_push($data, $_REQUEST['nivel']);
            array_push($data, $_REQUEST['id']);
            return gestorTutor::update_tutor($data);
        }

        public static function deleteTutorAjax()
        {
            return gestorTutor::delete_tutor($_REQUEST['id']);
        }

        public static function updateDocenteAjax()
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

            return gestorPersonal::update_direccion($data);
        }

        public static function passwordDocenteAjax()
        {
            $data = array();
            array_push($data,$_REQUEST["password"]);
            array_push($data,$_REQUEST["id"]);
            return gestorPersonal::password_direccion($data);
        }

        public static function avatarDocenteAjax()
        {
            $data = array();
            array_push($data, $_FILES['foto']);
            array_push($data, $_POST['id']);
            return gestorPersonal::avatar_direccion($data);
        }

        public static function newHorarioAjax()
        {
            $row = gestorHorario::get_id_horario();
            $data = array();
            array_push($data, $row[0] + 1);
            array_push($data, $_REQUEST['colegio']);
            array_push($data, $_REQUEST['docente']);
            array_push($data, $_REQUEST['idanio']);
            array_push($data, $_REQUEST['curso']);
            array_push($data, $_REQUEST['grado']);
            array_push($data, $_REQUEST['seccion']);
            array_push($data, $_REQUEST['nivel']);
            return gestorHorario::new_Horario($data);
        }

        public static function updateHorarioAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['colegio']);
            array_push($data, $_REQUEST['docente']);
            array_push($data, $_REQUEST['curso']);
            array_push($data, $_REQUEST['grado']);
            array_push($data, $_REQUEST['seccion']);
            array_push($data, $_REQUEST['nivel']);
            array_push($data, $_REQUEST['id']);
            return gestorHorario::update_horario($data);
        }

        public static function deleteHorarioAjax()
        {
            return gestorHorario::delete_horario($_REQUEST['id']);
        }
    }

    if(isset($_REQUEST['new_horario'])){
        GestorUsuarioModel::newHorarioAjax();
    }

    if(isset($_REQUEST['update_horario'])){
        GestorUsuarioModel::updateHorarioAjax();
    }

    if(isset($_REQUEST['delete_horario'])){
        GestorUsuarioModel::deleteHorarioAjax();
    }

    if(isset($_REQUEST['new_tutor'])){
        GestorUsuarioModel::newTutorAjax();
    }

    if(isset($_REQUEST['update_tutor'])){
        GestorUsuarioModel::updateTutorAjax();
    }

    if(isset($_REQUEST['delete_tutor'])){
        GestorUsuarioModel::deleteTutorAjax();
    }

    if(isset($_REQUEST['new_personal'])){
        GestorUsuarioModel::newPersonalAjax();
    }

    if(isset($_REQUEST['update_personal'])){
        GestorUsuarioModel::updatePersonalAjax();
    }

    if(isset($_REQUEST['delete_personal'])){
        GestorUsuarioModel::deletePersonalAjax();
    }

    if(isset($_REQUEST['estado_estudiante'])){
        GestorUsuarioModel::estadoEstudianteAjax();
    }

    if(isset($_REQUEST["avatar_estudiante"])){
        GestorUsuarioModel::avatarEstudianteAjax();
    }

    if(isset($_REQUEST["new_estudiante"])){
        GestorUsuarioModel::newEstudianteAjax();
    }

    if(isset($_REQUEST["update_estudiante"])){
        GestorUsuarioModel::updateEstudianteAjax();
    }

    if(isset($_REQUEST["delete_estudiante"])){
        GestorUsuarioModel::deleteEstudianteAjax();
    }

    if(isset($_REQUEST["token"])){
        GestorUsuarioModel::loginDireccionAjax();
    }

    if(isset($_REQUEST['password_token'])){
        GestorUsuarioModel::passwordDocenteAjax();
    }

    if(isset($_REQUEST["update_token"])){
        GestorUsuarioModel::updateDocenteAjax();
    }

    if(isset($_REQUEST["avatar_token"])){
        GestorUsuarioModel::avatarDocenteAjax();
    }
?>