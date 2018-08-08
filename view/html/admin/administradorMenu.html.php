<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
<!-- BEGIN: Header -->
<header id="m_header" class="m-grid__item    m-header " m-minimize="minimize" m-minimize-mobile="minimize" m-minimize-offset="200" m-minimize-mobile-offset="200">
	<div class="m-container m-container--fluid m-container--full-height">
		<div class="m-stack m-stack--ver m-stack--desktop  m-header__wrapper">
			<!-- BEGIN: Brand -->
			<div class="m-stack__item m-brand m-brand--mobile">
				<div class="m-stack m-stack--ver m-stack--general">
					<div class="m-stack__item m-stack__item--middle m-brand__logo">
						<a href="index.html" class="m-brand__logo-wrapper">
							<img alt="" src="<?php sistema::imprimir(ROOT_IMG_LOGO.'logo360_menu.png') ?>" width="50%" />
						</a>
					</div>
					<div class="m-stack__item m-stack__item--middle m-brand__tools">
						<!-- BEGIN: Responsive Aside Left Menu Toggler -->
							<!-- <a href="javascript:;" id="m_aside_left_toggle_mobile" class="m-brand__icon m-brand__toggler m-brand__toggler--left">
								<span></span>
							</a> -->
						<!-- END -->

						<!-- BEGIN: Responsive Header Menu Toggler -->
						<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler">
							<span></span>
						</a>
						<!-- END -->

						<!-- BEGIN: Topbar Toggler -->
						<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon">
							<i class="flaticon-more"></i>
						</a>
						<!-- BEGIN: Topbar Toggler -->
					</div>
				</div>
			</div>
			<!-- END: Brand -->

			<div class="m-stack__item m-stack__item--middle m-stack__item--left m-header-head" id="m_header_nav">
				<div class="m-stack m-stack--ver m-stack--desktop">
					<div class="m-stack__item m-stack__item--middle m-stack__item--fit">
						<!-- BEGIN: Aside Left Toggle -->
						<a href="javascript:;" id="m_aside_left_toggle" class="m-aside-left-toggler m-aside-left-toggler--left m_aside_left_toggler">
							<span></span>
						</a>
						<!-- END: Aside Left Toggle -->
					</div>

					<div class="m-stack__item m-stack__item--fluid">
						<!-- BEGIN: Horizontal Menu -->
						<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
						<div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
							<ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
								<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorRespuesta' || $_REQUEST['s'] == 'administradorCalificacion' || $_REQUEST['s'] == 'administradorPerfil' || $_REQUEST['s'] == 'administradorInstitucion') print_r('m-menu__item--active') ?>  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true">
									<a href="javascript:;" class="m-menu__link m-menu__toggle">
										<span class="m-menu__item-here"></span>
										<i class="m-menu__link-icon flaticon-home-2"></i>
										<span class="m-menu__link-text">Colegio</span>
										<i class="m-menu__hor-arrow la la-angle-down"></i>
										<i class="m-menu__ver-arrow la la-angle-right"></i>
									</a>
									<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
										<span class="m-menu__arrow m-menu__arrow--adjust"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorInstitucion') echo 'm-menu__item--active' ?>" aria-haspopup="true">
												<a href="?s=administradorInstitucion" class="m-menu__link ">
												<i class="m-menu__link-icon flaticon-home-2"></i>
												<span class="m-menu__link-title">  
													<span class="m-menu__link-wrap">      
														<span class="m-menu__link-text">Institución</span>      
														</span>
													</span>
												</a>
											</li>

											<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorCalificacion') echo 'm-menu__item--active' ?>" aria-haspopup="true">
												<a href="?s=administradorCalificacion" class="m-menu__link ">
												<i class="m-menu__link-icon flaticon-list-1"></i>
												<span class="m-menu__link-title">  
													<span class="m-menu__link-wrap">      
														<span class="m-menu__link-text">Calificación</span>      
														</span>
													</span>
												</a>
											</li>

											<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorRespuesta') echo 'm-menu__item--active' ?>" aria-haspopup="true">
												<a href="?s=administradorRespuesta" class="m-menu__link ">
												<i class="m-menu__link-icon flaticon-apps"></i>
												<span class="m-menu__link-title">  
													<span class="m-menu__link-wrap">      
														<span class="m-menu__link-text">Respuesta</span>      
														</span>
													</span>
												</a>
											</li>
										</ul>
									</div>
								</li>

								<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorDocente' || $_REQUEST['s'] == 'administradorMatricula' || $_REQUEST['s'] == 'administradorImportarEstudiante' || $_REQUEST['s'] == 'administradorImportarDocente') print_r('m-menu__item--active') ?>  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" aria-haspopup="true">
									<a href="javascript:;" class="m-menu__link m-menu__toggle">
										<span class="m-menu__item-here"></span>
										<i class="m-menu__link-icon flaticon-avatar"></i>
										<span class="m-menu__link-text">Personal</span>
										<i class="m-menu__hor-arrow la la-angle-down"></i>
										<i class="m-menu__ver-arrow la la-angle-right"></i>
									</a>
									<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
										<span class="m-menu__arrow m-menu__arrow--adjust"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorInstitucion') echo 'm-menu__item--active' ?>" aria-haspopup="true">
												<a href="?s=administradorInstitucion" class="m-menu__link ">
												<i class="m-menu__link-icon flaticon-file"></i>
												<span class="m-menu__link-title">  
													<span class="m-menu__link-wrap">      
														<span class="m-menu__link-text">Matricula</span>      
														</span>
													</span>
												</a>
											</li>

											<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorCalificacion') echo 'm-menu__item--active' ?>" aria-haspopup="true">
												<a href="?s=administradorCalificacion" class="m-menu__link ">
												<i class="m-menu__link-icon flaticon-users"></i>
												<span class="m-menu__link-title">  
													<span class="m-menu__link-wrap">      
														<span class="m-menu__link-text">Docente</span>      
														</span>
													</span>
												</a>
											</li>

											<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorImportarEstudiante' || $_REQUEST['s'] == 'administradorImportarDocente') print_r('m-menu__item--active') ?> m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
												<a href="javascript:;" class="m-menu__link m-menu__toggle">
													<i class="m-menu__link-icon flaticon-upload"></i>
													<span class="m-menu__link-text">Importar</span>
													<i class="m-menu__hor-arrow la la-angle-right"></i>
													<i class="m-menu__ver-arrow la la-angle-right"></i>
												</a>
												<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
													<span class="m-menu__arrow "></span>
														<ul class="m-menu__subnav">
															<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorImportarEstudiante') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1" aria-haspopup="true">
																<a href="?s=administradorImportarEstudiante" class="m-menu__link ">
																<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
																<span class="m-menu__link-text">Estudiante</span>
															</a>
														</li>
														<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorImportarDocente') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1" aria-haspopup="true">
															<a href="?s=administradorImportarDocente" class="m-menu__link ">
															<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
																<span class="m-menu__link-text">Docente</span>
															</a>
														</li>
													</ul>
												</div>
											</li>

											<li class="m-menu__item  <?php if($_REQUEST['s'] == 'administradorDireccion' || $_REQUEST['s'] == 'administradorTutor' || $_REQUEST['s'] == 'administradorPadre') echo 'm-menu__item--active' ?> m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
												<a href="javascript:;" class="m-menu__link m-menu__toggle">
													<i class="m-menu__link-icon flaticon-book"></i>
													<span class="m-menu__link-text">Cuenta</span>
													<i class="m-menu__hor-arrow la la-angle-right"></i>
													<i class="m-menu__ver-arrow la la-angle-right"></i>
												</a>
												<div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
													<span class="m-menu__arrow "></span>
														<ul class="m-menu__subnav">
															<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorDireccion') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1" aria-haspopup="true">
																<a href="?s=administradorDireccion" class="m-menu__link ">
																<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
																<span class="m-menu__link-text">Dirección</span>
															</a>
														</li>
														<li class="m-menu__item<?php if($_REQUEST['s'] == 'administradorTutor') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1" aria-haspopup="true">
															<a href="?s=administradorTutor" class="m-menu__link ">
																<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
																<span class="m-menu__link-text">Tutor</span>
															</a>
														</li>
														<li class="m-menu__item  <?php if($_REQUEST['s'] == 'administradorPadre') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1" aria-haspopup="true">
															<a href="?s=administradorPadre" class="m-menu__link ">
																<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
																<span class="m-menu__link-text">Padre</span>
															</a>
														</li>
													</ul>
												</div>

											</li>
										</ul>
									</div>
								</li>

		<li class="m-menu__item  <?php if( $_REQUEST['s'] == 'administradorAnio' || $_REQUEST['s'] == 'administradorGrado' || $_REQUEST['s'] == 'administradorSeccion' || $_REQUEST['s'] == 'administradorNivel' || $_REQUEST['s'] == 'administradorPeriodo' || $_REQUEST['s'] == 'administradorArea' || $_REQUEST['s'] == 'administradorCurso' || $_REQUEST['s'] == 'administradorAsignacion' || $_REQUEST['s'] == 'administradorHorario') echo 'm-menu__item--active' ?> m-menu__item--submenu" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
			<a href="javascript:;" class="m-menu__link m-menu__toggle">
				<span class="m-menu__item-here"></span>
				<i class="m-menu__link-icon flaticon-cogwheel"></i>
				<span class="m-menu__link-text">General</span>
				<i class="m-menu__hor-arrow la la-angle-down"></i>
				<i class="m-menu__ver-arrow la la-angle-right"></i>
			</a>
			<div
				class="m-menu__submenu  m-menu__submenu--fixed-xl m-menu__submenu--center">
				<span class="m-menu__arrow m-menu__arrow--adjust"></span>
				<div class="m-menu__subnav">
					<ul class="m-menu__content">
						<li class="m-menu__item ">
							<h3 class="m-menu__heading m-menu__toggle">
								<span class="m-menu__link-text">Académico</span>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</h3>
							<ul class="m-menu__inner">
								<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorGrado') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1" aria-haspopup="true">
									<a href="?s=administradorGrado" class="m-menu__link ">
									<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
										<span class="m-menu__link-text">Grado Académico</span>
								</a>
								</li>
								<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorSeccion') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1" aria-haspopup="true">
									<a href="?s=administradorSeccion" class="m-menu__link ">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
										<span class="m-menu__link-text">Sección Académico</span>
									</a>
								</li>
								<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorNivel') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1" aria-haspopup="true">
									<a href="?s=administradorNivel" class="m-menu__link ">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
										<span class="m-menu__link-text">Nivel Académico</span>
									</a>
									</li>
								<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorAnio') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1" aria-haspopup="true">
									<a href="?s=administradorAnio" class="m-menu__link ">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
										<span class="m-menu__link-text">Año Académico</span>
									</a>
								</li>
								<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorPeriodo') echo 'm-menu__item--active' ?> " m-menu-link-redirect="1" aria-haspopup="true">
									<a href="?s=administradorPeriodo" class="m-menu__link ">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
										<span class="m-menu__link-text">Periodo Académico</span>
									</a>
								</li>
							</ul>
						</li>
						<li class="m-menu__item">
							<h3 class="m-menu__heading m-menu__toggle">
								<span class="m-menu__link-text">Curricular</span>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</h3>
							<ul class="m-menu__inner">
								<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorArea') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1" aria-haspopup="true">
									<a href="?s=administradorArea" class="m-menu__link ">
									<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
										<span class="m-menu__link-text">Área Académica</span>
									</a>
								</li>
								<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorCurso') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1" aria-haspopup="true">
									<a href="?s=administradorCurso" class="m-menu__link ">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
										<span class="m-menu__link-text">Curso Académico</span>
									</a>
								</li>
									
								
								<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorAsignacion') echo 'm-menu__item--active' ?> " m-menu-link-redirect="1" aria-haspopup="true">
									<a href="?s=administradorAsignacion" class="m-menu__link ">
									<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
										<span class="m-menu__link-text">Asignación Tutoria</span>
									</a>
								</li>
								<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorHorario') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1" aria-haspopup="true">
									<a href="?s=administradorHorario" class="m-menu__link ">
									<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
										<span class="m-menu__link-text">Asignación Curso</span>
									</a>
								</li>

							</ul>
						</li>
						<li class="m-menu__item">
							<h3 class="m-menu__heading m-menu__toggle">
								<span class="m-menu__link-text">Tutoria</span>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</h3>
							<ul class="m-menu__inner">
								
								<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorSemanaEta') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1" aria-haspopup="true">
									<a href="?s=administradorSemanaEta" class="m-menu__link ">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
										<span class="m-menu__link-text">Semana ETA</span>
									</a>
								</li>
								<li class="m-menu__item  <?php if($_REQUEST['s'] == 'administradorPreguntaEta') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1" aria-haspopup="true">
									<a href="?s=administradorPreguntaEta" class="m-menu__link ">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
										<span class="m-menu__link-text">Pregunta ETA</span>
									</a>
								</li>

								<li class="m-menu__item <?php if($_REQUEST['s'] == 'administradorHistoria') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1"
									aria-haspopup="true"><a href="?s=administradorHistoria" class="m-menu__link ">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
										<span class="m-menu__link-text">Historia Reflexiva</span>
									</a>
								</li>
							</ul>
						</li>

						<li class="m-menu__item">
							<h3 class="m-menu__heading m-menu__toggle">
								<span class="m-menu__link-text">Procesos ETA</span>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</h3>
							<ul class="m-menu__inner">

								<li class="m-menu__item  <?php if($_REQUEST['s'] == 'administradorProceso') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1"
									aria-haspopup="true"><a href="?s=administradorProceso" class="m-menu__link ">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
										<span class="m-menu__link-text">Proceso</span>
									</a>
								</li>

								<li class="m-menu__item  <?php if($_REQUEST['s'] == 'administradorItem') echo 'm-menu__item--active' ?>" m-menu-link-redirect="1"
									aria-haspopup="true"><a href="?s=administradorItem" class="m-menu__link ">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
										<span class="m-menu__link-text">Item</span>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
	</div>
	</li>
	</ul>
