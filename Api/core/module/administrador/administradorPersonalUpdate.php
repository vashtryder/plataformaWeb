<?php include_once '../../../conf.ini.php' ?>
<?php $rows = gestorPersonal::set_personal($_REQUEST['id']) ?>
<?php $row1 = gestorUsuario::set_login_personal($_REQUEST['id']) ?>
<?php $valor = ($_REQUEST['valor'] == 0) ? 'disabled' : '';?>
<?php $name = ($_REQUEST['valor'] == 0) ? 'idcolegio': ''; ?>

<?php  echo $_REQUEST['valor'] ?>
<div class="form-group m-form__group row">
    <div class="col-lg-5">
        <label class="">Institucion Educativa:</label>
        <input type="hidden" name="update_personal" value="1">
        <input type="hidden" name="id" value="<?php sistema::imprimir($rows[0]) ?>">
        <input type="hidden" id="idcolegio" value="<?php sistema::imprimir($rows[1]) ?>" name="<?php sistema::imprimir($name) ?>" >
        <select class="form-control m-input m-input--air select2Colegio" name="idcolegio" style="width: 100%" <?php sistema::imprimir($valor) ?> ></select>
    </div>
    <div class="col-lg-3">
        <label class="">Modulo:</label>
        <input type="hidden" name="idlogin" value="<?php sistema::imprimir($row1[0]) ?>">
        <input type="hidden" id="idmodulo" value="<?php sistema::imprimir($row1[2]) ?>" >
        <select class="form-control m-input m-input--air select2Modulo" name="idmodulo" style="width: 100%" <?php sistema::imprimir($valor) ?> ></select>
    </div>
    <div class="col-lg-4">
        <label class="">Nombres:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="text" class="form-control m-input m-input--air m-upper" name="nombre" value="<?php sistema::imprimir($rows[5]) ?>">
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-user"></i></span></span>
        </div>
    </div>
</div>
<div class="form-group m-form__group row">
    <div class="col-lg-3">
        <label>Apellido Paterno:</label>
            <div class="m-input-icon m-input-icon--right">
                <input type="text" class="form-control m-input m-input--air m-upper" name="paterno" value="<?php sistema::imprimir($rows[3]) ?>">
                <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-user"></i></span></span>
            </div>
        </div>
        <div class="col-lg-3">
            <label class="">Apellido Materno:</label>
            <div class="m-input-icon m-input-icon--right">
                <input type="text" class="form-control m-input m-input--air m-upper" name="materno" value="<?php sistema::imprimir($rows[4]) ?>">
                <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-user"></i></span></span>
            </div>
        </div>
        <div class="col-lg-3">
            <label>DNI:</label>
            <div class="m-input-icon m-input-icon--right">
                <input type="text" class="form-control m-input m-input--air" name="dni" value="<?php sistema::imprimir($rows[6]) ?>">
                <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-address-card"></i></span></span>
            </div>
        </div>
        <div class="col-lg-3">
            <label>Fecha Nacimiento</label>
            <div class="m-input-icon m-input-icon--right">
                <input type="text" class="form-control m_datepicker m-input m-input--air" readonly="" name="fecnac" value="<?php sistema::imprimir($rows[12]) ?>">
                <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-calendar"></i></span></span>
            </div>
        </div>
    </div>
</div>
<div class="form-group m-form__group row">

    <div class="col-lg-3">
        <label>Telefeno y/o Celular:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="text" class="form-control m-input m-input--air" name="telefono1" value="<?php sistema::imprimir($rows[10]) ?>">
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-phone"></i></span></span>

        </div>
    </div>
    <div class="col-lg-3">
        <label>Telefeno y/o Celular:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="text" class="form-control m-input m-input--air" name="telefono2" value="<?php sistema::imprimir($rows[11]) ?>">
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-phone"></i></span></span>

        </div>
    </div>
    <div class="col-lg-6">
        <label>Correo:</label>
        <div class="m-input-icon m-input-icon--right">
            <input type="text" class="form-control m-input m-input--air" name="correo" value="<?php sistema::imprimir($rows[8]) ?>">
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-envelope-square"></i></span></span>

        </div>
    </div>
</div>
<div class="form-group m-form__group row">
    <div class="col-lg-4">
        <label>Sexo:</label>
        <div class="m-input-icon m-input-icon--right">
            <div class="m-radio-inline">
                <label class="m-radio">
                <input type="radio" name="sexo" <?php if($rows[7] == 1) sistema::imprimir('checked') ?> value="1"> Masculino
                <span></span>
                </label>
                <label class="m-radio">
                <input type="radio" name="sexo" <?php if($rows[7] == 2) sistema::imprimir('checked') ?> value="2"> Femenino
                <span></span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <label>Direccion</label>
        <div class="m-input-icon m-input-icon--right">
            <textarea class="form-control m-input m-input--air" rows="2" name="direccion" placeholder="Av|Lt|Jr|Calle|Urbanización"><?php sistema::imprimir($rows[9]) ?></textarea>
            <span class="m-input-icon__icon m-input-icon__icon--right m-input--air m-upper"><span><i class="fa fa-map-marker"></i></span></span>
        </div>
    </div>


</div>
<script type="text/javascript">js_sistema.init()</script>