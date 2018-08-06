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
                                                PERFIL USUARIO
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Form-->

                                <div class="m-portlet__body">
                                    <form class="m-form m-form--fit m-form--label-align-right">
                                        <?php $_SESSION['var'] = 0 ?>
                                        <input type="hidden" id="idPersonal" value="<?php sistema::imprimir($_SESSION['user'][0]) ?>">
                                        <div class="m_frmPersonal"></div>
                                        <div class="m-form__actions">
                                            <div class="row">
                                                <button id="btn-submit-personal" type="button" class="btn btn-outline-primary">Actualizar</button>
                                            </div>
                                        </div>
                                    </form>
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

