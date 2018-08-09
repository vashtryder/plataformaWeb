<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label>Para:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="hidden" name="new_mensaje" value="1">
            <input type="hidden" name="de" value="<?php sistema::imprimir($_SESSION['user'][0]) ?>">

            <select class="form-control m-select2 selectPersonal m-input--air" multiple="multiple" name="para[]"></select>
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-user"></i></span></span>
        </div>
    </div>
</div>

<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label class="">Asunto:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="text" class="form-control m-input m-input--air" placeholder="" name="asunto">
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa  fa-tag"></i></span></span>
        </div>
    </div>
</div>

<div class="form-group m-form__group row">
     <div class="col-lg-12">
        <label class="">Mensaje:</label>
        <div class="m-input-icon m-input-icon--right">
            <textarea rows="10" class="form-control m-input m-input--air" placeholder="" name="texto"></textarea>
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-envelope"></i></span></span>
        </div>
    </div>
</div>
<script type="text/javascript">js_sistema.selects()</script>