</div>
<!-- END: Horizontal Menu -->
</div>
</div>
</div>

<div class="m-stack__item m-stack__item--middle m-stack__item--center">
<!-- BEGIN: Brand -->
<a href="index.html" class="m-brand m-brand--desktop">
	<img alt="" src="<?php sistema::imprimir(ROOT_IMG_LOGO . 'logo360_menu.png') ?>" width="40%" />	
</a>
<!-- END: Brand -->
</div>

<div class="m-stack__item m-stack__item--right">
<!-- BEGIN: Topbar -->
<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">

	<div class="m-stack__item m-topbar__nav-wrapper">
		<ul class="m-topbar__nav m-nav m-nav--inline">
			<li class="
m-nav__item m-nav__item--focus m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light" m-dropdown-toggle="click" m-dropdown-persistent="1"
				id="m_quicksearch" m-quicksearch-mode="dropdown">

				<a href="#" class="m-nav__link m-dropdown__toggle">
					<span class="m-nav__link-icon"><span class="m-nav__link-icon-wrapper"><i class="flaticon-search-1"></i></span></span>
				</a>
				<div class="m-dropdown__wrapper">
					<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
					<div class="m-dropdown__inner ">
						<div class="m-dropdown__header">
							<form class="m-list-search__form">
								<div class="m-list-search__form-wrapper">
									<span class="m-list-search__form-input-wrapper">
					<input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="Search...">
				</span>
									<span class="m-list-search__form-icon-close" id="m_quicksearch_close">
					<i class="la la-remove"></i>
				</span>
								</div>
							</form>
						</div>
						<div class="m-dropdown__body">
							<div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-height="300" data-mobile-height="200">
								<div class="m-dropdown__content">
								</div>
							</div>
						</div>
					</div>
				</div>
			</li>
			<li class="m-nav__item m-nav__item--accent m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">
				<a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
					<span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
					<span class="m-nav__link-icon"><span class="m-nav__link-icon-wrapper"><i class="flaticon-music-2"></i></span></span>
				</a>
				<div class="m-dropdown__wrapper">
					<span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
					<div class="m-dropdown__inner">
						<div class="m-dropdown__header m--align-center">
							<span class="m-dropdown__header-title">9 New</span>
							<span class="m-dropdown__header-subtitle">User Notifications</span>
						</div>
						<div class="m-dropdown__body">
							<div class="m-dropdown__content">
								<ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">
					Alerts
					</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_events" role="tab">Events</a>
									</li>
									<li class="nav-item m-tabs__item">
										<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_logs" role="tab">Logs</a>
									</li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">
										<div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">
											<div class="m-list-timeline m-list-timeline--skin-light">
												<div class="m-list-timeline__items">
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
														<span class="m-list-timeline__text">12 new users registered</span>
														<span class="m-list-timeline__time">Just now</span>
													</div>
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge"></span>
														<span class="m-list-timeline__text">System shutdown <span class="m-badge m-badge--success m-badge--wide">pending</span></span>
														<span class="m-list-timeline__time">14 mins</span>
													</div>
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge"></span>
														<span class="m-list-timeline__text">New invoice received</span>
														<span class="m-list-timeline__time">20 mins</span>
													</div>
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge"></span>
														<span class="m-list-timeline__text">DB overloaded 80% <span class="m-badge m-badge--info m-badge--wide">settled</span></span>
														<span class="m-list-timeline__time">1 hr</span>
													</div>
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge"></span>
														<span class="m-list-timeline__text">System error - <a href="#" class="m-link">Check</a></span>
														<span class="m-list-timeline__time">2 hrs</span>
													</div>
													<div class="m-list-timeline__item m-list-timeline__item--read">
														<span class="m-list-timeline__badge"></span>
														<span href="" class="m-list-timeline__text">New order received <span class="m-badge m-badge--danger m-badge--wide">urgent</span></span>
														<span class="m-list-timeline__time">7 hrs</span>
													</div>
													<div class="m-list-timeline__item m-list-timeline__item--read">
														<span class="m-list-timeline__badge"></span>
														<span class="m-list-timeline__text">Production server down</span>
														<span class="m-list-timeline__time">3 hrs</span>
													</div>
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge"></span>
														<span class="m-list-timeline__text">Production server up</span>
														<span class="m-list-timeline__time">5 hrs</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
										<div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">
											<div class="m-list-timeline m-list-timeline--skin-light">
												<div class="m-list-timeline__items">
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
														<a href="" class="m-list-timeline__text">New order received</a>
														<span class="m-list-timeline__time">Just now</span>
													</div>
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge m-list-timeline__badge--state1-danger"></span>
														<a href="" class="m-list-timeline__text">New invoice received</a>
														<span class="m-list-timeline__time">20 mins</span>
													</div>
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
														<a href="" class="m-list-timeline__text">Production server up</a>
														<span class="m-list-timeline__time">5 hrs</span>
													</div>
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
														<a href="" class="m-list-timeline__text">New order received</a>
														<span class="m-list-timeline__time">7 hrs</span>
													</div>
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
														<a href="" class="m-list-timeline__text">System shutdown</a>
														<span class="m-list-timeline__time">11 mins</span>
													</div>
													<div class="m-list-timeline__item">
														<span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>
														<a href="" class="m-list-timeline__text">Production server down</a>
														<span class="m-list-timeline__time">3 hrs</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
										<div class="m-stack m-stack--ver m-stack--general" style="min-height: 180px;">
											<div class="m-stack__item m-stack__item--center m-stack__item--middle">
												<span class="">All caught up!<br>No new logs.</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</li>
			<li class="m-nav__item m-nav__item--danger m-dropdown m-dropdown--skin-light m-dropdown--large m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
				<a href="#" class="m-nav__link m-dropdown__toggle">
					<span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
					<span class="m-nav__link-icon"><span class="m-nav__link-icon-wrapper"><i class="flaticon-share"></i></span></span>
				</a>
				<div class="m-dropdown__wrapper">
					<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
					<div class="m-dropdown__inner">
						<div class="m-dropdown__header m--align-center">
							<span class="m-dropdown__header-title">Quick Actions</span>
							<span class="m-dropdown__header-subtitle">Shortcuts</span>
						</div>
						<div class="m-dropdown__body m-dropdown__body--paddingless">
							<div class="m-dropdown__content">
								<div class="m-scrollable" data-scrollable="false" data-height="380" data-mobile-height="200">
									<div class="m-nav-grid m-nav-grid--skin-light">
										<div class="m-nav-grid__row">
											<a href="#" class="m-nav-grid__item">
												<i class="m-nav-grid__icon flaticon-file"></i>
												<span class="m-nav-grid__text">Generate Report</span>
											</a>
											<a href="#" class="m-nav-grid__item">
												<i class="m-nav-grid__icon flaticon-time"></i>
												<span class="m-nav-grid__text">Add New Event</span>
											</a>
										</div>
										<div class="m-nav-grid__row">
											<a href="#" class="m-nav-grid__item">
												<i class="m-nav-grid__icon flaticon-folder"></i>
												<span class="m-nav-grid__text">Create New Task</span>
											</a>
											<a href="#" class="m-nav-grid__item">
												<i class="m-nav-grid__icon flaticon-clipboard"></i>
												<span class="m-nav-grid__text">Completed Tasks</span>
											</a>
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
					<span class="m-topbar__username m--hidden-mobile">Hola, <?php Sistema::imprimir($_SESSION["user"][4]) ?></span>
					<span class="m-topbar__userpic">
						<!-- <img src="" class="m--img-rounded m--marginless m--img-centered fotografia" alt=""/> -->
					</span>
					<span class="m-nav__link-icon m-topbar__usericon  m--hide">
	<span class="m-nav__link-icon-wrapper"><i class="flaticon-user-ok"></i></span>
					</span>
				</a>
				<div class="m-dropdown__wrapper">
					<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
					<div class="m-dropdown__inner">
						<div class="m-dropdown__header m--align-center">
							<div class="m-card-user m-card-user--skin-light">
								<div class="m-card-user__pic">
									<img src="" class="m--img-rounded m--marginless fotografia" alt="" />
								</div>
								<div class="m-card-user__details">
									<span class="m-card-user__name m--font-weight-500"><?php sistema::imprimir($_SESSION["user"][2]." ".$_SESSION["user"][3]) ?> <br> <?php sistema::imprimir($_SESSION["user"][4]) ?></span>
									<a href="" class="m-card-user__email m--font-weight-300 m-link"><?php sistema::imprimir($_SESSION["modulo"][1]) ?></a>
								</div>
							</div>
						</div>
						<div class="m-dropdown__body">
							<div class="m-dropdown__content">
								<ul class="m-nav m-nav--skin-light">
									<li class="m-nav__section m--hide">
										<span class="m-nav__section-text">Mi Perfil</span>
									</li>
									<li class="m-nav__item">
										<a href="#" onclick="js_profile.modalUserUpdateSubmit(1)" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-profile-1"></i>
											<span class="m-nav__link-title">  
												<span class="m-nav__link-wrap">      
													<span class="m-nav__link-text">Mis Datos</span>
												</span>
											</span>
										</a>
									</li>
									<li class="m-nav__item">
										<a href="#" onclick="js_profile.modalSingInUpdateSubmit(1)" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-share"></i>
											<span class="m-nav__link-text">Mi Contraseña</span>
										</a>
									</li>
									<li class="m-nav__item">
										<a href="#" onclick="js_profile.modalAvatarUpdateSubmit(1)" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-chat-1"></i>
											<span class="m-nav__link-text">Mi Avatar</span>
										</a>
									</li>
									<li class="m-nav__separator m-nav__separator--fit">
									</li>
									<li class="m-nav__item">
                                        <a href="#" onclick="js_profile.modaleMessageUpdateSubmit(1)"  class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                            <span class="m-nav__link-title">  
												<span class="m-nav__link-wrap">      
													<span class="m-nav__link-text">My Profile</span>
                                                    	<span class="m-nav__link-badge">
															<span class="m-badge m-badge--success m-recibido">0</span>
														</span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
									<li class="m-nav__item">
										<a href="#" onclick="js_profile.modaleFAQUpdateSubmit(1)" class="m-nav__link">
											<i class="m-nav__link-icon flaticon-lifebuoy"></i>
											<span class="m-nav__link-text">Support</span>
											
										</a>
									</li>
									<li class="m-nav__separator m-nav__separator--fit">
									</li>
									<li class="m-nav__item">
										<a href="?s=administradorPerfil&token=singOut" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">Cerrar Sesión</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</li>

			<li id="m_quick_sidebar_toggle" class="m-nav__item m-nav__item--info m-nav__item--qs">
				<a href="#" class="m-nav__link m-dropdown__toggle">
					<span class="m-nav__link-icon m-nav__link-icon-alt"><span class="m-nav__link-icon-wrapper"><i class="flaticon-grid-menu"></i></span></span>
				</a>
			</li>
		</ul>
	</div>
