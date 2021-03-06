<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<?php $rows = tutorController::setTutor($_REQUEST['id']); ?>
<div class="form-group m-form__group">
    <input type="hidden" name="update_tutor" value="1">
    <input type="hidden" name="id" value="<?php sistema::imprimir($rows[0]) ?>">
    <input type="hidden" id="colegio" value="<?php sistema::imprimir($rows[1]) ?>">
    <select class="form-control m-input m-input--air select2Colegio" name="colegio" style="width: 100%" onchange="js_sistema.paraElegirDocente()"></select>
</div>
<div class="form-group m-form__group">
    <input type="hidden" id="docente" value="<?php sistema::imprimir($rows[3]) ?>">
    <select class="form-control m-input m-input--air select2-Docente" name="docente" style="width: 100%"></select>
</div>

<div class="form-group m-form__group">
    <input type="hidden" id="grado" value="<?php sistema::imprimir($rows[4]) ?>">
    <select class="form-control m-input m-input--air select2Grado" name="grado" style="width: 100%"></select>
</div>

<div class="form-group m-form__group">
    <input type="hidden" id="seccion" value="<?php sistema::imprimir($rows[5]) ?>">
    <select class="form-control m-input m-input--air select2Seccion" name="seccion" style="width: 100%"></select>
</div>

<div class="form-group m-form__group">
    <input type="hidden" id="nivel" value="<?php sistema::imprimir($rows[6]) ?>">
    <select class="form-control m-input m-input--air select2Nivel" name="nivel" style="width: 100%"></select>
</div>
<script type="text/javascript"></script>