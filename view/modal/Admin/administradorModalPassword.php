<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label>ID Usuario:</label>
        <input type="hidden" name="password_token" value="<?php sistema::imprimir($_SESSION['modulo'][0])?>">
        <input type="hidden" name="id" value="<?php sistema::imprimir($_SESSION['login'][0])?>">
        <input type="text" class="form-control m-input" value="<?php sistema::imprimir($_SESSION['login'][1]) ?>" readonly>
    </div>
</div>
<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label>Contraseña Nueva:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="password" class="form-control m-input m-input--air" id="password" name="password" autocomplete="off">
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa  fa-key"></i></span></span>
        </div>
    </div>
</div>

<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label class="">Repetir Contraseña:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="password" class="form-control m-input m-input--air" name="rpassword" autocomplete="off">
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa  fa-key"></i></span></span>
        </div>
    </div>
</div>