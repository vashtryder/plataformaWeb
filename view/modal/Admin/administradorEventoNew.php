
<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <input type="hidden" name="new_evento" value="1">
        <label>Titulo</label>
        <input type="text" class="form-control m-input m-input--air m-upper" name="title" placeholder="TITULO">
    </div>
</div>

<div class="form-group m-form__group row">
    <div class="col-lg-12">
       <div class="input-daterange input-group m_datepicker">
            <input type="text" class="form-control m-input startTime" name="start">
            <div class="input-group-append">
                <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
            </div>
            <input type="text" class="form-control endTime" name="end">
        </div>
    </div>
</div>

<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label>Adjuntar Archivo</label>
        <input type="file" class="form-control m-input m-input--air" name="file">
    </div>
</div>
<script type="text/javascript">js_sistema.init()</script>