<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<?php $rows = areaController::setArea($_REQUEST['id']) ?>
<div class="form-group m-form__group">
    <input type="hidden" name="update_area" value="1">
    <input type="hidden" name="id" value="<?php sistema::imprimir($rows[0])?>">
    <input type="text" class="form-control m-input m-input--air m-upper" name="area" placeholder="INGRESE ÁREA ACADÉMICA" value="<?php sistema::imprimir($rows[3]) ?>">
</div>
<div class="form-group m-form__group">
    <input type="hidden" id="idnivel" value="<?php sistema::imprimir($rows[2])?>">
    <select class="form-control m-input--air m-input select2Nivel" name="nivel"></select>
</div>
<script type="text/javascript">js_sistema.init(); js_sistema.selects()</script>