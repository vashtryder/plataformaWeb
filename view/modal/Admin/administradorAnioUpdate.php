<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<?php $rows = anioController::setAnio($_POST['id']) ?>
<div class="form-group m-form__group">
    <input type="hidden" name="update_anio" value="1">
	<input type="hidden" name="id" value="<?php sistema::imprimir($rows[0])?>">
    <input type="text" class="form-control m-input m-input--air m-upper" name="anio" placeholder="INGRESE AÑO ACADÉMICO" value="<?php sistema::imprimir($rows[1])?>">
</div>
<script type="text/javascript">js_sistema.init()</script>