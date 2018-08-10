<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<?php $rows = preguntaEtaController::setPreguntaEta($_REQUEST['id']) ?>
<div class="row m-form__group">
    <div class="col-lg-12 form-group ">
        <input type="hidden" name="update_pregunta" value="1">
        <input type="hidden" name="id" value="<?php sistema::imprimir($rows[0]) ?>">
        <input type="hidden" id="curso" value="<?php sistema::imprimir($rows[2]) ?>">
        <select class="form-control m-input m-input--air select2Curso" name="curso" style="width: 100%">
            <option value=""></option>
        </select>
    </div>
</div>
<div class="row m-form__group">
    <div class="col-lg-6 form-group ">
        <select class="form-control select2Eta" name="eta" style="width: 100%">
            <option value=""></option>
            <option value="1" <?php if($rows[3] == 1) sistema::imprimir('selected') ?> >ETA I</option>
            <option value="2" <?php if($rows[3] == 2) sistema::imprimir('selected') ?> >ETA II</option>
        </select>

    </div>
    <div class="col-lg-6 form-group">
        <input type="text" class="form-control m-input m-input--air upper" name="cantidad" value="<?php sistema::imprimir($rows[4]) ?>">
    </div>
</div>
<script type="text/javascript">js_sistema.init(); js_sistema.selects()</script>