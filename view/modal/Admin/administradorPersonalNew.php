<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>

<div class="row ">
    <div class="col-md-5 m-form__group form-group">
        <input type="hidden" name="new_personal" value="1">
        <input type="hidden" name="idanio" value="<?php sistema::imprimir($_SESSION['anio'][0])?>">
        <select class="form-control select2Colegio" name="idcolegio" style="width: 100%">
            <option value=""></option>
        </select>
        <span class="m-form__help"></span>
    </div>

    <div class="col-md-3 m-form__group form-group">
        <select class="form-control select2Modulo" name="idmodulo" style="width: 100%">
            <option value=""></option>
        </select>
        <span class="m-form__help"></span>
    </div>

    <div class="col-md-4 m-form__group form-group">
        <input type="text" class="form-control m-input m-input--air m-upper" name="nombre" placeholder="NOMBRE COMPLETO">
    </div>
</div>

<div class="row ">

    <div class="col-md-3 m-form__group form-group">
        <input type="text" class="form-control m-input m-input--air m-upper" name="paterno" placeholder="APE PATERNO">
    </div>

    <div class="col-md-3 m-form__group form-group">
        <input type="text" class="form-control m-input m-input--air m-upper" name="materno" placeholder="APE MATERNO">
    </div>

    <div class="col-md-3 m-form__group form-group">
        <input type="text" class="form-control m-input m-input--air" name="dni" placeholder="DNI">
    </div>

    <div class="col-md-3 m-form__group form-group">
        <input type="text" class="form-control m-input m-input--air m_datepicker" name="fecnac" value="2002-01-01">
    </div>
</div>

<div class="row  ">
    <div class="col-lg-3 m-form__group form-group">
        <input type="text" class="form-control m-input m-input--air" name="telefono1">
    </div>

    <div class="col-lg-3 m-form__group form-group">
        <input type="text" class="form-control m-input m-input--air" name="telefono2">
    </div>

    <div class="col-lg-6 m-form__group form-group">
        <input type="text" class="form-control m-input m-input--air" name="correo">
    </div>
</div>

<div class="row">
    <div class="col-lg-5 m-form__group form-group">
        <div class="m-input-icon m-input-icon--right">
            <div class="m-radio-inline">
                <label class="m-radio">
                <input type="radio" name="sexo" checked value="1"> Masculino
                <span></span>
                </label>
                <label class="m-radio">
                <input type="radio" name="sexo" value="2"> Femenino
                <span></span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-lg-7 m-form__group form-group">
        <textarea class="form-control m-input m-input--air" rows="2" name="direccion" placeholder="Av|Lt|Jr|Calle|Urbanización"></textarea>
    </div>
</div>

<script type="text/javascript">js_sistema.selects(); js_sistema.init()</script>