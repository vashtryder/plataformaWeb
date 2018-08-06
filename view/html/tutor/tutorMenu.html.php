        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <!-- begin::Header -->
            <header class="m-grid__item m-header" data-minimize="minimize" data-minimize-mobile="minimize" data-minimize-offset="10" data-minimize-mobile-offset="10" >
                <div class="m-header__top">
                    <div class="m-container m-container--fluid m-container--full-height m-page__container">
                        <div class="m-stack m-stack--ver m-stack--desktop">
                            <!-- begin::Brand -->
                            <div class="m-stack__item m-brand m-stack__item--left">
                                <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                                        <a href="#" class="m-brand__logo-wrapper">
                                            <img alt="" src="view/img/logo/logo360_menu.png" class="m-brand__logo-desktop" style="width: 40%" />
                                            <img alt="" src="view/img/logo/logo360_menu.png" class="m-brand__logo-mobile" style="width: 150px" />
                                        </a>
                                    </div>
                                    <div class="m-stack__item m-stack__item--middle m-brand__tools">
                                        <!-- begin::Quick Actions-->

                                        <!-- end::Quick Actions-->

                                        <!-- end::Responsive Header Menu Toggler-->
                                        <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                            <span></span>
                                        </a>
                                        <!-- END -->

                                        <!-- begin::Responsive Header Menu Toggler-->
                                        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                            <span></span>
                                        </a>

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
                                                                         <?php sistema::imprimir( $_SESSION['tutor']['aula'] ) ?>
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
                                    <i class="la la-close"></i>
                                </button>
                                <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light "  >
                                    <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                                        <li class="m-menu__item  <?php if($_REQUEST['s'] == 'tutorSemana' || $_REQUEST['s'] == 'tutorPerfil' || $_REQUEST['s'] == 'reporteAula' || $_REQUEST['s'] == 'reporteGrado' || $_REQUEST['s'] == 'reporteGrupo' || $_REQUEST['s'] == 'reporteEstudiante' || $_REQUEST['s'] == 'reporteRespuesta' || $_REQUEST['s'] == 'reporteMerito') echo 'm-menu__item--active-tab' ?> m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
                                            <a  href="#" class="m-menu__link m-menu__toggle">
                                                <span class="m-menu__link-text">
                                                    ETA
                                                </span>
                                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </a>
                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                <ul class="m-menu__subnav">

                                                    <li class="m-menu__item <?php if($_REQUEST['s'] == 'tutorSemana') echo 'm-menu__item--active' ?> m-menu__item--submenu m-menu__item--rel m-menu__item--submenu-tabs"  m-menu-submenu-toggle="click" aria-haspopup="true">
                                                        <a  href="#" class="m-menu__link m-menu__toggle">
                                                            <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                            <span class="m-menu__link-text">
                                                                MIS ETAS
                                                            </span>
                                                            <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        </a>
                                                        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                                            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                            <ul class="m-menu__subnav">

                                                                <?php $rs = gestorPeriodo::get_periodo() ?>
                                                                <?php foreach ($rs as $rows) { ?>
                                                                <?php $rs1 = gestorSemana::get_semanaAcademica($rows[0]) ?>
                                                                <li class="m-menu__item <?php if($rows[0] == 1) sistema::imprimir('m-menu__item--active') ?>  m-menu__item--submenu"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a  href="#" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa  fa-archive"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    <?php sistema::imprimir($rows[3]) ?>
                                                                                </span>
                                                                                <span class="m-menu__link-badge">
                                                                                    <span class="m-badge m-badge--success">
                                                                                        <?php sistema::imprimir(count($rs1)) ?>
                                                                                    </span>
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                                        <span class="m-menu__arrow "></span>
                                                                        <ul class="m-menu__subnav">
                                                                            <?php foreach ($rs1 as $row1) { ?>
                                                                            <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                                <a  href="?s=tutorSemana&u=<?php sistema::imprimir($rows[0]) ?>&i=<?php sistema::imprimir($row1[0]) ?>" class="m-menu__link">
                                                                                    <i class="m-menu__link-icon la  la-minus"></i>
                                                                                    <span class="m-menu__link-text">
                                                                                        <?php sistema::imprimir($row1[3]) ?>
                                                                                    </span>
                                                                                </a>
                                                                            </li>
                                                                            <?php } ?>
                                                                        </ul>
                                                                    </div>
                                                                </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </li>

                                                   <li class="m-menu__item  <?php if($_REQUEST['s'] == 'reporteMerito' || $_REQUEST['s'] == 'reporteAula' || $_REQUEST['s'] == 'reporteGrado' || $_REQUEST['s'] == 'reporteGrupo' || $_REQUEST['s'] == 'reporteEstudiante' || $_REQUEST['s'] == 'reporteRespuesta') echo 'm-menu__item--active m-menu__item--active-tab' ?> m-menu__item--submenu m-menu__item--rel m-menu__item--submenu-tabs"  m-menu-submenu-toggle="click" aria-haspopup="true">
                                                        <a  href="#" class="m-menu__link m-menu__toggle">
                                                            <i class="m-menu__link-icon  flaticon-layers"></i>
                                                            <span class="m-menu__link-text">
                                                                REPORTE
                                                            </span>
                                                            <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        </a>
                                                        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                                            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                            <ul class="m-menu__subnav">
                                                                <li class="m-menu__item <?php if($_REQUEST['s'] == 'reporteAula') echo 'm-menu__item--active' ?>"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a  href="?s=reporteAula" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa  fa-file-pdf-o"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    Por Aula
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li class="m-menu__item <?php if($_REQUEST['s'] == 'reporteGrado') echo 'm-menu__item--active' ?>"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a  href="?s=reporteGrado" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa  fa-file-pdf-o"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    Por Grado
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li class="m-menu__item <?php if($_REQUEST['s'] == 'reporteGrupo') echo 'm-menu__item--active' ?>" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a  href="?s=reporteGrupo" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa  fa-file-pdf-o"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    Por Grupo
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li class="m-menu__item <?php if($_REQUEST['s'] == 'reporteEstudiante') echo 'm-menu__item--active' ?>"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a  href="?s=reporteEstudiante" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa  fa-file-pdf-o"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    Por Estudiante
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li class="m-menu__item <?php if($_REQUEST['s'] == 'reporteRespuesta') echo 'm-menu__item--active' ?>"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a  href="?s=reporteRespuesta" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa  fa-file-pdf-o"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    CPR
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li class="m-menu__item <?php if($_REQUEST['s'] == 'reporteMerito') echo 'm-menu__item--active' ?>"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1"  aria-haspopup="true">
                                                                    <a  href="?s=reporteMerito" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa  fa-file-pdf-o"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    Merito General
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
                                        <li class="m-menu__item <?php if($_REQUEST['s'] == 'tutorProceso' ||  $_REQUEST['s'] == 'tutorHistoria' || $_REQUEST['s'] == 'tutorListaEstudiante' || $_REQUEST['s'] == 'tutorListaCurso' || $_REQUEST['s'] == 'tutorSabana' || $_REQUEST['s'] == 'tutorCuadro') echo 'm-menu__item--active m-menu__item--active-tab' ?> m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
                                            <a  href="#" class="m-menu__link m-menu__toggle">
                                                <span class="m-menu__link-text">
                                                    MATERIAL
                                                </span>
                                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                                            </a>
                                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                <ul class="m-menu__subnav">
                                                    <li class="m-menu__item  <?php if($_REQUEST['s'] == 'tutorListaEstudiante' || $_REQUEST['s'] == 'tutorListaCurso') echo 'm-menu__item--active' ?> m-menu__item--submenu m-menu__item--rel m-menu__item--submenu-tabs"  m-menu-submenu-toggle="click" aria-haspopup="true">
                                                        <a  href="#" class="m-menu__link m-menu__toggle">
                                                            <i class="m-menu__link-icon  fa fa-mortar-board"></i>
                                                            <span class="m-menu__link-text">
                                                                ESTUDIANTE
                                                            </span>
                                                            <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        </a>
                                                        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                                            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                            <ul class="m-menu__subnav">
                                                                <li class="m-menu__item  <?php if($_REQUEST['s'] == 'tutorListaEstudiante') echo 'm-menu__item--active' ?>"  m-menu-submenu-toggle="hover" m-menu-link-redirect="1"  aria-haspopup="true">
                                                                    <a  href="?s=tutorListaEstudiante" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa fa-file-pdf-o"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    Lista
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <!-- <li class="m-menu__item <?php if($_REQUEST['s'] == 'tutorListaCurso') echo 'm-menu__item--active' ?>""  m-menu-submenu-toggle="hover" m-menu-link-redirect="1"  aria-haspopup="true">
                                                                    <a  href="?s=tutorListaCurso" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa fa-file-pdf-o"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    curso (Docente)
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li> -->

                                                            </ul>
                                                        </div>
                                                    </li>

                                                    <li class="m-menu__item  <?php if($_REQUEST['s'] == 'tutorHistoria' || $_REQUEST['s'] == 'tutorSabana' || $_REQUEST['s'] == 'tutorCuadro') echo 'm-menu__item--active' ?> m-menu__item--submenu m-menu__item--rel m-menu__item--submenu-tabs"  m-menu-submenu-toggle="click" aria-haspopup="true">
                                                        <a  href="#" class="m-menu__link m-menu__toggle">
                                                            <i class="m-menu__link-icon flaticon-graphic-2"></i>
                                                            <span class="m-menu__link-text">
                                                                RECURSOS
                                                            </span>
                                                            <i class="m-menu__hor-arrow la la-angle-down"></i>
                                                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                        </a>
                                                        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                                            <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                                            <ul class="m-menu__subnav">
                                                                <li class="m-menu__item <?php if($_REQUEST['s'] == 'tutorHistoria') echo 'm-menu__item--active' ?>""  m-menu-submenu-toggle="hover" m-menu-link-redirect="1"  aria-haspopup="true">
                                                                    <a  href="?s=tutorHistoria" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa fa-clipboard"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    Historia Reflexiva
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-menu__item <?php if($_REQUEST['s'] == 'tutorCuadro') echo 'm-menu__item--active' ?>""  m-menu-submenu-toggle="hover" m-menu-link-redirect="1"  aria-haspopup="true">
                                                                    <a  href="?s=tutorCuadro" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa fa-bar-chart-o"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    Analísis de Resultados
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                                <li class="m-menu__item <?php if($_REQUEST['s'] == 'tutorSabana') echo 'm-menu__item--active' ?>" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a  href="?s=tutorSabana" class="m-menu__link ">
                                                                        <i class="m-menu__link-icon fa fa-wpforms"></i>
                                                                        <span class="m-menu__link-title">
                                                                            <span class="m-menu__link-wrap">
                                                                                <span class="m-menu__link-text">
                                                                                    Sabana ETA
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </li>

                                                    <li class="m-menu__item  <?php if($_REQUEST['s'] == 'tutorProceso') echo 'm-menu__item--active' ?> m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" aria-haspopup="true">
                                                        <a  href="?s=tutorProceso" class="m-menu__link">
                                                            <i class="m-menu__link-icon flaticon-puzzle"></i>
                                                            <span class="m-menu__link-text">
                                                                PROCESOS ETA
                                                            </span>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </li>

                                        <li class="m-menu__item <?php if($_REQUEST['s'] == 'tutorDocente' ||  $_REQUEST['s'] == 'tutorMensajes') echo 'm-menu__item--active m-menu__item--active-tab' ?> m-menu__item--submenu m-menu__item--tabs"  m-menu-submenu-toggle="tab" aria-haspopup="true">
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
                                                    <li class="m-menu__item <?php if($_REQUEST['s'] == 'tutorDocente') echo 'm-menu__item--active' ?> m-menu__item--rel m-menu__item--submenu-tabs" m-menu-link-redirect="1"  aria-haspopup="true">
                                                        <a  href="?s=tutorDocente" class="m-menu__link">
                                                            <i class="m-menu__link-icon  la la-user"></i>
                                                            <span class="m-menu__link-text">
                                                                PERFIL
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <li class="m-menu__item <?php if($_REQUEST['s'] == 'tutorMensajes') echo 'm-menu__item--active' ?> m-menu__item--rel m-menu__item--submenu-tabs" m-menu-link-redirect="1"  aria-haspopup="true">
                                                        <a  href="?s=tutorMensajes" class="m-menu__link">
                                                            <i class="m-menu__link-icon la la-envelope-o"></i>
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
