
<?php include_once '../../../Api/core/ControladorBase.php'?>
<?php include_once '../../../Api/config/sistema.php' ?>
<div class="form-group m-form__group">
    <input type="hidden" name="new_periodo" value="1">
    <input type="hidden" name="anio" value="<?php sistema::imprimir($_SESSION['user'][0])?>">
    <input type="text" class="form-control m-input m-input--air m-upper" name="periodo" placeholder="INGRESE BIMESTRE ACADÉMICO">
</div>
<div class="form-group m-form__group">
    <textarea class="form-control m-input--air m-upper" name="observacion" placeholder="INGRESE UNA OBSERVACIÓN"></textarea>
</div>
<script type="text/javascript">js_sistema.init()</script>