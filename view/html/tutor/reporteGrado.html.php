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
                                                REPORTE POR GRADO
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Form-->
                                <form id="m-reporteGrado" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                    <div class="m-portlet__body">
                                        <div class="m-form__group row">
                                            <div class="col-lg-6 form-group">
                                                <input type="hidden" name="colegio" value="<?php sistema::imprimir($_SESSION['colegio'][0]) ?>">
                                                 <select class="form-control m-input--air select2Periodo" name="unidad" onchange="js_sistema.paraElegirSemana()" style="width: 100%">
                                                    <option value="">SELECCIONE UNIDAD </option>
                                                </select>
                                                <span class="m-form__help"></span>
                                            </div>
                                            <div class="col-lg-6 form-group">
                                                <select class="form-control m-input--air select2Semana" name="semana" style="width: 100%">
                                                     <option value="">SELECCIONE SEMANA ETA</option>
                                                </select>
                                                <span class="m-form__help"></span>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                        <div class="m-form__actions m-form__actions--solid">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <button id="btn-submit-grado1" type="button" class="btn btn-outline-primary">PDF</button>
                                                </div>
                                                <div class="col-lg-6 m--align-right">
                                                    <button id="btn-submit-grado2" type="button" class="btn btn-outline-danger">EXCEL</button>
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