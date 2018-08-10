<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<?php $rows = seccionController::setSeccion($_POST['id']) ?>
<div class="form-group m-form__group">
    <input type="hidden" name="update_seccion" value="1">
    <input type="hidden" name="id" value="<?php sistema::imprimir($rows[0])?>">
    <input type="text" class="form-control m-input m-input--air" name="seccion" placeholder="INGRESE SECCIÓN ACADÉMICA" value="<?php sistema::imprimir($rows[1])?>">
</div>