<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor-desktop m-grid--desktop m-body">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-container m-container--responsive m-container--xxl m-container--full-height">
		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
				<!--Begin::Section-->
				<div class="row">
					<div class="col-xl-12">
						<div class="m-portlet">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<span class="m-portlet__head-icon">
										<i class="flaticon-apps"></i>
										</span>
										<h3 class="m-portlet__head-text">
											IMPORTAR RESPUESTAS
										</h3>
									</div>
								</div>
								<div class="m-portlet__head-tools">
									<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--right m-tabs-line-danger" role="tablist">
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_tab_1_1" role="tab">
												EXPORTAR
											</a>
										</li>
										<li class="nav-item m-tabs__item">
											<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tab_1_2" role="tab">
												IMPORTAR
											</a>
										</li>
									</ul>
								</div>
							</div>

							<div class="m-portlet__body">
								<div class="tab-content">
									<div class="tab-pane active" id="m_tab_1_1">
										<form class="m-form m-form--state m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="frmExportarRespuesta">
											<div class=" row ">
												<div class="col-lg-6 form-group m-form__group">
													<label for="">COLEGIO</label>
													<select class="form-control m-input m-input--air select2Colegio" name="colegio">
														<option value=""></option>
													</select>
													<span class="m-form__help"></span>
												</div>

												<div class="col-lg-3 form-group m-form__group">
													<label for="">PERIODO</label>
													<select class="form-control m-input m-input--air select2Periodo" name="unidad" onchange="js_sistema.paraElegirSemana()" style="width: 100%">
														<option value=""></option>
													</select>
													<span class="m-form__help"></span>
												</div>

												<div class="col-lg-3 form-group  m-form__group">
													<label for="">SEMANA ETA</label>
													<select class="form-control m-input m-input--air select2Semana" name="semana" style="width: 100%">
														<option value=""></option>
													</select>
													<span class="m-form__help"></span>
												</div>
											</div>

											<div class=" row">
												<div class="col-lg-3 m-form__group form-group">
													<label for="">TIPO</label>
													<div class="m-radio-inline">
														<label class="m-radio">
														<input type="radio" name="eta" value="1" checked> ETA I
														<span></span>
														</label>
														<label class="m-radio">
														<input type="radio" name="eta" value="2"> ETA II
														<span></span>
														</label>
													</div>
													<span class="m-form__help"></span>
												</div>
												<div class="col-lg-3 m-form__group form-group">
													<label for="">GRADO</label>
													<select class="form-control m-input m-input--air select2Grado" name="grado" style="width: 100%"></select>
													<span class="m-form__help"></span>
												</div>
												<div class="col-lg-3 m-form__group form-group">
													<label for="">SECCIÓN</label>
													<select class="form-control m-input m-input--air select2Seccion" name="seccion" style="width: 100%"></select>
												</div>

												<div class="col-lg-3 m-form__group form-group">
													<label for="">NIVEL</label>
													<select class="form-control m-input m-input--air select2Nivel" name="nivel" style="width: 100%"></select>
												</div>
											</div>

											<div class="regImportar"></div>

											<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
												<div class="m-form__actions m-form__actions--solid">
													<div class="col-lg-12 m--align-right">
														<button id="btn-submit-respuesta2" type="button" class="btn btn-outline-info">FORMATO</button>
													</div>
												</div>
											</div>

										</form>
									</div>

									<div class="tab-pane" id="m_tab_1_2">
										<form class="m-form m-form--fit m-form--state m-form--label-align-right m-form--group-seperator-dashed" id="frmImportarRespuesta">
											<div class="row">
												<div class="col-lg-6 m-form__group form-group">
													<label>Selecciona Archivo</label>
													<input type="file" class="form-control m-input m-input--air" name="userfile_export">
													<span class="m-form__help">Tamaño maximo del archivo: 5 MB</span>
												</div>
												<div class="col-lg-6 regImportar">
													<div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-info alert-dismissible fade show" role="alert">
														<div class="m-alert__icon">
															<i class="flaticon-exclamation-2"></i>
															<span></span>
														</div>
														<div class="m-alert__text">
															<strong>NO SE IMPORTARON DATOS
														</div>
													</div>
												</div>
											</div>
											<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
												<div class="m-form__actions m-form__actions--solid">
													<div class="col-lg-12 m--align-right">
														<button id="btn_submit-respuesta1" type="button" class="btn btn-outline-primary">IMPORTAR</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
