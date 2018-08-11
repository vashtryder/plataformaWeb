<?php 
	include_once "../../ControladorBase.php";
	class GestorEstudiante
	{
		public static function newEstudianteAjax()
        {
			$row1 = estudianteController::getEstudianteId();
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

			$r1   = estudianteController::getEstudianteNew($data);
			$row2 = fichaController::getFichaId();
			$row3 = fichaController::getFichaCodigoEta($_REQUEST['idcolegio']);

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

			$r2 = fichaController::getFichaNew($data1);
			$row3 = estudianteController::getEstudianteIdLogin();

            array_push($data2, $row3[0] + 1);
            array_push($data2, $_REQUEST['idcolegio']);
            array_push($data2, $idEstudiante);
            array_push($data2, $_REQUEST['dni']);
            array_push($data2, $_REQUEST['dni']);
            array_push($data2, 1);

			$r3 = estudianteController::getEstudianteLoginNew($data2);

            $enviarDatos = ($r1 !== false && $r2 !== false && $r3 !== false) ? array(1,'REGISTRO GUARDADO') : array(0,"OH, HUBO UN ERROR AL REGISTRAR.");
            // $enviarDatos = array(1,$r2);
            print_r(json_encode($enviarDatos));
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

			$r1 = estudianteController::getEstudianteUpdate($data);

            array_push($data1, $_REQUEST['idcolegio']);
            array_push($data1, $_REQUEST['grado']);
            array_push($data1, $_REQUEST['seccion']);
            array_push($data1, $_REQUEST['nivel']);
            array_push($data1, $_REQUEST['idficha']);

			$r2 = fichaController::getFichaUpdate($data1);

            $enviarDatos = ($r1 !== false && $r2 !== false) ? array(1,'REGISTRO ACTUALIZADO') : array(0,"OH, HUBO UN ERROR AL REGISTRAR.");
            // $enviarDatos = array(1,$r1);
            print_r(json_encode($enviarDatos));
        }

        public static function deleteEstudianteAjax()
        {
			return estudianteController::getEstudianteDelete($_REQUEST['id']);
		}
		
		public static function avatarEstudianteAjax()
        {
			list($ancho, $alto) = getimagesize($_FILES['avatar']["tmp_name"]);
            $anchoImage = 500;
            $altoImage = 500;

            if($ancho > $anchoImage || $alto > $altoImage){ #1600 X 600
                $enviarDatos  =  array(0,"LA IMAGEN ES SUPERIOR A 500 * 500 PIXELES");
            } else{
                $fileName = $_FILES['avatar']["name"];
                $exten    = explode('.', $fileName);
                $ext      = end($exten);
                $filename = date('YmdHis').'.'.$ext;
                $filepath = RUTA_IMG_ESTUDIANTE . $filename;

                if(file_exists($filepath)){
                    @unlink($filepath);
                    $submit = move_uploaded_file($_FILES['avatar']["tmp_name"], $filepath);
                } else {
                    $submit = move_uploaded_file($_FILES['avatar']["tmp_name"], $filepath);
                }

                $arrayData  = array();
                array_push($arrayData, $filename);
                array_push($arrayData, $_REQUEST["id"]);
                $r = estudianteController::getEstudianteAvatar($arrayData);
                $enviarDatos = ($r !== false) ? array(1,'La Fotografia fue cambiada.') : array(0,"OH, HUBO UN ERROR AL REGISTRAR.");
            }

            print_r(json_encode($enviarDatos));
        }

        public static function estadoEstudianteAjax()
        {
            $data = array($_REQUEST['estado'],$_REQUEST['id']);
			return fichaController::getFichaEstado($data);
		}
	}

	if(isset($_REQUEST['estado_estudiante'])){
        GestorEstudiante::estadoEstudianteAjax();
    } else if(isset($_REQUEST["avatar_estudiante"])){
        GestorEstudiante::avatarEstudianteAjax();
    } else if(isset($_REQUEST["new_estudiante"])){
        GestorEstudiante::newEstudianteAjax();
    } else if(isset($_REQUEST["update_estudiante"])){
        GestorEstudiante::updateEstudianteAjax();
    } else if(isset($_REQUEST["delete_estudiante"])){
        GestorEstudiante::deleteEstudianteAjax();
    }
?>