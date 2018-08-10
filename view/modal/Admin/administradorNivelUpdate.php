<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<?php $rows = nivelController::setNivel($_POST['id']) ?>
<div class="form-group m-form__group">
    <input type="hidden" name="update_nivel" value="1">
    <input type="hidden" name="id" value="<?php sistema::imprimir($rows[0])?>">
    <input type="text" class="form-control m-input m-input--air" name="nivel" placeholder="INGRESE NIVEL ACADÉMICO" value="<?php sistema::imprimir($rows[1])?>">
</div>