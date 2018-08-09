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
										<span class="m-portlet__head-icon m--hide">
										<i class="la la-gear"></i>
										</span>
										<h3 class="m-portlet__head-text">
											IMPORTAR DATOS DEL ESTUDIANTE
										</h3>
									</div>
								</div>
							</div>
							<!--begin::Form-->
							<form class="m-form m-form--fit m-form--label-align-right" id="frmExportar">
								<div class="m-portlet__body">
									<div class="row">
										<div class="col-lg-6 m-form__group form-group">
											<label> </label>
											<select class="form-control m-input select2Colegio" name="idcolegio" style="width: 100%">
												<option value="">SELECCIONE COLEGIO</option>
											</select>
											<span class="m-form__help"></span>
										</div>
										<div class="col-lg-6 m-form__group form-group">
											<input type="file" class="form-control m-input m-input--air" name="userfile" id="userfile">
											<span class="m-form__help">Tamaño maximo del archivo: 5 MB</span>
										</div>
									</div>

									<div class="m-form__group m-form__group form-group row">
										<div class="col-lg-12 regImportarRespuesta"> NO SE IMPORTARON DATOS  </div>
									</div>
								</div>
								<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
									<div class="m-form__actions m-form__actions--solid">
										<div class="row">
											<div class="col-lg-6">
												<button id="btn_submit-importar" type="button" class="btn btn-outline-primary">IMPORTAR</button>
											</div>
											<div class="col-lg-6 m--align-right">
												<button id="btn-submit-exportar" type="button" class="btn btn-outline-info">FORMATO</button>
											</div>
										</div>
									</div>
								</div>
							</form>
							<!--end::Form-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
