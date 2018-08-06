<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-content">
            <!--Begin::Section-->
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/Quick Stats-->
                       <div class="m-portlet m-portlet--tab">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                        </span>
                                        <h3 class="m-portlet__head-text">
                                            GENERAR LISTA
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <!--begin::Form-->
                            <form id="m-reporteEstudiante" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-4">
                                            <label>Grado:</label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <select class="form-control m-input--air select2Grado" name="grado" style="width: 100%"></select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label class="">Seccion:</label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <select class="form-control m-input--air select2Seccion" name="seccion" style="width: 100%"></select>

                                            </div>
                                        </div>
                                         <div class="col-lg-4">
                                            <label class="">Nivel:</label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <select class="form-control m-input--air select2Nivel" name="nivel" style="width: 100%"></select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-6">
                                            <div class="m-checkbox-inline">
                                                <label class="m-checkbox">
                                                    <input type="checkbox" name="option[]" value="FOTO"> FOTO
                                                    <span></span>
                                                </label>
                                                    <label class="m-checkbox">
                                                    <input type="checkbox" name="option[]" value="GENERO"> GÉNERO
                                                <span></span>
                                                </label>
                                                    <label class="m-checkbox">
                                                    <input type="checkbox" name="option[]" value="EDAD"> EDAD
                                                <span></span>
                                                </label>
                                                <label class="m-checkbox">
                                                    <input type="checkbox" name="option[]" value="F.NAC."> FECHA NACIMIENTO
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="m-radio-inline">
                                                <label class="m-radio">
                                                <input type="radio" name="posicion[]" value="P" checked> VERTICAL
                                                <span></span>
                                                </label>
                                                <label class="m-radio">
                                                <input type="radio" name="posicion[]" value="L"> HORIZONTAL
                                                <span></span>
                                                </label>
                                            </div>
                                            <span class="m-form__help">Solo para archivo PDF</span>
                                        </div>
                                        <div class="col-lg-3">
                                             <label for="">Columnas:</label>
                                        <input id="m_touchspin_2" type="text" class="form-control bootstrap-touchspin-vertical-btn" value="1" name="columna" placeholder="1" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <button id="btn-submit-pdf" type="button" class="btn btn-outline-accent">PDF</button>
                                        <button id="btn-submit-xls" type="button" class="btn btn-outline-brand">EXCEL</button>
                                    </div>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>


                    <!--end:: Widgets/Quick Stats-->
                </div>
            </div>
            <!--End::Section-->
        </div>
    </div>
</div>
<!-- end::Body -->