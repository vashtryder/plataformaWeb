<!-- begin::Body -->
<?php $rows = gestorColegio::set_colegio($_SESSION['colegio'][0]) ?>
<div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <div class="m-content">
            <!--Begin::Section-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        DATOS DE INSTITUCIÓN EDUCATIVA
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-8">
                                        <label>Nombre:</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="hidden" name="update_colegio" value="1">
                                            <input type="hidden" name="id" value="<?php sistema::imprimir($rows[0]) ?>" >
                                            <input type="text" class="form-control m-input m-input--air" name="nombre" value="<?php sistema::imprimir($rows[1]) ?>">
                                            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-university"></i></span></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">Acronimo:</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input m-input--air" name="acronimo" value="<?php sistema::imprimir($rows[5]) ?>">
                                            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-ellipsis-h"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12">
                                        <label>Dirección</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <textarea class="form-control m-input m-input--air" rows="4" placeholder="Av|Lt|Jr|Calle|Urbanización" name="direccion"><?php sistema::imprimir($rows[2]) ?></textarea>
                                            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-map-marker"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>Correo Principal:</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input m-input--air" name="correo" value="<?php sistema::imprimir($rows[9]) ?>">
                                            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-envelope-square"></i></span></span>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Telefeno y/o Celular:</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input m-input--air" name="telefono1" value="<?php sistema::imprimir($rows[3]) ?>">
                                            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-phone"></i></span></span>

                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Telefeno y/o Celular:</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input m-input--air" name="telefono2" value="<?php sistema::imprimir($rows[4]) ?>">
                                            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-phone"></i></span></span>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>WebSite Principal:</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="email" class="form-control m-input m-input--air" name="website" value="<?php sistema::imprimir($rows[6]) ?>">
                                            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-chain"></i></span></span>

                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Facebook:</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input m-input--air" name="facebook" value="<?php sistema::imprimir($rows[7]) ?>">
                                            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-facebook-square"></i></span></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Youtube:</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input m-input--air" name="youtube" value="<?php sistema::imprimir($rows[8]) ?>">
                                            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-youtube-square"></i></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button id="btn-submit-update" type="reset" class="btn btn-outline-primary">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>