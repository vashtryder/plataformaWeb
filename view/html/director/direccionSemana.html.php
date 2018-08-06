
<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-content">
            <!--Begin::Section-->
            <div class="row">

                <div class="col-xl-12">
                    <!--begin:: Widgets/Quick Stats-->

                    <?php $unidad = empty($_REQUEST['u']) ? $_SESSION['semana'][1] : $_REQUEST['u']; ?>
                    <?php $semana = empty($_REQUEST['i']) ? $_SESSION['semana'][0] : $_REQUEST['i']; ?>

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

                                <div class="m-portlet__body">

                                    <div class="col-md-12">
                                        <form class="m-form m-form--fit m-form--label-align-right" id="frmSemanaEta">
                                            <div class="m-form__group row">
                                                <div class="col-lg-3 form-group">
                                                    <div class="m-input-icon m-input-icon--right">
                                                        <input type="hidden" name="semana" value="<?php sistema::imprimir($semana)?>">
                                                        <input type="hidden" name="unidad" value="<?php sistema::imprimir($unidad)?>">

                                                        <select class="form-control m-input--air select2Grado" name="grado" style="width: 100%">
                                                            <option value=""></option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <div class="m-input-icon m-input-icon--right">
                                                        <select class="form-control m-input--air select2Seccion" name="seccion" style="width: 100%">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 form-group">
                                                    <div class="m-input-icon m-input-icon--right">
                                                        <select class="form-control m-input--air select2Nivel" name="nivel" style="width: 100%">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <button id="btn-submit-eta" class="btn btn-outline-info m-btn m-btn--icon">
                                                        <span>
                                                            <i class="la la-search"></i> <span>BUSCAR</span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col-md-12">
                                        <form id="formMetas" class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                            <input type="hidden" name="new_meta" value="1">
                                            <input type="hidden" name="semana" value="<?php sistema::imprimir($semana)?>" id="semana">
                                            <input type="hidden" name="unidad" value="<?php sistema::imprimir($unidad)?>" id="unidad">

                                            <div id="tablaSemanaEta"></div>

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
                                    </div>
                                <!--end::Form-->
                                </div>
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