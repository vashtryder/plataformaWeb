
    <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close m-aside-left-close--skin-light" id="m_aside_left_close_btn">
            <i class="la la-close"></i>
        </button>
        <div id="m_aside_left" class="m-grid__item m-aside-left ">
            <!-- BEGIN: Aside Menu -->
            <div  id="m_ver_menu"  class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light "  data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500"  >
                <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                    <li class="m-menu__section">
                        <h4 class="m-menu__section-text">
                            PROCESOS
                        </h4>
                        <i class="m-menu__section-icon flaticon-more-v3"></i>
                    </li>
                    <?php $rs = gestorProceso::get_proceso() ?>
                    <?php foreach ($rs as $rows) { ?>
                        <li class="m-menu__item <?php if($rows[0] == $_REQUEST['p']) sistema::imprimir('m-menu__item--active') ?>" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                            <a  href="?s=tutorProceso&p=<?php sistema::imprimir($rows[0]) ?>" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    <?php sistema::imprimir(mb_convert_case($rows[1],MB_CASE_TITLE,'UTF-8')) ?>
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
            <!-- END: Aside Menu -->
        </div>
        <!-- END: Left Aside -->
