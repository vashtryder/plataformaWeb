var js_importar = function() {
    var handleImportarEstudiante = function(){

        $('#btn_submit-importar').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            var menssage = $('.regImportar');

            menssage.html('\<div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">\
                        <div class="m-alert__icon">\
                            <i class="flaticon-danger"></i>\
                            <span></span>\
                        </div>\
                        <div class="m-alert__text">\
                            <strong>EXPORTANDO... </strong> POR FAVOR ESPERE, MIENTRA CARGA LOS REGISTROS \
                        </div>\
                    </div>\
                    ')

            form.validate({
                rules: {
                    idcolegio: {
                        required: true,
                    },
                    userfile: {
                        required: true,
                        extension: "xls|xlsx"
                    }
                },

                messages: {
                    idcolegio: {
                        required : "Por favor, Seleccione un institucin educativa."
                    },
                    userfile: {
                        required: 'Por favor, Seleccione un archivo.',
                        extension: 'El archivo seleccionado no es válido'
                    }
                },
                errorPlacement: function (error, element) {
                    if (element.closest('.form-group').parent('.input-group').length) {
                        error.insertAfter(element.parent());      // radio/checkbox?
                    } else if (element.closest('.form-group').hasClass('select2-hidden-accessible')) {
                        element.next('span').addClass('has-danger');
                        element = $("#select2-" + elem.closest('.form-group').attr("id") + "-container").parent();
                    } else {
                        error.insertAfter(element);               // default
                    }
                },
                highlight: function (element, errorClass, validClass) { // hightlight error inputs
                    var elem = $(element);
                    if (elem.closest('.form-group').hasClass("select2-hidden-accessible")) {
                       $("#select2-" + elem.attr("id") + "-container").parent().addClass('has-danger');
                    } else {
                       elem.closest('.form-group').addClass('has-danger');
                    }
                },
                unhighlight: function (element) { // revert the change done by hightlight
                    var elem = $(element);
                    if (elem.closest('.form-group').hasClass("select2-hidden-accessible")) {
                        $("#select2-" + elem.attr("id") + "-container").parent().removeClass('has-danger');
                    } else {
                         elem.closest('.form-group').removeClass('has-danger');
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            var formData = new FormData(document.getElementById("frmExportar"));

            $.ajax({
                type: "POST",
                url: "view/module/administrador/reporteImportarEstudiante.xls.php",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
                    menssage.html('\<div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-brand alert-dismissible fade show" role="alert">\
                        <div class="m-alert__icon">\
                            <i class="flaticon-exclamation-2"></i>\
                            <span></span>\
                        </div>\
                        <div class="m-alert__text">\
                            <strong>' + response +'</strong>\
                        </div>\
                    </div>\
                    ');
                }
            });
        });

        $('#btn-submit-exportar').click(function(e){
            e.preventDefault();
            $.post('view/module/administrador/reporteExportarEstudiante.xls.php',function(response){
                window.location='view/core/report/archive/'+response;
            })
        });

        $('#btn-submit-importar2').click(function(e){

            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            form.validate({

                rules: {
                    idcolegio: {
                        required: true,
                    },
                    userfile: {
                        required: true,
                        extension: "xls|xlsx"
                    }
                },

                messages: {
                    idcolegio: {
                        required : "Por favor, Seleccione un institucin educativa."
                    },
                    userfile: {
                        required: 'Por favor, Seleccione un archivo.',
                        extension: 'El archivo seleccionado no es válido'
                    }
                },
                errorPlacement: function (error, element) {
                    if (element.closest('.form-group').parent('.input-group').length) {
                        error.insertAfter(element.parent());      // radio/checkbox?
                    } else if (element.closest('.form-group').hasClass('select2-hidden-accessible')) {
                        element.next('span').addClass('has-danger');
                        element = $("#select2-" + elem.closest('.form-group').attr("id") + "-container").parent();
                    } else {
                        error.insertAfter(element);               // default
                    }
                },
                highlight: function (element, errorClass, validClass) { // hightlight error inputs
                    var elem = $(element);
                    if (elem.closest('.form-group').hasClass("select2-hidden-accessible")) {
                       $("#select2-" + elem.attr("id") + "-container").parent().addClass('has-danger');
                    } else {
                       elem.closest('.form-group').addClass('has-danger');
                    }
                },
                unhighlight: function (element) { // revert the change done by hightlight
                    var elem = $(element);
                    if (elem.closest('.form-group').hasClass("select2-hidden-accessible")) {
                        $("#select2-" + elem.attr("id") + "-container").parent().removeClass('has-danger');
                    } else {
                         elem.closest('.form-group').removeClass('has-danger');
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);
            var formData = new FormData(document.getElementById("frmExportar"));

            $.ajax({
                type: "POST",
                url: "view/module/administrador/reporteImportarDocente.xls.php",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
                    $('.regImportar').html(response)
                }
            });
        });

        $('#btn-submit-exportar2').click(function(e){
            e.preventDefault();
            $.post('view/module/administrador/reporteExportarDocente.xls.php',function(response){
                window.location='view/core/report/archive/'+response;
            })
        });

        $('#btn_submit-respuesta1').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            var menssage = $('.regImportar');

            form.validate({
                rules: {
                    userfile: {
                        required: true,
                        extension: "xls|xlsx"
                    }
                },

                messages: { // custom messages for radio buttons and checkboxes
                    userfile: {
                        required: 'Por favor, Seleccione un archivo.',
                        extension: 'El archivo seleccionado no es válido.'
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            var formData = new FormData(document.getElementById("frmImportarRespuesta"));

            $.ajax({
                type: "POST",
                url: "view/module/administrador/reporteImportarRespuesta.xls.php",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(response){
                    menssage.html('\<div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-warning alert-dismissible fade show" role="alert">\
                        <div class="m-alert__icon">\
                            <i class="flaticon-exclamation-2"></i>\
                            <span></span>\
                        </div>\
                        <div class="m-alert__text">\
                            <strong>EXPORTANDO... </strong> POR FAVOR ESPERE, MIENTRA CARGA LOS REGISTROS \
                        </div>\
                    </div>\
                    ')
                },
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
                        var e = {
                            0: { alert: "alert-danger", messages: "NO CARGO ARCHIVO Y/O HUBO UN ERROR AL IMPORTAR DATOS" },
                            1: { alert: "alert-brand", messages: "RESPUESTAS IMPORTADAS" },
                            2: { alert: "alert-warning", messages: "NO CARGO ARCHIVO EXCEL" }
                        }

                        menssage.html('\<div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert  alert-dismissible fade show '+ e[response].alert + '" role="alert">\
                            <div class="m-alert__icon">\
                                <i class="flaticon-exclamation-2"></i>\
                                <span></span>\
                            </div>\
                            <div class="m-alert__text">\
                                <strong>' + e[response].messages +'</strong>\
                            </div>\
                        </div>\
                    ');
                }
            });
        })

        $('#btn-submit-respuesta2').click(function(e){

            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');
            form.validate({
                rules: {
                    colegio: "required",
                    unidad: "required",
                    semana:"required",
                    grado: "required",
                    seccion:"required",
                    nivel: "required",
                },
                messages: {
                    colegio:"Por favor, Seleccione un institucin educativa.",
                    unidad: "Por favor, Seleccione una unidad.",
                    semana: "Por favor, Seleccione una semana.",
                    grado:  "Por favor, Seleccione un grado academico.",
                    seccion:"Por favor, Seleccione una seccion academica.",
                    nivel:  "Por favor, Seleccione un nivel academico."
                },
                errorPlacement: function (error, element) {
                    if (element.closest('.form-group').parent('.input-group').length) {
                        error.insertAfter(element.parent());      // radio/checkbox?
                    } else if (element.closest('.form-group').hasClass('select2-hidden-accessible')) {
                        element.next('span').addClass('has-danger');
                        element = $("#select2-" + elem.closest('.form-group').attr("id") + "-container").parent();
                    } else {
                        error.insertAfter(element);               // default
                    }
                },
                highlight: function (element, errorClass, validClass) { // hightlight error inputs
                    var elem = $(element);
                    if (elem.closest('.form-group').hasClass("select2-hidden-accessible")) {
                       $("#select2-" + elem.attr("id") + "-container").parent().addClass('has-danger');
                    } else {
                       elem.closest('.form-group').addClass('has-danger');
                    }
                },
                unhighlight: function (element) { // revert the change done by hightlight
                    var elem = $(element);
                    if (elem.closest('.form-group').hasClass("select2-hidden-accessible")) {
                        $("#select2-" + elem.attr("id") + "-container").parent().removeClass('has-danger');
                    } else {
                         elem.closest('.form-group').removeClass('has-danger');
                    }
                }
            });

            $('.select2Colegio, .select2Periodo, .select2Semana, .select2Grado, .select2Seccion, .select2Nivel').on('change', function () {
                $(this).valid();
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            var formData = new FormData(document.getElementById("frmExportarRespuesta"));

            $.ajax({
                type: "POST",
                url: 'view/module/administrador/reporteExportarRespuesta.xls.php',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
                    if(response == 0){
                        $('.regImportar').html('\<div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-brand alert-dismissible fade show" role="alert">\
                            <div class="m-alert__icon">\
                                <i class="flaticon-exclamation-2"></i>\
                                <span></span>\
                            </div>\
                            <div class="m-alert__text">\
                                <strong>NO EXISTE FICHAS CALIFCADAS PARA EL AULA</strong>\
                            </div>\
                        </div>\
                        ');


                    } else{
                        $('.regImportar').html('');
                        window.location='view/core/report/archive/'+response;
                    }
                }
            });
        })

    }
    return{
        init: function(){
            handleImportarEstudiante();
        }
    }
}();

$(document).ready(function(){
    js_importar.init();
    js_sistema.selects()
})