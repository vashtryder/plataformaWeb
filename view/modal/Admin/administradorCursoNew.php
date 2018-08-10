<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<div class="form-group m-form__group">
    <input type="hidden" name="idanio" value="<?php sistema::imprimir($_SESSION['anio'][0]) ?>">
    <input type="hidden" name="new_curso" value="1">
    <input type="text" class="form-control m-input m-input--air m-upper" name="curso" placeholder="INGRESE CURSO ACADÉMICO">
</div>
<div class="form-group m-form__group">
    <select class="form-control m-input m-input--air select2Area" name="area" style="width: 100%"></select>
</div>
<script type="text/javascript">js_sistema.init(); js_sistema.selects()</script>