<?php include_once '../../../conf.ini.php' ?>
<?php $rows = gestorItem::set_item($_POST['id']) ?>
<div class="form-group m-form__group row">
    <div class="col-md-6">
        <input type="hidden" name="update_item" value="1">
        <input type="hidden" name="id" value="<?php sistema::imprimir($rows[0]) ?>">
        <input type="text" class="form-control m-input m-input--air m-upper" name="nombre" placeholder="INGRESE TITULO ITEM" value="<?php sistema::imprimir($rows[2]) ?>">
    </div>
    <div class="col-md-6">
        <input type="hidden" id="idProceso" value="<?php sistema::imprimir($rows[1]) ?>">
        <select class="form-control m-input m-input--air select2Proceso" name="proceso" style="width: 100%"></select>
    </div>
</div>
<div class="form-group m-form__group row">
    <div class="col-md-12">
        <textarea class="form-control m-input m-input--air summernote" name="item"><?php sistema::imprimir($rows[3]) ?></textarea>
    </div>
</div>
<script type="text/javascript">js_sistema.init()</script>