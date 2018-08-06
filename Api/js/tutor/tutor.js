var js_tutor = function() {

    var datatable = $('.m-regSemana');

    var DatatableJsonSabana = function(){

        var datatable = $('.m-regSemana').DataTable( {
            "language": {
                "infoEmpty": "NO EXISTEN RESULTADOS",
                "info": "TOTAL: _MAX_ REGISTRO - PAGINA _PAGE_ DE _PAGES_",
                "infoFiltered": "",
                "lengthMenu": "MOSTRAR _MENU_ MENSAJE(S)",
                "search": "",
                searchPlaceholder: "BUSCAR",
                "zeroRecords": "NO SE ENCONTRARON MENSAJES",
                "paginate": {
                    "first":      "",
                    "last":       "",
                    "next":       ">>",
                    "previous":   "<<"
                }
            },
            order: [[ 0, 'asc' ]],
            searching: false,
            responsive: !0,
            scrollY:        "600px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            pagingType: "bootstrap_extended",
            retrieve: true
        } );

    }

    var reporteTutorFormSubmit = function(){

        $('#btn-submit-eta').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    grado: "required",
                    seccion: "required",
                    nivel: "required",
                },

                messages: { // custom messages for radio buttons and checkboxes
                    grado: "Por favor, Seleccione Grado.",
                    seccion: "Por favor, Seleccione Seccion.",
                    nivel: "Por favor, Seleccione Nivel."
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            form.ajaxSubmit({
                type: 'POST',
                url: 'view/module/director/direccionSemanaEta.php',
                data: form.serialize(),
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
                    $('#tablaSemanaEta').html(response);
                }
            })
        })

        $('#btn-submit-aula1').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }

            param = decodeURIComponent($('#m-reporteAula').serialize());
            var url = 'view/module/tutor/reporteAula.pdf.php?'+param
            window.open(url,'popup','width=1150,height=750');
        });

        $('#btn-submit-aula2').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }

            data = $('#m-reporteAula').serialize();
            $.post('view/module/tutor/reporteAula.xls.php',data,function(response){
                window.location='view/core/report/archive/'+response;
            })
        });

        $('#btn-submit-grado1').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }
            param = decodeURIComponent($('#m-reporteGrado').serialize());
            var url = 'view/module/tutor/reporteGrado.pdf.php?'+param
            window.open(url,'popup','width=1150,height=750');
        });

        $('#btn-submit-grado2').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }
            data = $('#m-reporteGrado').serialize();
            $.post('view/module/tutor/reporteGrado.xls.php',data,function(response){
                window.location='view/core/report/archive/'+response;
            })
        });

        $('#btn-submit-grupo1').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }
            param = decodeURIComponent($('#m-reporteGrupo').serialize());
            var url = 'view/module/tutor/reporteGrupo.pdf.php?'+param
            window.open(url,'popup','width=1150,height=750');
        });

        $('#btn-submit-grupo2').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }
            data = $('#m-reporteGrupo').serialize();
            $.post('view/module/tutor/reporteGrupo.xls.php',data,function(response){
                window.location='view/core/report/archive/'+response;
            })
        });

        $('#btn-submit-estudiante1').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    estudiante: "required",
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Estudiante.",
                }
            });

            if (!form.valid()) {
                return;
            }
            param = decodeURIComponent($('#m-reporteEstudiante').serialize());
            var url = 'view/module/tutor/reporteEstudiante.pdf.php?'+param
            window.open(url,'popup','width=1150,height=750');
        });

        $('#btn-submit-estudiante2').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    estudiante: "required",
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Estudiante.",
                }
            });

            if (!form.valid()) {
                return;
            }
            data = $('#m-reporteEstudiante').serialize();
            $.post('view/module/tutor/reporteEstudiante.xls.php',data,function(response){
                window.location='view/core/report/archive/'+response;
            })
        });

        $('#btn-submit-respuesta1').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }
            param = decodeURIComponent($('#m-reporteRespuesta').serialize());
            var url = 'view/module/tutor/reporteRespuesta.pdf.php?'+param
            window.open(url,'popup','width=1150,height=750');
        });

        $('#btn-submit-respuesta2').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }
            data = $('#m-reporteRespuesta').serialize();
            $.post('view/module/tutor/reporteRespuesta.xls.php',data,function(response){
                window.location='view/core/report/archive/'+response;
            })
        });

        $('#btn-submit-merito1').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }
            param = decodeURIComponent($('#m-reporteMerito').serialize());
            var url = 'view/module/tutor/reporteMerito.pdf.php?'+param
            window.open(url,'popup','width=1150,height=750');
        });

        $('#btn-submit-merito2').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }
            data = $('#m-reporteMerito').serialize();
            $.post('view/module/tutor/reporteMerito.xls.php',data,function(response){
                window.location='view/core/report/archive/'+response;
            })
        });

        $('#btn-submit-sabana1').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }
            param = decodeURIComponent($('#m-reporteSabana').serialize());
            var url = 'view/module/tutor/reporteSabana.pdf.php?'+param
            window.open(url,'popup','width=1150,height=750');
        });

        $('#btn-submit-sabana2').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }
            data = $('#m-reporteSabana').serialize();
            $.post('view/module/tutor/reporteSabana.xls.php',data,function(response){
                window.location='view/core/report/archive/'+response;
            })
        });

        $('#btn-submit-cudaro1').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }
            param = decodeURIComponent($('#m-reporteCuadro').serialize());
            var url = 'view/module/tutor/reporteCuadro.pdf.php?'+param
            window.open(url,'popup','width=1150,height=750');
        });

        $('#btn-submit-pdf').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }
            param = decodeURIComponent($('#m-reporteEstudiante').serialize());
            var url = 'view/module/director/reporteListaEstudiante.pdf.php?'+param
            window.open(url,'popup','width=1150,height=750');
        });

        $('#btn-submit-xls').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }            data = $('#m-reporteEstudiante').serialize();
            $.post('view/module/director/reporteListaEstudiante.xls.php',data,function(response){
                window.location='view/core/report/archive/'+response;
            })
        });

        $('#btn-submit-sabana').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    unidad: "required",
                    semana: "required"
                },

                messages: { // custom messages for radio buttons and checkboxes
                    unidad:  "Por favor, Seleccionar Unidad",
                    semana: "Por favor, Seleccionar Semana"
                },
            });

            if (!form.valid()) {
                return;
            }
            var btn = $(this);
            var form = $(this).closest('form');

            var param = { z : $('#semana').val(), u : $('#unidad').val() };
            var data  = $.param(param);
            var url   = 'view/module/tutor/reporteMeta.pdf.php?'+data

            btn.addClass('m-loader m-loader--right m-loader--info').attr('disabled', true);

            form.ajaxSubmit({
                type: 'POST',
                url: 'view/module/tutor/tutor.php',
                data: form.serialize(),
                dataType: 'json',
                success: function(response, status, xhr, $form) {
                    if(response[0] == 1){
                        js_sistema.showErrorMsg(response[1],'success',3000);
                        btn.removeClass('m-loader m-loader--right m-loader--info').attr('disabled', false);


                        window.open(url,'popup','width=1150,height=750');
                        console.log("url,", url,);

                    }else{
                        js_sistema.showErrorMsg(response[1],'danger',3000);
                    }
                }
            });
        })
    }

    var handleSabanaEtaSubmit = function(unidad,semana){
        var myParam = {unidad:unidad, semana:semana};
        var param = $.param( myParam );
        var url = 'view/module/tutor/reporteSemana.pdf.php?'+param
        window.open(url,'popup','width=1150,height=750');
    }

    var handleSabanaExcelSubmit = function(unidad,semana){
        var myParam = {unidad:unidad, semana:semana};
        data = $('#m-reporteEstudiante').serialize();
        $.post('view/module/tutor/reporteSemana.xls.php',myParam,function(response){
            window.location='view/core/report/archive/'+response;
        })
    }

    return{
        init: function(){
            reporteTutorFormSubmit()
            DatatableJsonSabana()
        },
        handleSabanaEtaSubmit: function(unidad,semana) {
            handleSabanaEtaSubmit(unidad,semana)
        },
        handleSabanaExcelSubmit: function(unidad,semana) {
            handleSabanaExcelSubmit(unidad,semana)
        }

    }
}();

$(document).ready(function(){
    js_tutor.init()
    js_sistema.selects()
})