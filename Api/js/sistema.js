js_sistema = function() {
    var srtRootFile = 'Api/json';
    var showErrorMsg = function(message, type, time) {

        var content = {};

        content.message = message;

        var notify = $.notify(content, {
            element: 'body',
            type: type,
            position: null,
            spacing: 10,
            mouse_over: null,
            timer: time,
            placement: {
                from: 'top',
                align: 'right'
            },
            offset: {
                x: 30,
                y: 30
            },
            delay: 1000,
            z_index: 10000,
            animate: {
                enter: 'animated zoomIn',
                exit: 'animated zoomOutUp'
            }
        });
    }

    var plugins = function() {

        $(".m-upper").change(function() {
            $(this).val($(this).val().toUpperCase());
        });

        $('.summernote').summernote({
            height: 360,
            lang: 'es-ES'
        });

        $('#m_touchspin_1').TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'la la-plus',
            verticaldownclass: 'la la-minus',

            min: 1,
            max: 50,
            step: 1,
            decimals: 0,
            boostat: 5,
            maxboostedstep: 10
        });

        $('#m_touchspin_2').TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'la la-plus',
            verticaldownclass: 'la la-minus',
            min: 1,
            max: 30,
            step: 1,
            decimals: 0,
            boostat: 5,
            maxboostedstep: 10
        });

        $('.m_datepicker').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            orientation: "bottom left",
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            },
            autoclose: true
        });

        $('.m_datepicker').change(function() {
            var fecha = $(this).val();
            var hoy = new Date();
            var cumpleanos = new Date(fecha);
            var edad = hoy.getFullYear() - cumpleanos.getFullYear();
            var m = hoy.getMonth() - cumpleanos.getMonth();
            if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
                edad--;
            }
            $('#edad').val(edad);

        })

        $('#m_form_status, #m_form_type').selectpicker();

        $.post(srtRootFile + "/sistema/avatar.json.php", function(r) {
            $('.fotografia').removeAttr('src');
            $('.fotografia').attr('src', r.Avatar);
            console.log(r.Avatar);
        }, 'json');

        $.post(srtRootFile + "/admin/colegio.json.php", function(r) {
            $('.select2Colegio').select2({ placeholder: "COLEGIO", data: r, cache: false })
        }, 'json');

        $.post(srtRootFile + "/sistema/mensaje.json.php", function(data) {
            console.log("data", data);
            $('.m-enviado').html(data.enviado)
            $('.m-recibido').html(data.recibido)
        }, 'json')
    }

    var selects = function() {
        $('.select2Eta').select2({ placeholder: "GRUPO ETA" }),

            $.post(srtRootFile + "/admin/docente.json.php", function(r) {
                $('.select2Docente').select2({ placeholder: "DOCENTES", data: r, cache: false })
            }, 'json'),

            $.post(srtRootFile + "/admin/grado.json.php", function(r) {
                $('.select2Grado').select2({ placeholder: "GRADO ACADÉMICO", data: r, cache: false })
            }, 'json'),

            $.post(srtRootFile + "/admin/seccion.json.php", function(r) {
                $('.select2Seccion').select2({ placeholder: "SECCIÓN ACADÉMICA", data: r, cache: false })
            }, 'json'),

            $.post(srtRootFile + "/admin/nivel.json.php", function(r) {
                $('.select2Nivel').select2({ placeholder: "NIVEL ACADÉMICO", data: r, cache: false });
                $('.select2Nivel').val(3).trigger('change.select2')
            }, 'json'),

            $.post(srtRootFile + "/admin/area.json.php", function(r) {
                $('.select2Area').select2({ placeholder: "AREA ACADÉMICA", data: r, cache: false })
            }, 'json'),

            $.post(srtRootFile + "/admin/periodo.json.php", function(r) {
                $('.select2Periodo').select2({ placeholder: "UNIDAD ACADÉMICA ", data: r, cache: false })
            }, 'json'),

            $.post(srtRootFile + "/admin/proceso.json.php", function(r) {
                $('.select2Proceso').select2({ placeholder: "PROCESO", data: r, cache: false })
            }, 'json'),

            $.post(srtRootFile + "/admin/colegio.json.php", function(r) {
                $('.select2Colegio').select2({ placeholder: "COLEGIO", data: r, cache: false })
            }, 'json'),

            $.post(srtRootFile + "/admin/modulo.json.php", function(r) {
                $('.select2Modulo').select2({ placeholder: "PERFIL", data: r, cache: false })
            }, 'json'),

            $.post(srtRootFile + "/admin/curso.json.php", function(r) {
                $('.select2Curso').select2({ placeholder: "CURSO", data: r, cache: false })
            }, 'json'),

            $("#m-modalMensaje").on("shown.bs.modal", function() {
                $.post(srtRootFile + "/admin/personal.json.php", function(r) {
                    $(".selectPersonal").select2({ placeholder: "SELECCIONAR PERSONAL", data: r, cache: false })
                }, 'json')
            }),

            $.post(srtRootFile + "/director/estudiante.json.php", function(r) {
                $('.select2Estudiante').select2({ placeholder: "LISTA DE ESTUDIANTES", data: r, cache: false })
            }, 'json'),

            $('.select2Semana').select2({ placeholder: "SEMANA ETA" }),

            $('.m_datepicker').datepicker({
                language: 'es',
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                orientation: "bottom left",
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                },
                autoclose: true
            });

        $('.summernote').summernote({
            height: 360,
            lang: 'es-ES'
        });

        $('.select2-Docente').select2({ placeholder: "DOCENTES" });
    }

    var paraElegirDocente = function() {
        $('.select2Colegio').on('select2:select', function(evt) {
            e = $(this).val(),
                $.post(srtRootFile + "/director/docente.json.php", { e: e }, function(json) {
                    $('.select2-Docente').html('').select2({ placeholder: "SELECCIONAR PERSONAL", data: json, cache: false });
                }, 'json')
        })
    }

    var paraElegirSemana = function() {
        $('.select2Periodo').on('select2:select', function(evt) {
            p = $(this).val(),
                $.post(srtRootFile + "/admin/semana.json.php", { p: p }, function(json) {
                    $('.select2Semana').html('').select2({ data: json, cache: false });
                }, 'json')
        })
    }

    return {
        init: function() {
            plugins()
        },
        showErrorMsg: function(message, type, time) {
            showErrorMsg(message, type, time)
        },
        selects: function() {
            selects()
        },
        paraElegirDocente: function() {
            paraElegirDocente()
        },
        paraElegirSemana: function() {
            paraElegirSemana()
        }
    }
}();

$(document).ready(function() {
    js_sistema.init()
})