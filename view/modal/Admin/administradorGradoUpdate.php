<?php include_once '../../../conf.ini.php' ?>
<?php $rows = gestorGrado::set_grado($_POST['id']) ?>
<div class="form-group m-form__group">
    <input type="hidden" name="update_grado" value="1">
    <input type="hidden" name="id" value="<?php sistema::imprimir($rows[0]) ?>">
    <input type="text" class="form-control m-input m-input--air m-upper" name="grado" placeholder="INGRESE GRADO ACADÉMICO" value="<?php sistema::imprimir($rows[1])?>">
</div>
<script type="text/javascript">js_sistema.init()</script>