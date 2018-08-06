<?php include_once '../../../conf.ini.php' ?>
<center>
<input type="hidden" name="avatar_estudiante" value="1">
<input type="hidden" name="id" value="<?php sistema::imprimir($_REQUEST['id'])?>">
<div class="fileinput fileinput-new" data-provides="fileinput">
    <div class="fileinput-new thumbnail" >
        <img src="view/img/estudiante/<?php sistema::imprimir($_REQUEST['foto'])?>" alt="" class="fotografia" style="width: 200px; height: 200px;"/>
    </div>
    <div class="fileinput-preview fileinput-exists thumbnail"> </div>
    <div>
        <span class="btn btn-outline-primary btn-file">
            <span class="fileinput-new"> Seleccionar </span>
            <span class="fileinput-exists"> Seleccionar </span>
            <input type="file" name="avatar"> </span>
        <a href="javascript:;" class="btn btn-outline-danger fileinput-exists" data-dismiss="fileinput"> Eliminar </a>
    </div>
</div>
</center>