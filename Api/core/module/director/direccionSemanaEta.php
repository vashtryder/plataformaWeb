<?php require_once '../../../conf.ini.php'; ?>
<?php $semana = $_REQUEST['semana']; ?>
<?php $unidad = $_REQUEST['unidad']; ?>
<?php $data  = array($_REQUEST['grado'],$_REQUEST['seccion'],$_REQUEST['nivel'],$_SESSION['colegio'][0],$_SESSION['anio'][0]); ?>
<?php $rs_e  = gestorEstudiante::get_estudiante_reporte($data);?>
<?php $row_s = gestorSemana::set_semana($semana) ?>
<?php $row_z = gestorSemana::set_semana($semana+1) ?>
<?php $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0])); ?>
<?php
    switch ($_REQUEST['grado']) {
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
<table class="table m-regSemana registroVirtual">
    <thead>
        <tr>
            <th>#</th>
            <th>APELLIDOS Y NOMBRES</th>
            <th>FOTO</th>
            <th class="text-center">ETA <?php sistema::imprimir($row_s[0]) ?></center></th>
            <th class="text-center">META ETA <?php sistema::imprimir($row_s[0]) ?></center></th>
            <th class="text-center">ETA <?php sistema::imprimir($row_z[0]) ?></center></th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($rs_e as $row_e){ ?>
            <?php $s=0 ?>
            <?php $suma_eta = 0 ?>

            <?php $rows1 = gestorEstudiante::set_estudiante($row_e[3]) ?>
            <?php $rows2 = gestorFicha::set_fichaEstudiante($row_e[3]) ?>
            <?php $v_nota = $v_meta = array() ?>
            <?php $data1 = array($rows2[7],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_s[0]); ?>
            <?php $data2 = array($rows2[7],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_z[0]); ?>
            <?php $data3 = array($rows1[0],$_SESSION['colegio'][0],$_SESSION['anio'][0],$row_s[0]); ?>

            <?php $rows3 = gestorRegistroEta::get_eta_calificacion_semana($data1,ETA_TABLA); ?>

            <?php $rows4 = gestorRegistroEta::get_eta_calificacion_semana($data2,ETA_TABLA); ?>
            <?php $rows5 = gestorMeta::set_meta_semana($data3); ?>

            <?php $valor_nota1 = empty($rows3[57]) ? 'NSP' : $rows3[57]; $s++; ?>
            <?php $valor_nota2 = empty($rows4[57]) ? 0 : $rows4[57]; ?>
            <?php $valor_meta = empty($rows5[5]) ? 0 : $rows5[5]; ?>

            <?php $v_nota1[$row_s[0]] = $valor_nota1; ?>
            <?php $v_nota2[$row_z[0]] = $valor_nota2; ?>
            <?php $v_meta[$row_s[0]]  = $valor_meta; ?>

            <?php $index1 = ($v_meta[$row_s[0]] < $v_nota2[$row_z[0]+1] ) ? $row_e[3] : 0; ?>

            <?php $class[$index1][$row_z[0]] = 'm-badge--warning'?>
            <?php $suma_eta += $v_nota1[$row_s[0]] ?>

            <tr>
                <td><?php sistema::imprimir($rows2[7]) ?></td>
                <td>
                    <span class="m-menu__item">
                        <a href="#" onclick="js_estudiante.modalEstudianteSubmit(<?php sistema::imprimir($row_e[3]) ?>)">
                            <span class="m-menu__link-text"><?php sistema::imprimir($rows1[3]." ".$rows1[4]." ".$rows1[5]) ?></span>
                        </a>
                    </span>
                </td>
                <td>
                    <div class="m-card-user m-card-user--sm">
                        <div class="m-card-user__pic">
                            <img src="view/img/estudiante/<?php sistema::imprimir($rows1[14]) ?>" class="m--img-rounded m--marginless" alt="photo">
                        </div>
                    </div>
                </td>
                <td>
                    <center>
                        <span class="m-badge <?php sistema::imprimir($class[$row_e[3]][$row_z[0]]) ?> m-badge--wide">
                            <?php sistema::imprimir($v_nota1[$row_s[0]]) ?>
                        </span>
                    </center>
                </td>
                <td>
                    <center>
                        <input type="text" name="meta[<?php sistema::imprimir($row_e[3]) ?>][<?php sistema::imprimir($row_s[0]) ?>]" value="<?php sistema::imprimir($v_meta[$row_s[0]]) ?>" class="form-control registroCelda m--font-success" style="width: 45px">
                    </center>
                </td>
                <td>
                    <center>
                        <span class="m-badge <?php sistema::imprimir($class[$row_e[3]][$row_z[0]]) ?> m-badge--wide">
                            <?php sistema::imprimir($v_nota2[$row_z[0]]) ?>
                        </span>
                    </center>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
