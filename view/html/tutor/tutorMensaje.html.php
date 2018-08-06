<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-content">
            <!--Begin::Section-->
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/Quick Stats-->
                    <div class="row m-row--full-height">
                        <div class="col-md-12">
                            <div class="m-portlet m-portlet--mobile">
                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-tools">
                                        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x" role="tablist">
                                            <li class="nav-item m-tabs__item">
                                                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_tabs_1" role="tab">
                                                    <i class="flaticon-multimedia-5"></i> Recibidos <span class="m-badge m-badge--primary m-badge--wide m-recibido"> 0 </span>
                                                </a>
                                            </li>
                                            <li class="nav-item m-tabs__item">
                                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_2" role="tab">
                                                    <i class="flaticon-multimedia-3"></i> Enviados <span class=" m-badge m-badge--primary m-badge--wide m-enviado"> 0 </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--begin::Form-->

                                <div class="m-portlet__body">
                                     <div class="tab-content">

                                        <div class="tab-pane active" id="m_tabs_1" role="tabpanel">
                                            <!--begin: Search Form -->
                                            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                                <div class="row align-items-center">
                                                    <div class="col-xl-8 order-2 order-xl-1">
                                                        <div class="form-group m-form__group row align-items-center">
                                                            <div class="col-md-4">
                                                                <div class="m-form__group m-form__group--inline">
                                                                    <div class="m-form__label">
                                                                        <label>Vista:</label>
                                                                    </div>
                                                                    <div class="m-form__control">
                                                                        <select class="form-control m-bootstrap-select" id="m_form_status">
                                                                            <option value="">Todo</option>
                                                                            <option value="0">Sin Leer</option>
                                                                            <option value="1">Visto</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="d-md-none m--margin-bottom-10"></div>
                                                            </div>
                                                            <div class="col-md-4">

                                                                <div class="d-md-none m--margin-bottom-10"></div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                                        <div class="m-input-icon m-input-icon--left">
                                                            <input type="text" class="form-control m-input m-input--solid" placeholder="Buscar..." id="generalSearchRecibido">
                                                            <span class="m-input-icon__icon m-input-icon__icon--left">
                                                                <span><i class="la la-search"></i></span>
                                                            </span>
                                                        </div>
                                                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end: Search Form -->
                                            <div class="m_regMensajeRecibido"></div>
                                        </div>

                                        <div class="tab-pane" id="m_tabs_2" role="tabpanel">
                                            <!--begin: Search Form -->
                                            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                                <div class="row align-items-center">
                                                    <div class="col-xl-8 order-2 order-xl-1">
                                                        <div class="form-group m-form__group row align-items-center">
                                                            <div class="col-md-4">

                                                                <div class="d-md-none m--margin-bottom-10"></div>
                                                            </div>
                                                            <div class="col-md-4">

                                                                <div class="d-md-none m--margin-bottom-10"></div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                                        <div class="m-input-icon m-input-icon--left">
                                                            <input type="text" class="form-control m-input m-input--solid" placeholder="Buscar..." id="generalSearchEnviado">
                                                            <span class="m-input-icon__icon m-input-icon__icon--left">
                                                                <span><i class="la la-search"></i></span>
                                                            </span>
                                                        </div>
                                                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end: Search Form -->
                                            <div class="m_regMensajeEnviado"></div>
                                        </div>
                                    </div>
                                </div>

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

<div class="modal fade" id="m-MensajeRecibido"  role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">MENSAJE RECIBIDO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
           <form id="m-Notificacion">
                <div class="modal-body">
                    <div id="m_Mensaje_Recibido"></div>
                </div>
                <div class="modal-footer">
                    <button id="btn-cancel-mensaje" type="button" class="btn btn-outline-metal" data-dismiss="modal">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>


