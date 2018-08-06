<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-content">
            <!--Begin::Section-->
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/Quick Stats-->

                    <div class="row m-row--full-height">
                        <div class="col-md-2"></div>
                        <div class="col-sm-12 col-md-12 col-lg-8">
                            <div class="m-portlet m-portlet--border-bottom-success m-portlet--rounded">
                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <span class="m-portlet__head-icon m--hide">
                                            <i class="la la-gear"></i>
                                            </span>
                                            <h3 class="m-portlet__head-text">
                                                REPORTE POR ESTUDIANTE
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Form-->
                                <form id="m-reporteEstudiante" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-12">
                                                <input type="hidden" name="colegio" value="<?php sistema::imprimir($_SESSION['colegio'][0]) ?>">
                                                <label>Seleccione Estudiante:</label>
                                                <select class="form-control m-input--air select2Estudiante" name="estudiante" style="width: 100%">
                                                    <option value=""></option>
                                                </select>
                                                <span class="m-form__help"></span>
                                            </div>

                                        </div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-12">
                                                <label>Seleccione Unidad:</label>
                                                <?php $rs = gestorPeriodo::get_periodo() ?>
                                                <div class="m-checkbox-inline">
                                                <?php foreach ($rs as $row) { ?>
                                                    <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand">
                                                    <input type="checkbox" name='unidad[<?php sistema::imprimir($row[0]) ?>]' value="<?php sistema::imprimir($row[0]) ?>" <?php if($row[0] == $_SESSION['semana'][0]) sistema::imprimir('checked') ?> > <?php sistema::imprimir(sistema::a_romano($row[0])) ?>
                                                    <span></span>
                                                    </label>
                                                <?php  } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                        <div class="m-form__actions m-form__actions--solid">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <button id="btn-submit-estudiante1" type="reset" class="btn btn-outline-primary">PDF</button>
                                                </div>
                                                <div class="col-lg-6 m--align-right">
                                                    <button id="btn-submit-estudiante2" type="reset" class="btn btn-outline-danger">EXCEL</button>
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
<!-- end::Body -->