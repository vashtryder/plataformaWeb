<?php include_once '../../../Api/config/sistema.php' ?>
<?php include_once "../../../Api/core/ControladorBase.php"; ?>
<div class="m-form__group row">
     <div class="col-lg-6 form-group">
        <input type="hidden" name="new_semana" value="1">
        <input type="hidden" name="idanio" value="<?php sistema::imprimir($_SESSION['anio'][0]) ?>">
        <input type="text" class="form-control m-input m-input m-upper" name="nombre" placeholder="INGRESE NOMBRE SEMANA ETA">
    </div>
    <div class="col-lg-6 form-group">
        <select class="form-control m-input m-input--air select2Periodo" name="unidad">
            <option value=""></option>
        </select>
    </div>
</div>

<div class="m-form__group row">
    <div class="col-md-6 form-group">
        <input type="text" class="form-control m-input m-input--air m_datepicker" name="fechaini" placeholder="FECHA INICIO">
    </div>
    <div class="col-md-6 form-group">
        <input type="text" class="form-control m-input m-input--air m_datepicker" name="fechafin" placeholder="FECHA FINAL">
    </div>
</div>
<script type="text/javascript">js_sistema.init(); js_sistema.selects()</script>