<?php include_once '../../../conf.ini.php' ?>
<?php $rows = gestorProceso::set_proceso($_POST['id']) ?>
<div class="form-group m-form__group">
    <input type="hidden" name="update_proceso" value="1">
    <input type="hidden" name="id" value="<?php sistema::imprimir($rows[0]) ?>">
    <input type="text" class="form-control m-input m-input--air m-upper" name="nombre" placeholder="INGRESE PROCESO" value="<?php sistema::imprimir($rows[1]) ?>">
</div>
<script type="text/javascript">js_sistema.init()</script>