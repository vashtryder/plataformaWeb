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
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <span class="m-portlet__head-icon m--hide">
                                            <i class="la la-gear"></i>
                                            </span>
                                            <h3 class="m-portlet__head-text">
                                                PROCESO ITEM
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Form-->

                                <div class="m-portlet__body">
                                    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                    <div class="row align-items-center">
                                        <div class="col-xl-8 order-2 order-xl-1">
                                            <div class="form-group m-form__group row align-items-center">
                                                <div class="col-md-8">
                                                    <div class="m-input-icon m-input-icon--left">
                                                        <input type="text" class="form-control m-input m-input m-input--air " placeholder="Buscar..." id="generalSearch">
                                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                                            <span><i class="la la-search"></i></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                            <a href="#" onclick="js_item.modalItemNewSubmit()" class="btn btn-focus m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                                <span>Agregar</span>
                                            </a>
                                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="m_regItem"></div>
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

<div class="modal fade" id="m_modalAgregar"  role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg"" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CREAR PROCESO ITEM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="m-form m-form--state m-form--label-align-right">
        <div class="modal-body">
            <div id="m_modalNew"></div>
        </div>
      <div class="modal-footer">
        <button id="btn-submit-new" type="button" class="btn btn-outline-primary">Registar</button>
        <button id="btn_cancel-new" type="button" class="btn btn-outline-metal" data-dismiss="modal">Cancelar</button>

      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="m_modalActualizar"  role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg"" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR PROCESO ITEM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="m-form m-form--state m-form--label-align-right">
      <div class="modal-body">
        <div id="m_modalUpdate"></div>
      </div>
      <div class="modal-footer">
        <button id="btn-submit-update" type="button" class="btn btn-outline-primary">Actualizar</button>
        <button id="btn-cancel-update" type="button" class="btn btn-outline-metal" data-dismiss="modal">Cancelar</button>

      </div>
    </form>
    </div>
  </div>
</div>

