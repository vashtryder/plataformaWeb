
<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-content">
            <!--Begin::Section-->
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/Quick Stats-->

                    <?php $unidad = empty($_REQUEST['u']) ? $_SESSION['semana'][1] : $_REQUEST['u']; ?>
                    <?php $semana = empty($_REQUEST['i']) ? $_SESSION['semana'][0] : $_REQUEST['i']; ?>

                    <?php $data  = array($_SESSION['tutor']['grado'],$_SESSION['tutor']['seccion'],$_SESSION['tutor']['nivel'],$_SESSION['colegio'][0],$_SESSION['anio'][0]); ?>
                    <?php $rs_e  = gestorEstudiante::get_estudiante_reporte($data);?>

                    <?php $row_s = gestorSemana::set_semana($semana) ?>
                    <?php $row_z = gestorSemana::set_semana($semana+1) ?>
                    <?php $row_u = gestorPeriodo::set_periodo(array($unidad,$_SESSION['anio'][0])); ?>

                    <div class="row m-row--full-height">
                        <div class="col-md-12">
                            <div class="m-portlet m-portlet--border-bottom-success m-portlet--rounded">

                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <span class="m-portlet__head-icon m--hide">
                                            <i class="la la-gear"></i>
                                            </span>
                                            <h3 class="m-portlet__head-text">
                                                ETA | EVALUACIÓN: <?php sistema::imprimir($row_s[3]) ?> | UNIDAD: <?php sistema::imprimir(sistema::a_romano($row_u[0])) ?> | FECHA: <?php sistema::imprimir(sistema::formato_fecha($row_s[4])) ?>
                                            </h3>
                                        </div>
                                    </div>
                                </div>

                                    <form id="formMetas" class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                    <input type="hidden" name="new_meta" value="1">
                                    <input type="hidden" name="semana" value="<?php sistema::imprimir($semana)?>" id="semana">
                                    <input type="hidden" name="unidad" value="<?php sistema::imprimir($unidad)?>" id="unidad">
                                    <div class="m-portlet__body">

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
                                    </div>
                                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                        <div class="m-form__actions m-form__actions--solid">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <button onclick="js_tutor.handleSabanaEtaSubmit(<?php sistema::imprimir($unidad.','.$semana) ?>);"  type="button" class="btn btn-outline-primary">Ver</button>
                                                </div>
                                                <div class="col-lg-6 m--align-right">
                                                    <button id="btn-submit-sabana" type="button" class="btn btn-outline-info">Guardar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>



                                <!--end::Form-->
                            </div>
                        </div>
                    </div>

                    <!--end:: Widgets/Quick Stats-->
                </div>
            </div>
            <!--End::Section-->
        </div>
    </div>
</div>