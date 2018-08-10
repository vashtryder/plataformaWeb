<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <input type="hidden" name="update_evento" value="1">
        <label>Titulo</label>
        <input type="hidden" name="id" class="eventid" id="eventid">
        <input type="text" class="form-control m-input m-input--air m-upper eventInfo" name="title"  placeholder="TITULO">
    </div>
</div>

<div class="form-group m-form__group row">

    <div class="col-lg-6">
        <label>Fecha Comienzo</label>
        <input type="text" class="form-control m_datepicker m-input m-input--air startTime" name="start" placeholder="FECHA INICIO" >
    </div>
    <div class="col-lg-6">
        <label>Fecha Final</label>
        <input type="text" class="form-control m_datepicker m-input m-input--air endTime"  name="end" placeholder="FECHA FIN" >
    </div>
</div>

<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label>Adjuntar Archivo</label>
        <input type="file" class="form-control m-input m-input--air" name="file">
    </div>
</div>

<script type="text/javascript">js_sistema.init()</script>