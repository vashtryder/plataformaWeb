<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<?php $row = gestorMensaje::set_mensaje($_REQUEST['id']) ?>
<?php $rows1 = gestorPersonal::set_personal($row[4]); ?>

<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label>De:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="hidden" name="new_mensaje" value="1">
            <input type="text" class="form-control m-input m-input--air" name="" value="<?php sistema::imprimir($rows1[3]." ".$rows1[4]." ".$rows1[5]) ?>">
        </div>
    </div>
</div>

<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label class="">Asunto:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="text" class="form-control m-input m-input--air" name="" value="<?php sistema::imprimir($row[8]) ?>">
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa  fa-tag"></i></span></span>
        </div>
    </div>
</div>

<div class="form-group m-form__group row">
     <div class="col-lg-12">
        <label class="">Mensaje:</label>
        <div class="m-input-icon m-input-icon--right">
            <textarea rows="10" class="form-control m-input m-input--air" placeholder="" name="texto"><?php sistema::imprimir($row[9]) ?></textarea>
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-envelope"></i></span></span>
        </div>
    </div>
</div>