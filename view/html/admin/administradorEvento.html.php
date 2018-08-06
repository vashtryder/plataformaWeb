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
                            <div class="m-portlet">
                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                           <span class="m-portlet__head-icon">
                                                <i class="flaticon-calendar-1"></i>
                                            </span>
                                            <h3 class="m-portlet__head-text">
                                               CALENDARIO DE HISTORIA REFLEXIVA
                                            </h3>
                                        </div>
                                    </div>

                                    <div class="m-portlet__head-tools">
                                        <ul class="m-portlet__nav">
                                            <li class="m-portlet__nav-item">
                                                <a href="#" onclick="js_evento.modalEventoNewSubmit()"  class="m-portlet__nav-link m-portlet__nav-link--icon" data-toggle="m-tooltip" data-placement="top" title="" data-original-title="AGREGAR EVENTO"><i class="la la-plus-circle"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--begin::Form-->

                                <div class="m-portlet__body">
                                    <div id="m_calendar"></div>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CREAR HISTORIA REFLEXIVA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="from-new" class="m-form m-form--label-align-right" enctype="multipart/form-data">
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

<div class="modal fade" id="m_modalActualizar" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR HISTORIA REFLEXIVA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="from-update" class="m-form m-form--label-align-right" enctype="multipart/form-data">
      <div class="modal-body">
        <div id="m_modalUpdate"></div>
      </div>
      <div class="modal-footer">
        <button id="btn-submit-ver" type="button" class="btn btn-outline-success">VER</button>
        <button id="btn-submit-update" type="button" class="btn btn-outline-primary">Actualizar</button>
        <button id="btn-submit-delete" type="button" class="btn btn-outline-danger">Eliminar</button>
        <button id="btn-cancel-update" type="button" class="btn btn-outline-metal" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="m_eventContent" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eventInfo"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">

        <div id="Iframe-Master-CC-and-Rs" class="set-margin set-padding set-border set-box-shadow center-block-horiz">
            <div id="eventLink"></div>
        </div>

        <footer class="blockquote-footer"><cite title="Source Title" id="startTime">Source Title</cite></footer>
      </div>
      <div class="modal-footer">
<!--         <button type="button" id="btn-submit-event" href="" class="btn btn-outline-primary">Descargar</button> -->
        <button type="button" id="btn-submit-cancelar" href="" class="btn btn-outline-metal" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>