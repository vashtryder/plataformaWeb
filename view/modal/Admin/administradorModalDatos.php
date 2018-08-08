<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label>DNI:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="hidden" name="update_token" value="<?php sistema::imprimir($_SESSION['modulo'][0])?>">
            <input type="hidden" name="id" value="<?php sistema::imprimir($_SESSION['user'][0]) ?>">
            <input type="text" class="form-control m-input m-input--air" readonly value="<?php sistema::imprimir($_SESSION['user'][1]) ?>">
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-vcard-o"></i></span></span>
        </div>
    </div>
</div>

<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label>Apellido Paterno:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="text" class="form-control m-input m-input--air m-upper" id="paterno" name="paterno" value="<?php sistema::imprimir($_SESSION['user'][2]) ?>">
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-user"></i></span></span>
        </div>
    </div>
</div>

<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label class="">Apellido Materno:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="text" class="form-control m-input m-input--air m-upper" id="materno" name="materno" value="<?php sistema::imprimir($_SESSION['user'][3]) ?>">
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-user"></i></span></span>
        </div>
    </div>
</div>

<div class="form-group m-form__group row">
     <div class="col-lg-12">
        <label class="">Nombres:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="text" class="form-control m-input m-input--air m-upper" id="nombres" name="nombres" value="<?php sistema::imprimir($_SESSION['user'][4]) ?>">
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-user"></i></span></span>
        </div>
    </div>
</div>

<div class="form-group m-form__group row">
     <div class="col-lg-6">
        <label class="">Telefono | Celular:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="text" class="form-control m-input m-input--air" name="celular1" value="<?php sistema::imprimir($_SESSION['user'][7]) ?>">
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-phone"></i></span></span>
        </div>
    </div>
    <div class="col-lg-6">
        <label class="">* Telefono | Celular:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="text" class="form-control m-input m-input--air" name="celular2" value="<?php sistema::imprimir($_SESSION['user'][8]) ?>">
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-phone"></i></span></span>
        </div>

    </div>
</div>

<div class="form-group m-form__group row">
     <div class="col-lg-12">
        <label class="">Correo Electronico:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="email" class="form-control m-input m-input--air" name="correo" value="<?php sistema::imprimir($_SESSION['user'][6]) ?>">
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-envelope"></i></span></span>
        </div>
        <span class="m-form__help">(*) Dato opcional </span>
    </div>
</div>
<script type="text/javascript">js_sistema.init()</script>