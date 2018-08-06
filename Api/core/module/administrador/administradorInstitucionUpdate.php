    <?php include_once '../../../conf.ini.php' ?>
    <?php $rows = gestorColegio::set_colegio($_REQUEST['id']);?>

    <div class="form-group m-form__group row">
        <div class="col-lg-8">
            <label>Nombre:</label>
            <div class="m-input-icon m-input-icon--right">
                <input type="hidden" name="update_colegio" value="1">
                <input type="hidden" name="id" value="<?php sistema::imprimir($rows[0]) ?>">
                <input type="email" class="form-control m-input m-input--air m-upper" name="nombre" value="<?php sistema::imprimir($rows[1]) ?>">
                <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-university"></i></span></span>
            </div>
        </div>
        <div class="col-lg-4">
            <label class="">Acronimo:</label>
            <div class="m-input-icon m-input-icon--right">
                <input type="email" class="form-control m-input m-input--air m-upper" name="acronimo" value="<?php sistema::imprimir($rows[5]) ?>">
                <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-ellipsis-h"></i></span></span>
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-12">
            <label>Dirección</label>
            <div class="m-input-icon m-input-icon--right">
                <textarea class="form-control m-input m-input--air m-upper" rows="4" name="direccion" placeholder="Av|Lt|Jr|Calle|Urbanización" ><?php sistema::imprimir($rows[2]) ?></textarea>
                <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-map-marker"></i></span></span>
            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-6">
            <label>Correo Principal:</label>
            <div class="m-input-icon m-input-icon--right">
                <input type="text" class="form-control m-input m-input--air" name="correo" value="<?php sistema::imprimir($rows[9]) ?>">
                <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-envelope-square"></i></span></span>

            </div>
        </div>
        <div class="col-lg-3">
            <label>Telefeno y/o Celular:</label>
            <div class="m-input-icon m-input-icon--right">
                <input type="text" class="form-control m-input m-input--air" name="telefono1" value="<?php sistema::imprimir($rows[3]) ?>">
                <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-phone"></i></span></span>

            </div>
        </div>
        <div class="col-lg-3">
            <label>Telefeno y/o Celular:</label>
            <div class="m-input-icon m-input-icon--right">
                <input type="text" class="form-control m-input m-input--air" name="telefono2" value="<?php sistema::imprimir($rows[4]) ?>">
                <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-phone"></i></span></span>

            </div>
        </div>
    </div>
    <div class="form-group m-form__group row">
        <div class="col-lg-4">
            <label>WebSite Principal:</label>
            <div class="m-input-icon m-input-icon--right">
                <input type="email" class="form-control m-input m-input--air" name="website" value="<?php sistema::imprimir($rows[6]) ?>">
                <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-chain"></i></span></span>

            </div>
        </div>
        <div class="col-lg-4">
            <label>Facebook:</label>
            <div class="m-input-icon m-input-icon--right">
                <input type="text" class="form-control m-input m-input--air" name="facebook" value="<?php sistema::imprimir($rows[7]) ?>">
                <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-facebook-square"></i></span></span>
            </div>
        </div>
        <div class="col-lg-4">
            <label>Youtube:</label>
            <div class="m-input-icon m-input-icon--right">
                <input type="text" class="form-control m-input m-input--air" name="youtube" value="<?php sistema::imprimir($rows[8]) ?>">
                <span class="m-input-icon__icon m-input-icon__icon--right m-input--air"><span><i class="fa fa-youtube-square"></i></span></span>
            </div>
        </div>
    </div>
    <script type="text/javascript">js_sistema.init()</script>