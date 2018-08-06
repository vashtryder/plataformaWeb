<?php include_once '../../../conf.ini.php' ?>

    <div class="m-portlet__body">
         <div class="m-form__group row">
            <div class="col-lg-6 form-group ">
                <label class="">Institucion Educativa:</label>
                <input type="hidden" name="new_estudiante" value="1">
                <input type="hidden" name="idanio" value="<?php sistema::imprimir($_SESSION['anio'][0]) ?>">
                <select class="form-control m-input m-input--air select2Colegio" name="idcolegio" style="width: 100%">
                    <option value=""></option>
                </select>
            </div>
            <div class="col-lg-3 form-group ">
                <label>Apellido Paterno:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air m-upper" name="paterno">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-user"></i></span></span>
                </div>
            </div>
            <div class="col-lg-3 form-group ">
                <label class="">Apellido Materno:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air m-upper" name="materno">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-user"></i></span></span>
                </div>
            </div>
        </div>
        <div class="m-form__group row">
             <div class="col-lg-3 form-group ">
                <label class="">Nombres:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air m-upper" name="nombre">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span>
                        <i class="fa fa-user"></i></span>
                    </span>
                </div>
            </div>
            <div class="col-lg-3 form-group ">
                <label>DNI:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air" name="dni">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-address-card"></i></span></span>
                </div>
            </div>
            <div class="col-lg-6 form-group">
                <label>Correo:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air" name="correo">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-envelope-square"></i></span></span>

                </div>
            </div>
        </div>
        <div class="m-form__group row">
            <div class="col-lg-3 form-group ">
                <label>Sexo:</label>
                <div class="m-input-icon m-input-icon--right">
                    <div class="m-radio-inline">
                        <label class="m-radio">
                        <input type="radio" name="sexo" checked value="1"> M
                        <span></span>
                        </label>
                        <label class="m-radio">
                        <input type="radio" name="sexo" value="2"> F
                        <span></span>
                        </label>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 form-group">
                <label>Fecha Nacimiento</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m_datepicker" name="fecnac" value="2002-01-01">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-calendar"></i></span></span>
                </div>
            </div>
            <div class="col-lg-3 form-group">
                <label>Edad:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air" id="edad" name="edad" value="0" readonly="">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-star-o"></i></span></span>
                </div>
            </div>
            <div class="col-lg-3 form-group">
                <label>Telefeno y/o Celular:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air" name="telefono1">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-phone"></i></span></span>
                </div>
            </div>

        </div>

        <div class="m-form__group row">
            <div class="col-lg-3 form-group">
                <label>Telefeno y/o Celular:</label>
                <div class="m-input-icon m-input-icon--right">
                    <input type="text" class="form-control m-input m-input--air" name="telefono2">
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-phone"></i></span></span>

                </div>
            </div>
             <div class="col-lg-9 form-group">
                <label>Direccion</label>
                <div class="m-input-icon m-input-icon--right">
                    <textarea class="form-control m-input m-input--air" rows="2" name="direccion" placeholder="Av|Lt|Jr|Calle|Urbanización"></textarea>
                    <span class="m-input-icon__icon m-input-icon__icon--right m-input--air m-upper"><span><i class="fa fa-map-marker"></i></span></span>
                </div>
            </div>
        </div>

        <div class="m-form__group row">
            <div class="col-lg-4 form-group">
                <label>Grado:</label>
                <select class="form-control select2Grado" name="grado" style="width: 100%">
                    <option value=""></option>
                </select>
            </div>
            <div class="col-lg-4 form-group">
                <label class="">Seccion:</label>
                <select class="form-control select2Seccion" name="seccion" style="width: 100%">
                   <option value=""></option>
                </select>
            </div>
             <div class="col-lg-4 form-group">
                <label class="">Nivel:</label>
                <select class="form-control select2Nivel" name="nivel" style="width: 100%">
                    <option value=""></option>
                </select>
            </div>
        </div>



    </div>

<script type="text/javascript">js_sistema.selects(); js_sistema.init()</script>