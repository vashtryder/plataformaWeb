
<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-content">
            <!--Begin::Section-->
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/Quick Stats-->
                        <div class="m-portlet" id="m_portlet">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <span class="m-portlet__head-icon">
                                            <i class="flaticon-map-location"></i>
                                        </span>
                                        <h3 class="m-portlet__head-text">
                                            Historia Reflexiva
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <!-- <ul class="m-portlet__nav">
                                        <li class="m-portlet__nav-item">
                                            <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                                <span>
                                                    <i class="la la-plus"></i>
                                                    <span>Add Event</span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul> -->
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div id="m_calendar"></div>
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


<div class="modal fade" id="eventContent" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eventInfo">Event title</h5>
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