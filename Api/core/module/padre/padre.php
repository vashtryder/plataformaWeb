<?php
    include '../../../conf.ini.php';

    class GestorUsuarioModel
    {
        public static function loginPadreAjax(){
            $data = array( $_POST['user'] , $_POST['pass'] );
            $row_login = gestorUsuario::padre_login($data);
        }

        public static function updateLoginPadreAjax()
        {
            $data = array();
            array_push($data, $_REQUEST['estado']);
            array_push($data, $_REQUEST['id']);
            return gestorUsuario::update_estado_padre($data);
        }
    }

    if(isset($_REQUEST["estado_padre"])){
        GestorUsuarioModel::updateLoginPadreAjax();
    }

    if(isset($_POST["token"])){
        GestorUsuarioModel::loginPadreAjax();
    }
?>