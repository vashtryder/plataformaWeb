<?php 
	include_once "Api/core/ControladorBase.php";
	
	class mensajeGestor
    {
		public static function newMensajeAjax()
        {
            $row = gestorMensaje::get_id_mensaje();
            $id = empty($row[0]) ? 0 : $row[0];

            foreach ($_REQUEST['para'] as $key => $value) {
                $data = array();
                $id++;
                array_push($data,$id);
                array_push($data,$_SESSION['colegio'][0]);
                array_push($data,$_SESSION['modulo'][0]);
                array_push($data,$value);
                array_push($data,$_REQUEST['de']);
                array_push($data,0);
                array_push($data,date('Y-m-d'));
                array_push($data,date('H:i:s'));
                array_push($data,$_REQUEST['asunto']);
                array_push($data,$_REQUEST['texto']);

                $r = gestorMensaje::new_mensaje($data);
            }


            $enviarDatos = ($r !== false) ? array(1,'MENSAJE ENVIADO') : array(0,"OH, HUBO UN ERROR AL ENVIAR.");
            // $enviarDatos = array(1,$r);
            sistema::imprimir(json_encode($enviarDatos));
        }

        public static function estadoMensajeAjax()
        {
            $data = array();
            array_push($data,1);
            array_push($data,$_REQUEST['id']);
            gestorMensaje::get_update_estado($data);
        }

        public static function deleteMensajeAjax()
        {
            return gestorMensaje::delete_mensaje($_REQUEST['id']);
        }
	}

	if(isset($_REQUEST['update_mensaje'])){
        GestorUsuarioModel::estadoMensajeAjax();
    } else if(isset($_REQUEST['new_mensaje'])){
        GestorUsuarioModel::newMensajeAjax();
    } else if(isset($_REQUEST['delete_mensaje'])){
        GestorUsuarioModel::deleteMensajeAjax();
    }
?>