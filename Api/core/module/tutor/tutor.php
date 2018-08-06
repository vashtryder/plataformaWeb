<?php
    include '../../../conf.ini.php';

    class GestorTutorModel
    {
        public static function newMetaAjax()
        {

            $u = $_REQUEST['semana'];
            $m = $_REQUEST['meta'];

            $c = $_SESSION['colegio'][0];
            $a = $_SESSION['anio'][0];
            $g = $_SESSION['tutor']['grado'];
            $s = $_SESSION['tutor']['seccion'];
            $n = $_SESSION['tutor']['nivel'];

            $data = array($g,$s,$n,$c,$a);
            $rs_e = gestorEstudiante::get_estudiante_reporte($data);
            $row_s = gestorSemana::set_semana($u);

            foreach ($rs_e as $row_e){

                $e = $row_e[3];
                $w = $row_s[0];

                $meta_value = empty($m[$e][$w]) ? 0 : $m[$e][$w];

                $rows4 = gestorMeta::set_meta_semana(array($e,$c,$a,$w));

                $data_value = array($c,$a,$w,$e,$meta_value);

                if(empty($rows4)){
                    $rs = gestorMeta::new_meta($data_value);
                } else {
                    array_push($data_value,$rows4[0]);
                    $rs = gestorMeta::update_meta($data_value);
                }

            }

            $enviarDatos = ($rs !== false) ? array(1,'REGISTRO GUARDADO') : array(0,"OH, HUBO UN ERROR AL REGISTRAR.");
            // $enviarDatos = array(1,$r);
            sistema::imprimir(json_encode($enviarDatos));
        }
    }

    if(isset($_POST["new_meta"])){
        GestorTutorModel::newMetaAjax();
    }

?>