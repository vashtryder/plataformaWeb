<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<div class="row m-form__group">
    <div class="col-lg-12 form-group">
        <label for="">CURSO ACADÉMICO</label>
        <input type="hidden" name="new_pregunta" value="1">
        <input type="hidden" name="idanio" value="<?php sistema::imprimir($_SESSION['anio'][0]) ?>">
        <select class="form-control m-input m-input--air select2Curso" name="curso" style="width: 100%">
            <option value=""></option>
        </select>
    </div>
</div>
<div class="row m-form__group">
    <div class="col-md-6 form-group">
        <label>GRUPO ETA</label>
        <select class="form-control select2Eta" name="eta" style="width: 100%">
            <option value=""></option>
            <option value="1">ETA I</option>
            <option value="2">ETA II</option>
        </select>
    </div>
    <div class="col-md-6 form-group">
        <label>CANTIDAD</label>
        <input type="text" class="form-control m-input m-input--air upper" name="cantidad">
    </div>
</div>
<script type="text/javascript">js_sistema.init(); js_sistema.selects()</script>