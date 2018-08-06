<?php include_once '../../../conf.ini.php' ?>
<?php $rows = gestorNivel::set_nivel($_POST['id']) ?>
<div class="form-group m-form__group">
    <input type="hidden" name="update_nivel" value="1">
    <input type="hidden" name="id" value="<?php sistema::imprimir($rows[0])?>">
    <input type="text" class="form-control m-input m-input--air" name="nivel" placeholder="INGRESE NIVEL ACADÉMICO" value="<?php sistema::imprimir($rows[1])?>">
</div>