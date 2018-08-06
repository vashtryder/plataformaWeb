<?php include_once '../../../conf.ini.php' ?>
<div class="form-group m-form__group">
    <input type="hidden" name="new_horario" value="1">
    <input type="hidden" name="idanio" value="<?php sistema::imprimir($_SESSION['anio'][0]) ?>">
    <select class="form-control m-input m-input--air select2Colegio" name="colegio" style="width: 100%" onchange="js_sistema.paraElegirDocente()">
        <option value="">SELECCIONE COLEGIO</option>
    </select>
</div>

<div class="form-group m-form__group">
    <select class="form-control m-input m-input--air select2Docente" name="docente" style="width: 100%">
        <option value="">SELECCIONE DOCENTE</option>
    </select>
</div>

<div class="form-group m-form__group">
    <select class="form-control m-input m-input--air select2Curso" name="curso" style="width: 100%">
        <option value="">SELECCIONE CURSO </option>
    </select>
</div>

<div class="form-group m-form__group">
    <select class="form-control m-input m-input--air select2Grado" name="grado" style="width: 100%">
        <option value="">SELECCIONE GRADO</option>
    </select>
</div>

<div class="form-group m-form__group">
    <select class="form-control m-input m-input--air select2Seccion" name="seccion" style="width: 100%">
        <option value="">SELECCIONE GRADO</option>
    </select>
</div>

<div class="form-group m-form__group">
    <select class="form-control m-input m-input--air select2Nivel" name="nivel" style="width: 100%">
        <option value="">SELECCIONE NIVEL</option>
    </select>
</div>
<script type="text/javascript">js_sistema.selects()</script>