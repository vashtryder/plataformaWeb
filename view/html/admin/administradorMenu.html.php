
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <!-- begin::Header -->
            <<header id="m_header" class="m-grid__item m-header"  m-minimize="minimize" m-minimize-mobile="minimize" m-minimize-offset="10" m-minimize-mobile-offset="10" >
                <div class="m-header__top">
                    <div class="m-container m-container--fluid m-container--full-height m-page__container">
                        <div class="m-stack m-stack--ver m-stack--desktop">
                            <!-- begin::Brand -->
                            <div class="m-stack__item m-brand m-stack__item--left">
                                <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                        <a href="index.html" class="m-brand__logo-wrapper">
                                            <img alt="" src="view/img/logo/logo360_menu.png" class="m-brand__logo-desktop" style="width: 40%" />
                                            <img alt="" src="view/img/logo/logo360_menu.png" class="m-brand__logo-mobile" style="width: 150px" />
                                        </a>
                                    </div>
                                    <div class="m-stack__item m-stack__item--middle m-brand__tools">
                                        <!-- begin::Responsive Header Menu Toggler-->
                                        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                            <span></span>
                                        </a>
                                        <!-- end::Responsive Header Menu Toggler-->
                                        <!-- begin::Topbar Toggler-->
                                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                            <i class="flaticon-more"></i>
                                        </a>
                                        <!--end::Topbar Toggler-->
                                    </div>
                                </div>
                            </div>
                            <!-- end::Brand -->
                <!-- begin::Topbar -->
                            <div class="m-stack__item m-stack__item--right m-header-head" id="m_header_nav">
                                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                                    <div class="m-stack__item m-topbar__nav-wrapper">
                                        Hola, <?php sistema::imprimir($_SESSION["user"][4]) ?>

                                        <ul class="m-topbar__nav m-nav m-nav--inline">

                                            <li class="m-nav__item m-nav__item--accent m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center  m-dropdown--mobile-full-width" m-dropdown-toggle="click" data-dropdown-persistent="true">
                                                <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                                                    <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
                                                    <span class="m-nav__link-icon">
                                                        <span class="m-nav__link-icon-wrapper">
                                                            <i class="flaticon-music-2"></i>
                                                        </span>
                                                    </span>
                                                </a>
                                                <div class="m-dropdown__wrapper">
                                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                                    <div class="m-dropdown__inner">
                                                        <div class="m-dropdown__header m--align-center">
                                                            <span class="m-dropdown__header-title">
                                                                <label class="m-recibido">0</label> Nuevos
                                                            </span>
                                                            <span class="m-dropdown__header-subtitle">
                                                                Mensajes
                                                            </span>
                                                        </div>
                                                        <div class="m-dropdown__body">
                                                            <div class="m-dropdown__content">
                                                                <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
                                                                    <li class="nav-item m-tabs__item">
                                                                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">
                                                                            Alerta
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <div class="tab-content">
                                                                    <div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
                                                                        <div class="m-scrollable" data-scrollable="true" data-max-height="250" data-mobile-max-height="200">
                                                                            <div class="m-list-timeline m-list-timeline--skin-light">
                                                                                <div class="m-list-timeline__items">
                                                                                    <?php $rsn = gestorMensaje::set_mensaje_recibido(array($_SESSION['colegio'][0],$_SESSION['user'][0])) ?>
                                                                                    <?php foreach ($rsn as $rows_m) {?>
                                                                                       <div class="m-list-timeline__item">
                                                                                            <span class="m-list-timeline__badge"></span>
                                                                                            <span class="m-list-timeline__text">
                                                                                                <?php sistema::imprimir(sistema::substr($rows_m[8],15).'...') ?>
                                                                                                <?php if($rows_m[5] == 0){ ?>
                                                                                                     <span class="m-badge m-badge--success m-badge--wide">Pendiente</span>
                                                                                                <?php } ?>
                                                                                            </span>
                                                                                            <span class="m-list-timeline__time">
                                                                                                <?php sistema::imprimir(sistema::imprimirTiempoCorto($rows_m[6],$rows_m[7])) ?>
                                                                                            </span>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="m-nav__item m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                                                <a href="#" class="m-nav__link m-dropdown__toggle">
                                                    <span class="m-topbar__userpic">
                                                        <img src="" class="m--img-rounded m--marginless m--img-centered fotografia" alt=""/>
                                                    </span>
                                                    <span class="m-nav__link-icon m-topbar__usericon  m--hide">
                                                        <span class="m-nav__link-icon-wrapper">
                                                            <i class="flaticon-user-ok"></i>
                                                        </span>
                                                    </span>
                                                    <span class="m-topbar__username m--hide">
                                                        <?php sistema::imprimir($_SESSION["user"][4]) ?>
                                                    </span>
                                                </a>
                                                <div class="m-dropdown__wrapper">
                                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                                    <div class="m-dropdown__inner">
                                                        <div class="m-dropdown__header m--align-center">
                                                            <div class="m-card-user m-card-user--skin-light">
                                                                <div class="m-card-user__pic">
                                                                    <img src="" class="m--img-rounded m--marginless fotografia" alt=""/>
                                                                </div>
                                                                <div class="m-card-user__details">
                                                                    <span class="m-card-user__name m--font-weight-200 m-nameuser">
                                                                        <?php sistema::imprimir($_SESSION["user"][2]." ".$_SESSION["user"][3]) ?> <br> <?php sistema::imprimir($_SESSION["user"][4]) ?>
                                                                    </span>
                                                                    <a href="" class="m-card-user__email m--font-weight-300 m-link">
                                                                        <?php sistema::imprimir($_SESSION["modulo"][1]) ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="m-dropdown__body">
                                                            <div class="m-dropdown__content">
                                                                <ul class="m-nav m-nav--skin-light">
                                                                    <li class="m-nav__section m--hide">
                                                                        <span class="m-nav__section-text">
                                                                            Section
                                                                        </span>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="#" onclick="js_profile.modalUserUpdateSubmit(1)" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-user-settings"></i>
                                                                            <span class="m-nav__link-title">
                                                                                <span class="m-nav__link-text">
                                                                                    Mis Datos
                                                                                </span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="#" onclick="js_profile.modalSingInUpdateSubmit(1)" class="m-nav__link">
                                                                            <i class="m-nav__link-icon  flaticon-lock-1"></i>

                                                                            <span class="m-nav__link-title">
                                                                                <span class="m-nav__link-text">
                                                                                        Mi Contraseña
                                                                                </span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="#" onclick="js_profile.modalAvatarUpdateSubmit(1)" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                            <span class="m-nav__link-text">
                                                                                Mi Foto
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="#" onclick="js_profile.modaleMessageUpdateSubmit(1)" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                            <span class="m-nav__link-title">
                                                                                <span class="m-nav__link-wrap">
                                                                                    <span class="m-nav__link-text">
                                                                                        Mis Mensajes
                                                                                    </span>
                                                                                    <span class="m-nav__link-badge">
                                                                                        <span class="m-badge m-badge--success m-recibido">
                                                                                        0
                                                                                        </span>
                                                                                    </span>
                                                                                </span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                                    <li class="m-nav__item">
                                                                        <a href="#" onclick="js_profile.modaleFAQUpdateSubmit(1)" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-info"></i>
                                                                            <span class="m-nav__link-text">
                                                                                FAQ
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                                                    <li class="m-nav__item">
                                                                        <a href="?s=administradorPerfil&token=singOut" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                                            Cerrar Sesión
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- end::Topbar -->
                        </div>
                    </div>
                </div>

                <div class="m-header__bottom">
                    <div class="m-container m-container--fluid m-container--full-height m-page__container">
                        <div class="m-stack m-stack--ver m-stack--desktop">
                            <!-- begin::Horizontal Menu -->
                            <div class="m-stack__item m-stack__item--fluid m-header-menu-wrapper">
                                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
                                    <i class="fa fa-close"></i>
                                </button>
                                <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light "  >
                                    <ul class="m-menu__nav  m-menu__nav--submenu-arrow">
                                        <li class="m-menu__item  <?php if($_REQUEST['s'] == 'administradorRespuesta' || $_REQUEST['s'] == 'administradorCalificacion' || $_REQUEST['s'] == 'administradorPerfil' || $_REQUEST['s'] == 'administradorInstitucion') echo 'm-menu__item--active m-menu__item--active-tab' ?> m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
                                            <a  href="?s=administradorCalificacion" class="m-menu__link m-menu__toggle">
                                                <span class="m-menu__link-text">
                                                    COLEGIOS
                                                </span>
                                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </a>
                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                <ul class="m-menu__subnav">

                                                    <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorInstitucion') echo 'm-menu__item--active' ?> m-menu__item--rel m-menu__item--submenu-tabs" m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a  href="?s=administradorInstitucion" class="m-menu__link">
                                                            <i class="m-menu__link-icon fa fa-university"></i>
                                                            <span class="m-menu__link-text">
                                                                INSTITUCIÓN
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorCalificacion') echo 'm-menu__item--active' ?> m-menu__item--rel m-menu__item--submenu-tabs" m-menu-link-redirect="1"  aria-haspopup="true">
                                                        <a  href="?s=administradorCalificacion" class="m-menu__link">
                                                            <i class="m-menu__link-icon fa fa-database"></i>
                                                            <span class="m-menu__link-text">
                                                                CALIFICACIÓN
                                                            </span>
                                                        </a>
                                                    </li>

                                                     <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorRespuesta') echo 'm-menu__item--active' ?> m-menu__item--rel m-menu__item--submenu-tabs" m-menu-link-redirect="1"  aria-haspopup="true">
                                                        <a  href="?s=administradorRespuesta" class="m-menu__link">
                                                            <i class="m-menu__link-icon fa fa-ellipsis-h"></i>
                                                            <span class="m-menu__link-text">
                                                                RESPUESTAS
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>

                                            </div>
                                        </li>
                                        <li class="m-menu__item  <?php if( $_REQUEST['s'] == 'administradorDocente' || $_REQUEST['s'] == 'administradorMatricula' || $_REQUEST['s'] == 'administradorImportarEstudiante' || $_REQUEST['s'] == 'administradorImportarDocente') echo 'm-menu__item--active m-menu__item--active-tab' ?>  m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
                                            <a  href="" class="m-menu__link m-menu__toggle">
                                                <span class="m-menu__link-text">
                                                    GENERAL
                                                </span>
                                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </a>
                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                <ul class="m-menu__subnav">
                                                    <li class="m-menu__item  <?php if($_REQUEST['s'] == 'administradorMatricula') echo 'm-menu__item--active' ?>"  m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a  href="?s=administradorMatricula" class="m-menu__link ">
                                                            <i class="m-menu__link-icon fa fa-mortar-board "></i>
                                                            <span class="m-menu__link-text">
                                                                MATRICULA
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li class="m-menu__item  <?php if($_REQUEST['s'] == 'administradorDocente') echo 'm-menu__item--active' ?>"  m-menu-link-redirect="1" aria-haspopup="true">
                                                        <a  href="?s=administradorDocente" class="m-menu__link ">
                                                            <i class="m-menu__link-icon fa fa-users"></i>
                                                            <span class="m-menu__link-text">
                                                                DOCENTE
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li class="m-menu__item  <?php if($_REQUEST['s'] == 'administradorImportarEstudiante' || $_REQUEST['s'] == 'administradorImportarDocente') echo 'm-menu__item--active' ?>  m-menu__item--submenu m-menu__item--rel m-menu__item--submenu-tabs"  m-menu-submenu-toggle="click" aria-haspopup="true">
                                                        <a  href="#" class="m-menu__link m-menu__toggle">
                                                            <i class="m-menu__link-icon fa fa-download"></i>
                                                            <span class="m-menu__link-text">
                                                                IMPORTAR
                                                            </span>
                                                            <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        </a>
                                                        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                                            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                            <ul class="m-menu__subnav">

                                                                <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorImportarEstudiante') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a  href="?s=administradorImportarEstudiante" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa fa-mortar-board"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    ESTUDIANTE
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorImportarDocente') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a  href="?s=administradorImportarDocente" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa fa-users"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    DOCENTE
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </li>


                                                </ul>
                                            </div>
                                        </li>
                                        <li class="m-menu__item  <?php if($_REQUEST['s'] == 'administradorAnio' || $_REQUEST['s'] == 'administradorHorario' || $_REQUEST['s'] == 'administradorPadre' ||  $_REQUEST['s'] == 'administradorTutor' || $_REQUEST['s'] == 'administradorDireccion' || $_REQUEST['s'] == 'administradorAsignacion' || $_REQUEST['s'] == 'administradorGrado' || $_REQUEST['s'] == 'administradorSeccion' || $_REQUEST['s'] == 'administradorNivel' || $_REQUEST['s'] == 'administradorPeriodo' || $_REQUEST['s'] == 'administradorArea' || $_REQUEST['s'] == 'administradorCurso') echo 'm-menu__item--active m-menu__item--active-tab' ?> m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
                                            <a  href="?s=administradorInstitucion" class="m-menu__link m-menu__toggle">
                                                <span class="m-menu__link-text">
                                                    ACADÉMICO
                                                </span>
                                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </a>
                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                <ul class="m-menu__subnav">

                                                <li class="m-menu__item  <?php if( $_REQUEST['s'] == 'administradorAnio' || $_REQUEST['s'] == 'administradorGrado' || $_REQUEST['s'] == 'administradorSeccion' || $_REQUEST['s'] == 'administradorNivel' || $_REQUEST['s'] == 'administradorPeriodo') echo 'm-menu__item--active' ?> m-menu__item--submenu m-menu__item--rel m-menu__item--submenu-tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
                                                    <a  href="#" class="m-menu__link m-menu__toggle">
                                                            <i class="m-menu__link-icon fa fa-cog"></i>
                                                            <span class="m-menu__link-text">
                                                                COLEGIO
                                                            </span>
                                                            <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </a>
                                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                        <ul class="m-menu__subnav">

                                                            <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorGrado') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="?s=administradorGrado" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-cogs"></i>
                                                                    <span class="m-menu__link-title">
                                                                        <span class="m-menu__link-wrap">
                                                                            <span class="m-menu__link-text">
                                                                                GRADO
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorSeccion') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="?s=administradorSeccion" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-cogs"></i>
                                                                    <span class="m-menu__link-title">
                                                                        <span class="m-menu__link-wrap">
                                                                            <span class="m-menu__link-text">
                                                                                SECCION
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>


                                                            <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorNivel') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="?s=administradorNivel" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-cogs"></i>
                                                                    <span class="m-menu__link-title">
                                                                        <span class="m-menu__link-wrap">
                                                                            <span class="m-menu__link-text">
                                                                                NIVEL
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>


                                                            <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorPeriodo') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="?s=administradorPeriodo" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-calendar-o"></i>
                                                                    <span class="m-menu__link-title">
                                                                        <span class="m-menu__link-wrap">
                                                                            <span class="m-menu__link-text">
                                                                                PERIODO
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorAnio') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="?s=administradorAnio" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-calendar"></i>
                                                                    <span class="m-menu__link-title">
                                                                        <span class="m-menu__link-wrap">
                                                                            <span class="m-menu__link-text">
                                                                                AÑO
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>



                                                        </ul>
                                                    </div>
                                                </li>

                                                <li class="m-menu__item  <?php if($_REQUEST['s'] == 'administradorArea' || $_REQUEST['s'] == 'administradorCurso') echo 'm-menu__item--active' ?>  m-menu__item--submenu m-menu__item--rel m-menu__item--submenu-tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
                                                    <a  href="#" class="m-menu__link m-menu__toggle">
                                                        <i class="m-menu__link-icon fa fa-graduation-cap"></i>
                                                        <span class="m-menu__link-text">
                                                            ACADÉMICO
                                                        </span>
                                                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </a>
                                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                        <ul class="m-menu__subnav">

                                                            <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorArea') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="?s=administradorArea" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-tag"></i>
                                                                    <span class="m-menu__link-title">
                                                                        <span class="m-menu__link-wrap">
                                                                            <span class="m-menu__link-text">
                                                                                AREA
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorCurso') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="?s=administradorCurso" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-tags"></i>
                                                                    <span class="m-menu__link-title">
                                                                        <span class="m-menu__link-wrap">
                                                                            <span class="m-menu__link-text">
                                                                                CURSO
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </li>

                                                <li class="m-menu__item  <?php if( $_REQUEST['s'] == 'administradorAsignacion' || $_REQUEST['s'] == 'administradorHorario') echo 'm-menu__item--active' ?> m-menu__item--submenu m-menu__item--rel m-menu__item--submenu-tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
                                                    <a  href="#" class="m-menu__link m-menu__toggle">
                                                            <i class="m-menu__link-icon fa fa-user"></i>
                                                            <span class="m-menu__link-text">
                                                                ASIGNACIÓN
                                                            </span>
                                                            <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </a>
                                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                        <ul class="m-menu__subnav">

                                                            <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorAsignacion') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="?s=administradorAsignacion" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-group"></i>
                                                                    <span class="m-menu__link-title">
                                                                        <span class="m-menu__link-wrap">
                                                                            <span class="m-menu__link-text">
                                                                                POR TUTORIA
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorHorario') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="?s=administradorHorario" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-cogs"></i>
                                                                    <span class="m-menu__link-title">
                                                                        <span class="m-menu__link-wrap">
                                                                            <span class="m-menu__link-text">
                                                                                POR CURSO
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </li>

                                                <li class="m-menu__item  <?php if($_REQUEST['s'] == 'administradorDireccion' || $_REQUEST['s'] == 'administradorTutor' || $_REQUEST['s'] == 'administradorPadre') echo 'm-menu__item--active' ?>  m-menu__item--submenu m-menu__item--rel m-menu__item--submenu-tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
                                                    <a  href="#" class="m-menu__link m-menu__toggle">
                                                        <i class="m-menu__link-icon fa fa-key "></i>
                                                        <span class="m-menu__link-text">
                                                            CUENTAS
                                                        </span>
                                                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </a>
                                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                        <ul class="m-menu__subnav">

                                                            <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorDireccion') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="?s=administradorDireccion" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-unlock-alt"></i>
                                                                    <span class="m-menu__link-title">
                                                                        <span class="m-menu__link-wrap">
                                                                            <span class="m-menu__link-text">
                                                                                DIRECCION
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorTutor') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="?s=administradorTutor" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-unlock-alt"></i>
                                                                    <span class="m-menu__link-title">
                                                                        <span class="m-menu__link-wrap">
                                                                            <span class="m-menu__link-text">
                                                                                TUTOR
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                            <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorPadre') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                <a  href="?s=administradorPadre" class="m-menu__link ">
                                                                    <i class="m-menu__link-icon fa fa-unlock-alt"></i>
                                                                    <span class="m-menu__link-title">
                                                                        <span class="m-menu__link-wrap">
                                                                            <span class="m-menu__link-text">
                                                                                PADRE
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </li>

                                                </ul>
                                            </div>
                                        </li>
                                        <li class="m-menu__item  <?php if($_REQUEST['s'] == 'administradorEvento' || $_REQUEST['s'] == 'administradorItem' || $_REQUEST['s'] == 'administradorPreguntaEta' || $_REQUEST['s'] == 'administradorProceso' || $_REQUEST['s'] == 'administradorSemanaEta') echo 'm-menu__item--active m-menu__item--active-tab' ?> m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
                                            <a  href="?s=administradorInstitucion" class="m-menu__link m-menu__toggle">
                                                <span class="m-menu__link-text">
                                                    TUTORIA
                                                </span>
                                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </a>
                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                <ul class="m-menu__subnav">
                                                    <li class="m-menu__item  <?php if($_REQUEST['s'] == 'administradorProceso' || $_REQUEST['s'] == 'administradorItem') echo 'm-menu__item--active' ?>  m-menu__item--submenu m-menu__item--rel m-menu__item--submenu-tabs"  m-menu-submenu-toggle="click" aria-haspopup="true">
                                                        <a  href="#" class="m-menu__link m-menu__toggle">
                                                            <i class="m-menu__link-icon fa fa-gears"></i>
                                                            <span class="m-menu__link-text">
                                                                PROCESO ETA
                                                            </span>
                                                            <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        </a>
                                                        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                                            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                            <ul class="m-menu__subnav">

                                                                <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorProceso') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a  href="?s=administradorProceso" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa fa-gear"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    PROCESO
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorItem') echo 'm-menu__item--active' ?> m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a  href="?s=administradorItem" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa fa-gears"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    ITEM
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </li>


                                                    <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorSemanaEta') echo 'm-menu__item--active' ?> m-menu__item--rel m-menu__item--submenu-tabs"  m-menu-submenu-toggle="click" aria-haspopup="true">
                                                        <a  href="?s=administradorSemanaEta" class="m-menu__link">
                                                            <i class="m-menu__link-icon fa fa-calendar-o"></i>
                                                            <span class="m-menu__link-text">
                                                                SEMANA ETA
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorPreguntaEta') echo 'm-menu__item--active' ?> m-menu__item--rel m-menu__item--submenu-tabs"  m-menu-submenu-toggle="click" aria-haspopup="true">
                                                        <a  href="?s=administradorPreguntaEta" class="m-menu__link">
                                                            <i class="m-menu__link-icon fa fa-pencil"></i>
                                                            <span class="m-menu__link-text">
                                                                PREGUNTA ETA
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorEvento') echo 'm-menu__item--active' ?> m-menu__item--rel m-menu__item--submenu-tabs"  m-menu-submenu-toggle="click" aria-haspopup="true">
                                                        <a  href="?s=administradorEvento" class="m-menu__link">
                                                            <i class="m-menu__link-icon fa fa-film"></i>
                                                            <span class="m-menu__link-text">
                                                                HISTORIA RELEXIVA
                                                            </span>
                                                        </a>
                                                    </li>



                                                </ul>
                                            </div>
                                        </li>

                                        <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorDatos' ||  $_REQUEST['s'] == 'administradorMensaje') echo 'm-menu__item--active m-menu__item--active-tab' ?> m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
                                            <a  href="#" class="m-menu__link m-menu__toggle">
                                                <span class="m-menu__link-text">
                                                    USUARIO
                                                </span>
                                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </a>
                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left ">
                                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                <ul class="m-menu__subnav">
                                                    <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorDatos') echo 'm-menu__item--active' ?> m-menu__item--rel m-menu__item--submenu-tabs" m-menu-link-redirect="1"  aria-haspopup="true">
                                                        <a  href="?s=administradorDatos" class="m-menu__link">
                                                            <i class="m-menu__link-icon fa fa-user"></i>
                                                            <span class="m-menu__link-text">
                                                                PERFIL
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorMensaje') echo 'm-menu__item--active' ?> m-menu__item--rel m-menu__item--submenu-tabs" m-menu-link-redirect="1"  aria-haspopup="true">
                                                        <a  href="?s=administradorMensaje" class="m-menu__link">
                                                            <i class="m-menu__link-icon fa fa-envelope-o"></i>
                                                            <span class="m-menu__link-text">
                                                                MENSAJE
                                                            </span>
                                                        </a>
                                                    </li>


                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end::Horizontal Menu -->
                        </div>
                    </div>
                </div>

            </header>
            <!-- end::Header -->
        <!-- begin::Body -->
