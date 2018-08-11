<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<?php
	$row_i = estudianteController::setEstudiante($_REQUEST['id']);
	$row_1 = fichaController::setFicha($row_i[0]);
	$row_2 = gradoController::setGrado($row_1[4]);
	$row_3 = seccionController::setSeccion($row_1[5]);
	$row_4 = nivelController::setNivel($row_1[6]);
?>

    <div class="m-portlet__body">
        <div class="m-form__group row">
            <div class="col-lg-6 form-group">
                <label class="">Institucion Educativa:</label>
                <input type="hidden" name="update_estudiante" value="1">
                <input type="hidden" name="id" value="<?php sistema::imprimir($row_i[0]) ?>">
                <input type="hidden" id="idcolegio" value="<?php sistema::imprimir($row_i[1]) ?>">
                <input type="hidden" name="idficha" value="<?php sistema::imprimir($row_1[0]) ?>">
                <select class="form-control m-input m-input--air select2Colegio" name="idcolegio" style="width: 100%"></select>
            </div>
            <div class="col-lg-3 form-group">
                <label>Apellido Paterno:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air" name="paterno" value="<?php sistema::imprimir($row_i[3]) ?>">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-user"></i></span></span>
                </div>
            </div>
            <div class="col-lg-3 form-group">
                <label class="">Apellido Materno:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air" name="materno" value="<?php sistema::imprimir($row_i[4]) ?>">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-user"></i></span></span>
                </div>
            </div>
        </div>

        <div class=" m-form__group row">

             <div class="col-lg-3 form-group">
                <label class="">Nombres:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air" name="nombre" value="<?php sistema::imprimir($row_i[5]) ?>">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-user"></i></span></span>
                </div>
            </div>

            <div class="col-lg-3 form-group">
                <label>DNI:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air" name="dni" value="<?php sistema::imprimir($row_i[6]) ?>">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-address-card"></i></span></span>

                </div>
            </div>

            <div class="col-lg-6 form-group">
                <label>Correo:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air" name="correo" value="<?php sistema::imprimir($row_i[13]) ?>">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-envelope-square"></i></span></span>

                </div>
            </div>
        </div>
        <div class="m-form__group row">
            <div class="col-lg-3">
                <label>Sexo:</label>
                <div class="m-input-icon m-input-icon--right">
                    <div class="m-radio-inline">
                        <label class="m-radio">
                        <input type="radio" name="sexo" <?php if($row_i[7] == 1) sistema::imprimir('checked') ?> value="1"> M
                        <span></span>
                        </label>
                        <label class="m-radio">
                        <input type="radio" name="sexo" <?php if($row_i[7] == 2) sistema::imprimir('checked') ?> value="2"> F
                        <span></span>
                        </label>
                    </div>

                </div>
            </div>

             <div class="col-lg-3 form-group">
                <label>Fecha Nacimiento</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air m_datepicker" name="fecnac" value="<?php sistema::imprimir($row_i[9]) ?>">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-calendar"></i></span></span>
                </div>
            </div>
            <div class="col-lg-3 form-group">
                <label>Edad:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air" id="edad" name="edad" readonly value="<?php sistema::imprimir($row_i[8]) ?>">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-star-o"></i></span></span>

                </div>
            </div>
            <div class="col-lg-3 form-group">
                <label>Telefeno y/o Celular:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air" name="telefono1" value="<?php sistema::imprimir($row_i[11]) ?>">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-phone"></i></span></span>

                </div>
            </div>

        </div>

        <div class="form-group m-form__group row">
            <div class="col-lg-3">
                <label>Telefeno y/o Celular:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air" name="telefono2" value="<?php sistema::imprimir($row_i[12]) ?>">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-phone"></i></span></span>

                </div>
            </div>

            <div class="col-lg-9">
                <label>Direccion</label>
                <div class="m-input-icon m-input-icon--right">
                    <textarea class="form-control m-input m-input--air" rows="2" name="direccion" placeholder="Av|Lt|Jr|Calle|Urbanización"><?php sistema::imprimir($row_i[10]) ?></textarea>
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-map-marker"></i></span></span>
                </div>
            </div>
        </div>

        <div class="form-group m-form__group row">
            <div class="col-lg-4">
                <label>Grado:</label>
                <input type="hidden" id="idgrado" value="<?php sistema::imprimir($row_2[0]) ?>">
                <select class="form-control m-input--air select2Grado" name="grado" style="width: 100%"></select>
            </div>
            <div class="col-lg-4">
                <label class="">Seccion:</label>
                <input type="hidden" id="idseccion" value="<?php sistema::imprimir($row_3[0]) ?>">
                <select class="form-control m-input--air select2Seccion" name="seccion" style="width: 100%"></select>

            </div>
             <div class="col-lg-4">
                <label class="">Nivel:</label>
                <input type="hidden" id="idnivel" value="<?php sistema::imprimir($row_4[0]) ?>">
                <select class="form-control m-input--air select2Nivel" name="nivel" style="width: 100%"></select>
            </div>
        </div>

    </div>
<script type="text/javascript">js_sistema.init()</script>