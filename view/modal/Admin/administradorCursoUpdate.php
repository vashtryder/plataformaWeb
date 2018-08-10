<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<?php $rows = cursoController::setCurso($_REQUEST['id']) ?>
<div class="form-group m-form__group">
    <input type="hidden" name="id" value="<?php sistema::imprimir($rows[0]) ?>">
    <input type="hidden" name="update_curso" value="1">
    <input type="text" class="form-control m-input m-input--air" name="curso" placeholder="INGRESE CURSO ACADÉMICO" value="<?php sistema::imprimir($rows[3]) ?>">
</div>
<div class="form-group m-form__group">
    <input type="hidden" id="idarea" value="<?php sistema::imprimir($rows[2]) ?>">
    <select class="form-control m-input m-input--air select2Area" name="area" style="width: 100%"></select>
</div>
<script type="text/javascript">js_sistema.selects()</script>