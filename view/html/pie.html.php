<div class="modal fade" id="m-modalDatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR DATOS PERSONALES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="m-form m-form--label-align-right">
                <div class="modal-body">
                    <div id="m_modal_datos"></div>
                </div>
                <div class="modal-footer">
                    <button id="btn-submit-user" class="btn btn btn-outline-primary">Actualizar</button>
                    <button id="btn-cancel-user" class="btn btn-outline-metal" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="m-modalSignIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CAMBIAR CONTRASE&Ntilde;A</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="m-form m-form--label-align-right">
                <div class="modal-body">
                    <div id="m_modal_SignIn"></div>
                </div>
                <div class="modal-footer">
                    <button id="btn-submit-password" type="button" class="btn btn-outline-primary">Cambiar</button>
                    <button id="btn-cancel-password" type="button" class="btn btn-outline-metal" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="m-modalAvatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CAMBIAR FOTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="from-foto">
                <div class="modal-body">
                    <div id="m_modal_avatar"></div>
                </div>
                <div class="modal-footer">
                    <button id="btn-submit-avatar" type="button" class="btn btn-outline-primary">Cambiar</button>
                    <button id="btn-cancel-avatar" type="button" class="btn btn-outline-metal" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="m-modalMensaje"  role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ENVIAR MENSAJE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
           <form id="m-Notificacion">
                <div class="modal-body">
                    <div id="m_modal_Mensaje"></div>
                </div>
                <div class="modal-footer">
                    <button id="btn-submit-mensaje" type="button" class="btn btn-outline-primary">Enviar</button>
                    <button id="btn-cancel-mensaje" type="button" class="btn btn-outline-metal" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="m-modalSoporte"  role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SOPORTE TECNICO RAPIDO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
           <form enctype="multipart/form-data" id="m-Soporte">
                <div class="modal-body">
                    <div id="m_modal_soporte"></div>
                </div>
                <div class="modal-footer">
                    <button id="btn-submit-soporte" type="button" class="btn btn-outline-primary">Enviar</button>
                    <button id="btn-cancel-soporte" type="button" class="btn btn-outline-metal" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="m-modalFaq"  role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PREGUNTAS & RESPUESTAS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
            </div>
           <form enctype="multipart/form-data" id="m-Faq">
                <div class="modal-body">
                    <div id="m_modal_Faq"></div>
                </div>
                <div class="modal-footer">
                    <button id="btn-submit-faq" type="button" class="btn btn-outline-primary">Enviar</button>
                    <button id="btn-cancel-faq" type="button" class="btn btn-outline-metal" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>



        </div>
        <!-- end:: Page -->


    <!-- begin::Quick Nav -->
    <!--begin::Base Scripts -->
    <script src="assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
    <script src="assets/base/scripts.bundle.js" type="text/javascript"></script>
    <!--end::Base Scripts -->

    <script src="assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
    <script src="assets/vendors/custom/fullcalendar/locale/es.js" type="text/javascript"></script>
    <script src="assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>

    <!--begin::Page Vendors -->

    <script src="view/js/sistema.js" type="text/javascript"></script>

    <?php
        switch ($_REQUEST['s']) {
             case 'direccionPerfil':
             case 'tutorProceso':

                print_r('<script src="view/js/director/profile.js" type="text/javascript"></script>');
                break;

            case 'tutorListaEstudiante':
            case 'reporteGrado':
            case 'tutorPerfil':
            case 'reporteAula':
            case 'reporteMerito':
            case 'reporteRespuesta':
            case 'reporteEstudiante':
            case 'reporteGrupo':
            case 'tutorSabana':
            case 'tutorCuadro':
            case 'direccionMatricula':
            case 'tutorSemana':
            case 'direccionSemana':

                print_r('<script src="view/js/director/profile.js" type="text/javascript"></script>');
                print_r('<script src="view/js/director/estudiante.js" type="text/javascript"></script>');
                print_r('<script src="view/js/tutor/tutor.js" type="text/javascript"></script>');

                break;

            case 'direccionAsignacion':
                print_r('<script src="view/js/director/asignacion.js" type="text/javascript"></script>');
                print_r('<script src="view/js/director/profile.js" type="text/javascript"></script>');
                break;

            case 'direccionInstitucion':
                print_r('<script src="view/js/director/institucion.js" type="text/javascript"></script>');
                print_r('<script src="view/js/director/profile.js" type="text/javascript"></script>');
                break;

            case 'direccionDocente':
            case 'direccionUsuario':
            case 'direccionMensaje':
            case 'tutorDocente':
            case 'tutorMensajes':
                print_r('<script src="view/js/director/personal.js" type="text/javascript"></script>');
                print_r('<script src="view/js/director/profile.js" type="text/javascript"></script>');
                break;

            case 'direccionImportarEstudiante':
            case 'administradorImportarEstudiante':
            case 'administradorImportarDocente':
            case 'administradorRespuesta':
                print_r('<script src="view/js/administrador/importar.js" type="text/javascript"></script>');
                print_r('<script src="view/js/director/profile.js" type="text/javascript"></script>');
            break;

            case 'tutorHistoria':
                print_r('<script src="view/js/tutor/historia.js" type="text/javascript"></script>');
                print_r('<script src="view/js/director/profile.js" type="text/javascript"></script>');
            break;

            case 'administradorInstitucion':
                print_r('<script src="view/js/administrador/institucion.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
            break;

            case 'administradorMatricula':
                print_r('<script src="view/js/administrador/estudiante.js" type="text/javascript"></script>');
            break;

            case 'administradorAsignacion':
                print_r('<script src="view/js/administrador/asignacion.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
                break;

            case 'administradorGrado':
                print_r('<script src="view/js/administrador/grado.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
                break;

            case 'administradorSeccion':
                print_r('<script src="view/js/administrador/seccion.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
                break;

            case 'administradorNivel':
                print_r('<script src="view/js/administrador/nivel.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
                break;

            case 'administradorPeriodo':
                print_r('<script src="view/js/administrador/periodo.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
                break;

            case 'administradorArea':
                print_r('<script src="view/js/administrador/area.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
                break;

            case 'administradorCurso':
                print_r('<script src="view/js/administrador/curso.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
                break;
            case 'administradorDireccion':
            case 'administradorTutor':
            case 'administradorPadre':
                print_r('<script src="view/js/administrador/user.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
            break;

            case 'administradorProceso':
                print_r('<script src="view/js/administrador/proceso.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
                break;

            case 'administradorItem':
                print_r('<script src="view/js/administrador/item.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
            break;

            case 'direccionLogin':
                print_r('<script src="view/js/director/login.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
            break;

            case 'administradorLogin':
                print_r('<script src="view/js/administrador/login.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
            break;

            case 'administradorAnio':
                print_r('<script src="view/js/administrador/anio.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
            break;

            case 'administradorDocente':
            case 'administradorDatos':
            case 'administradorMensaje':
            case 'administradorPersonal':
                print_r('<script src="view/js/administrador/personal.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
            break;

            case 'padreLogin':
                print_r('<script src="view/js/padre/login.js" type="text/javascript"></script>');
                print_r('<script src="view/js/padre/profile.js" type="text/javascript"></script>');
            break;

            case 'administradorHorario':
                print_r('<script src="view/js/administrador/horario.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
                break;

            case 'direccionHorario':
                print_r('<script src="view/js/director/horario.js" type="text/javascript"></script>');
                print_r('<script src="view/js/director/profile.js" type="text/javascript"></script>');
                break;

            case 'tutorSemanaEta':
                print_r('<script src="view/js/tutor/semana.js" type="text/javascript"></script>');
                print_r('<script src="view/js/tutor/profile.js" type="text/javascript"></script>');
                break;

            case 'administradorSemanaEta':
                print_r('<script src="view/js/administrador/semana.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
                break;
            case 'administradorPreguntaEta':
                print_r('<script src="view/js/administrador/pregunta.js" type="text/javascript"></script>');
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
            break;

            case 'administradorCalificacion':
                print_r('<script src="view/js/administrador/registroEta.js" type="text/javascript"></script>');
            break;

            case 'administradorEvento':
                print_r('<script src="view/js/administrador/evento.js" type="text/javascript"></script>');
            break;

            case 'administradorPerfil':
                print_r('<script src="view/js/administrador/profile.js" type="text/javascript"></script>');
            break;

            default:
                print_r('<script src="view/js/director/login.js" type="text/javascript"></script>');
                break;
        }
    ?>


    <!--end::Page Vendors -->


    <!--begin::Page Snippets -->
    <script src="assets/custom/fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="assets/custom/bootbox/bootbox.min.js" type="text/javascript"></script>
    <!--end::Page Snippets -->

    <script type="text/javascript">

        $(window).on('load', function() {
            $('body').removeClass('m-page--loading');
        });

        <?php if($_REQUEST['token'] == 'singOut'){ ?>
            var mesagge = "<?php sistema::imprimir($_SESSION['user'][2]." ".$_SESSION['user'][3]."".$_SESSION['user'][4]); ?>";
            js_sistema.showErrorMsg(mesagge + ", HASTA PRONTO",'success');

            var valor = <?php sistema::imprimir($_SESSION["modulo"][0]) ?>;

            switch(valor){
                case 1:
                    link = "administradorLogin";
                break;
                case 2: case 3:
                    link = "";
                break;
                case 4:
                    link = "padreLogin";
                break;
            }

            setTimeout(function() {
                window.location='?s='+link;
                $_SESSION = array();
                session_destroy();
            },2000);

        <?php

        } ?>
    </script>
</body>
</html>