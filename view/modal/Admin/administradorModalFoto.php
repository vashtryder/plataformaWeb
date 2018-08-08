<?php include_once '../../../Api/core/ControladorBase.php' ?>
<?php include_once '../../../Api/config/sistema.php' ?>
<?php include_once '../../../Api/config/global.php' ?>
<center>
<input type="hidden" name="avatar_token" value="<?php sistema::imprimir($_SESSION['modulo'][0])?>">
<input type="hidden" name="id" value="<?php sistema::imprimir($_SESSION['user'][0])?> ">
<div class="fileinput fileinput-new" data-provides="fileinput">
    <div class="fileinput-new thumbnail" >
        <img src="<?php sistema::imprimir(ROOT_IMG_PERSONAL . $_SESSION['user'][9]) ?>" alt="" class="fotografia" style="width: 200px; height: 200px;"/>
    </div>
    <div class="fileinput-preview fileinput-exists thumbnail"> </div>
    <div>
        <span class="btn btn-outline-primary btn-file">
            <span class="fileinput-new"> Seleccionar </span>
            <span class="fileinput-exists"> Seleccionar </span>
            <input type="file" name="foto"> </span>
        <a href="javascript:;" class="btn btn-outline-danger fileinput-exists" data-dismiss="fileinput"> Eliminar </a>
    </div>
</div>
</center>