</div>
<!-- END: Topbar -->
</div>
</div>
</div>
</header>
    <!-- BEGIN: Left Aside -->
    <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>

    <div id="m_aside_left" class="m-aside-left  m-aside-left--skin-dark ">
        <!-- BEGIN: Aside Menu -->
        <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " data-menu-vertical="true" m-menu-scrollable="1" m-menu-dropdown-timeout="500">
            <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                <li class="m-menu__section m-menu__section--first">
                    <h4 class="m-menu__section-text">Departments</h4>
                    <i class="m-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-layers"></i><span class="m-menu__link-text">Resources</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Resources</span></span>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Timesheet</span></a></li>
                            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Payroll</span></a></li>
                            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Contacts</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-suitcase"></i><span class="m-menu__link-text">Finance</span></a></li>
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-link-redirect="1"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-graphic-1"></i><span class="m-menu__link-title">  <span class="m-menu__link-wrap">      <span class="m-menu__link-text">Support</span>      <span class="m-menu__link-badge"><span class="m-badge m-badge--accent">3</span></span>  </span></span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                    <div
                        class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" m-menu-link-redirect="1"><span class="m-menu__link"><span class="m-menu__link-title">  <span class="m-menu__link-wrap">      <span class="m-menu__link-text">Support</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--accent">3</span></span>
                                </span>
                                </span>
                                </span>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Reports</span></a></li>
                            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-link-redirect="1"><a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__link-text">Cases</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Pending</span></a></li>
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Urgent</span></a></li>
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Done</span></a></li>
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Archive</span></a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Clients</span></a></li>
                            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><span class="m-menu__link-text">Audit</span></a></li>
                        </ul>
        </div>
        </li>
        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-light"></i><span class="m-menu__link-text">Administration</span></a></li>
        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-share"></i><span class="m-menu__link-text">Management</span></a></li>
        <li class="m-menu__section ">
            <h4 class="m-menu__section-text">Reports</h4>
            <i class="m-menu__section-icon flaticon-more-v2"></i>
        </li>
        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-graphic"></i><span class="m-menu__link-text">Accounting</span></a></li>
        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-network"></i><span class="m-menu__link-text">Products</span></a></li>
        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-network"></i><span class="m-menu__link-text">Sales</span></a></li>
        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-alert"></i><span class="m-menu__link-title">  <span class="m-menu__link-wrap">      <span class="m-menu__link-text">Bills</span>      <span class="m-menu__link-badge"><span class="m-badge m-badge--danger">12</span></span>  </span></span></a></li>
        <li
            class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-technology"></i><span class="m-menu__link-text">IPO</span></a></li>
            <li class="m-menu__section ">
                <h4 class="m-menu__section-text">System</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-clipboard"></i><span class="m-menu__link-text">Applications</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Applications</span></span>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Audit</span></a></li>
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Notifications</span></a></li>
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Messages</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-computer"></i><span class="m-menu__link-text">Modules</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__link-text">Modules</span></span>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Logs</span></a></li>
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Errors</span></a></li>
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Configuration</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-cogwheel"></i><span class="m-menu__link-text">Files</span></a></li>
            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-lifebuoy"></i><span class="m-menu__link-text">Security</span></a></li>
            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="inner.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-settings"></i><span class="m-menu__link-text">Options</span></a></li>
            </ul>
    </div>
    <!-- END: Aside Menu -->
    </div>
    <!-- END: Left Aside -->