<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<?php $data = array($_REQUEST['id'],$_SESSION['anio'][0]) ?>
<?php $rows = periodoController::setPeriodo($data) ?>
<div class="form-group m-form__group">
    <input type="hidden" name="update_periodo" value="1">
    <input type="hidden" name="id" value="<?php sistema::imprimir($rows[0])?>">
    <input type="text" class="form-control m-input m-input--air m-upper" name="periodo" placeholder="INGRESE BIMESTRE ACADÉMICO" value="<?php sistema::imprimir($rows[3])?>">
</div>
<div class="form-group m-form__group">
    <textarea class="form-control m-input--air m-upper" name="observacion" placeholder="INGRESE UNA OBSERVACIÓN"><?php sistema::imprimir($rows[4])?></textarea>
</div>
<script type="text/javascript">js_sistema.init()</script>