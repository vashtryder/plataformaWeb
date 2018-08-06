<?php include_once '../../../conf.ini.php' ?>
<?php $rows = gestorSemana::set_semana($_POST['id']) ?>

<div class="form-group m-form__group row">
     <div class="col-lg-12">
        <input type="hidden" name="update_semana" value="1">
        <input type="hidden" name="id" value="<?php sistema::imprimir($rows[0]) ?>">
        <input type="text" class="form-control m-input m-input m-upper" name="nombre" placeholder="INGRESE NOMBRE SEMANA ETA" value="<?php sistema::imprimir($rows[3]) ?>">
    </div>
</div>

<div class="form-group m-form__group row">
     <div class="col-lg-12">
        <input type="hidden" id="unidad" name="unidad" value="<?php sistema::imprimir($rows[1]) ?>">
        <select class="form-control m-input m-input--air select2Periodo" name="unidad">
            <option value="">SELECCIONE UNIDAD</option>
        </select>
    </div>
</div>

<div class="form-group m-form__group row">
    <div class="col-md-6">
        <input type="text" class="form-control m-input m-input--air m_datepicker" name="fechaini" placeholder="FECHA INICIO" value="<?php sistema::imprimir($rows[4]) ?>">
    </div>
    <div class="col-md-6">
        <input type="text" class="form-control m-input m-input--air m_datepicker" name="fechafin" placeholder="FECHA FINAL" value="<?php sistema::imprimir($rows[5]) ?>">
    </div>
</div>
<script type="text/javascript">js_sistema.init();</script>