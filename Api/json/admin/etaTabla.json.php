<?php include_once '../../core/ControladorBase.php' ?>
<?php include_once "../../config/sistema.php" ?>;
<?php $rs_tb = fichaEtaController::getFichaEtaTabla(); ?>
<?php $rs_sm = semanaEtaController::getSemanaEtaFecha(date('Y-m-d')); ?>
<?php $num = 0; ?>
<?php foreach ($rs_tb as $row_t){   ?>
	<?php $rs_g  = fichaEtaController::getFichaEtaGrado($row_t[0]); ?>
	<?php $rs_s  = fichaEtaController::getFichaEtaSeccion($row_t[0]); ?>
	<?php $rs_n  = fichaEtaController::getFichaEtaNivel($row_t[0]); ?>
	<?php $row_g = gradoController::setGrado($rs_g[0]); ?>
	<?php $row_n = nivelController::setNivel($rs_n[0]); ?>
    <?php $num++; ?>

    <form class="m-form" id="calificarEta_<?php sistema::imprimir($num);?>">
        <div class="form-group m-form__group row text-center" >
            <div class="col-lg-1">
                <label>#</label>
                <label><?php sistema::imprimir($num) ?></label>
                <input type="hidden" name="new_registro" value="1">
                 <input type="hidden" name="tabla" value="<?php sistema::imprimir($row_t[0]);?>">
                <input type="hidden" name="grado" value="<?php sistema::imprimir($rs_g[0]);?>">
                <input type="hidden" name="nivel" value="<?php sistema::imprimir($rs_n[0]);?>">
                <input type="hidden" name="semana" value="<?php sistema::imprimir($rs_sm[0]);?>">
                <input type="hidden" name="anio" value="<?php sistema::imprimir($_SESSION['anio'][0]) ?>">
            </div>
            <div class="col-lg-2">
                <label>
                    <b><?php sistema::imprimir($row_g[1]."<br>".$row_n[1]) ?></b>
                </label>
            </div>

            <div class="col-lg-2">
                <?php foreach ($rs_s as $rows) { ?>
					<?php $row_s  = seccionController::setSeccionAcademico($rows[0]); ?>
					<?php $row_gr = registroEtaController::getRegistroEtaGrupoAula(array($row_g[0],$row_s[0],$row_n[0],$_SESSION['anio'][0])); #grupo_aula_eta ?>
					<?php $row_se = fichaEtaController::getFichaEtaCantidad(array($row_t[0],$rows[0])); ?>
                    <?php  ?>
                    <input type="hidden" name="grupo[]" value="<?php sistema::imprimir($row_gr[0]);?>">
                    <input type="hidden" name="seccion[]" value="<?php sistema::imprimir($rows[0]);?>">

                    <input type="hidden" name="g[]" value="<?php sistema::imprimir($row_g[0]);?>">
                    <input type="hidden" name="s[]" value="<?php sistema::imprimir($row_s[0]);?>">
                    <input type="hidden" name="n[]" value="<?php sistema::imprimir($row_n[0]);?>">

                    <label>
                        <span class="m-badge m-badge--success m-badge--wide">
                            <?php sistema::imprimir($row_se[0]) ?>
                        </span>
                        <?php sistema::imprimir(" FICHA(S) - <b>".$row_s[1]."</b>") ?>
                    </label>
                    <br>
                <?php }?>
            </div>

            <div class="col-lg-2">
                <label>
                    <b><?php sistema::imprimir($rs_sm[3]) ?></b>
                </label>
            </div>

            <div class="col-lg-1">
                <label>
                    <b><?php sistema::imprimir($row_gr[6]) ?></b>
                </label>
            </div>
            <div class="col-lg-3">
                 <select class="form-control m-input m-input--air select2Colegio" name="colegio" style="width: 100%" onchange="js_sistema.paraElegirDocente()">
                    <option value="">SELECCIONE COLEGIO</option>
                </select>
            </div>

            <div class="col-lg-1">
                <a onclick="js_eta.calificarSubmit(<?php sistema::imprimir($num);?>)" class="btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only" data-container="body" data-toggle="m-popover" data-placement="top" data-content="CALIFICAR FICHAS"><i class="fa fa-edit"></i></a>
                <a onclick="js_eta.eliminarSubmit(<?php sistema::imprimir($num);?>)" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only" data-container="body" data-toggle="m-popover" data-placement="top" data-content="ELIMINAR FICHAS"><i class="fa fa-trash"></i></a>
            </div>
        </div>
    </form>
    <hr>
<?php } ?>