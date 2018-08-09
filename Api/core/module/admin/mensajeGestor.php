<?php 
	include_once "Api/core/ControladorBase.php";
	
	class GestorMensaje
    {
		public static function newMensajeAjax()
        {
            $row = mensajeController::getMensajeId();
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

                $r = mensajeController::getMensajeNew($data);
            }

            $enviarDatos = ($r !== false) ? array(1,GUARDADO ) : array(0,ERROR);
            // $enviarDatos = array(1,$r);
			print_r(json_encode($enviarDatos));
        }

        public static function estadoMensajeAjax()
        {
            $data = array();
            array_push($data,1);
            array_push($data,$_REQUEST['id']);
            mensajeController::getMensajeEstadoModel($data);
        }

        public static function deleteMensajeAjax()
        {
			mensajeController::getMensajeDelete($_REQUEST['id']);
        }
	}

	if(isset($_REQUEST['update_mensaje'])){
        GestorMensaje::estadoMensajeAjax();
    } else if(isset($_REQUEST['new_mensaje'])){
        GestorMensaje::newMensajeAjax();
    } else if(isset($_REQUEST['delete_mensaje'])){
        GestorMensaje::deleteMensajeAjax();
    }
?>