var js_pregunta = function() {
    var srtRootFile = 'Api/json';
    var datatable = $('.m_regPregunta');

    var DatatableJsonPregunta = function() {
        var datatable = $('.m_regPregunta').mDatatable({
            translate: {
                records: {
                    processing: 'Cargando...',
                    noRecords: 'No se encontrarón registros'
                },
                toolbar: {
                    pagination: {
                        items: {
                            default: {
                                first: 'Primero',
                                prev: 'Anterior',
                                next: 'Siguiente',
                                last: 'Último',
                                more: 'Más páginas',
                                input: 'Número de página',
                                select: ''
                            },
                            info: 'Viendo {{start}} - {{end}} de {{total}} registros'
                        }
                    }
                }
            },

            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: 'Api/json/admin/preguntaTabla.json.php'
                    },
                },
                pageSize: 30,
            },
            responsive: !0,
            // layout definition
            layout: {
                theme: 'default', // datatable theme
                class: '', // custom wrapper class
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,
            pagination: true,
            search: {
                input: $('#generalSearch')
            },

            // columns definition
            columns: [{
                    field: 'id',
                    title: "#",
                    responsive: { visible: 'lg' },
                    sortable: 'desc',
                    textAlign: 'center'
                }, {
                    field: 'curso',
                    title: "CURSO ACADÉMICO",
                    textAlign: 'center'
                },
                {
                    field: 'eta',
                    title: "GRUPO ETA",
                    textAlign: 'center',
                    template: function(row, index, datatable) {
                        var e = {
                            0: { grupo: "NO ASIGNADO", class: "m-badge--warning" },
                            1: { grupo: "ETA I", class: "m-badge--success" },
                            2: { grupo: "ETA II", class: "m-badge--primary" }
                        }

                        return '<span class="m-badge ' + e[row.eta].class + ' m-badge--wide">' + e[row.eta].grupo + '</span>'
                    }
                },
                {
                    field: 'pregunta',
                    title: "# PREGUNTAS",
                    textAlign: 'center'
                }, {
                    field: "Acciones",
                    sortable: false,
                    title: "Acciones",
                    overflow: 'visible',
                    template: function(row, index, datatable) {
                        return '\<a onclick="js_pregunta.modalPreguntaUpdateSubmit(' + row.id + ')" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Actualizar">\
                                    <i class="flaticon-edit-1"></i>\
                                </a>\
                                <a onclick="js_pregunta.modalPreguntaDeleteSubmit(' + row.id + ')" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Eliminar">\
                                    <i class="flaticon-delete-2"></i>\
                                </a>\
                            ';
                    }
                }
            ]
        });
        var query = datatable.getDataSourceQuery();
    }

    var handelTutorSubmit = function() {
        $('#btn-submit-new').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    curso: "required",
                    eta: "required",
                    cantidad: "required"
                },

                messages: {
                    curso: "",
                    eta: "",
                    cantidad: "Por favor, Ingrese una cantidad de preguntas."
                },
                errorPlacement: function(error, element) {
                    if (element.closest('.form-group').parent('.input-group').length) {
                        error.insertAfter(element.parent()); // radio/checkbox?
                    } else if (element.closest('.form-group').hasClass('select2-hidden-accessible')) {
                        element.next('span').addClass('has-danger');
                        element = $("#select2-" + elem.closest('.form-group').attr("id") + "-container").parent();
                    } else {
                        error.insertAfter(element); // default
                    }
                },
                highlight: function(element, errorClass, validClass) { // hightlight error inputs
                    var elem = $(element);
                    if (elem.closest('.form-group').hasClass("select2-hidden-accessible")) {
                        $("#select2-" + elem.attr("id") + "-container").parent().addClass('has-danger');
                    } else {
                        elem.closest('.form-group').addClass('has-danger');
                    }
                },
                unhighlight: function(element) { // revert the change done by hightlight
                    var elem = $(element);
                    if (elem.closest('.form-group').hasClass("select2-hidden-accessible")) {
                        $("#select2-" + elem.attr("id") + "-container").parent().removeClass('has-danger');
                    } else {
                        elem.closest('.form-group').removeClass('has-danger');
                    }
                }
            });


            $('.select2Curso, .select2Eta').on('change', function() {
                $(this).valid();
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            form.ajaxSubmit({
                type: 'POST',
                url: 'Api/core/module/admin/preguntaEtaGestor.php',
                data: form.serialize(),
                dataType: 'json',
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
                    $('#m_modalAgregar').modal("hide");
                    if (response[0] == 1) {
                        js_sistema.showErrorMsg(response[1], 'success', 3000);
                        datatable.mDatatable('reload');
                    } else {
                        js_sistema.showErrorMsg(response[1], 'danger', 3000);
                    }
                }
            });

        });

        $('#btn-cancel-new').click(function(e) {
            $('#btn-submit-new').removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false)
        });

        $('#btn-submit-update').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            form.ajaxSubmit({
                type: 'POST',
                url: 'Api/core/module/admin/preguntaEtaGestor.php',
                data: form.serialize(),
                dataType: 'json',
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
                    $('#m_modalActualizar').modal("hide");
                    if (response[0] == 1) {
                        js_sistema.showErrorMsg(response[1], 'success', 3000);
                        datatable.mDatatable('reload');
                    } else {
                        js_sistema.showErrorMsg(response[1], 'danger', 3000);
                    }
                }
            });
        });

        $('#btn-cancel-update').click(function(e) {
            $('#btn-submit-update').removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false)
        });
    }

    var modalPreguntaNewSubmit = function() {
        $('#m_modalAgregar').modal('show');
        $.post('view/modal/admin/administradorPreguntaNew.php', function(data) {
            $('#m_modalNew').html(data);
        })
    }

    var modalPreguntaUpdateSubmit = function(id) {
        $('#m_modalActualizar').modal('show');
        $.post('view/modal/admin/administradorPreguntaUpdate.php', { id: id }, function(data) {
            $('#m_modalUpdate').html(data);
            a = $('#colegio').val();
            $.post(srtRootFile + "/director/colegio.json.php", function(r) {
                $('.select2Colegio').select2({ data: r, cache: false });
                $('.select2Colegio').val(a).trigger('change.select2')
            }, 'json');
            b = $('#curso').val();
            $.post(srtRootFile + "/admin/curso.json.php", { e: a }, function(r) {
                $('.select2Curso').select2({ data: r, cache: false });
                $('.select2Curso').val(b).trigger('change.select2')
            }, 'json')
        })
    }

    var modalPreguntaDeleteSubmit = function(id) {
        bootbox.dialog({
            message: "ESTA SEGURO DE ELIMINAR",
            buttons: {
                success: {
                    label: "SI",
                    className: "btn btn-outline-success",
                    callback: function() {
                        $.ajax({
                            type: 'POST',
                            url: 'Api/core/module/admin/preguntaEtaGestor.php',
                            data: { id: id, delete_tutor: 1 },
                            dataType: "json",
                            cache: false
                        }).done(function(respuesta) {
                            if (respuesta[0] == 1) {
                                js_sistema.showErrorMsg(respuesta[1], 'success', 4000);
                                datatable.mDatatable('reload');
                            } else {
                                js_sistema.showErrorMsg(respuesta[1], 'darger', 4000);
                            }
                        })
                    }
                },
                danger: {
                    label: "NO",
                    className: "btn btn-outline-danger",
                    callback: function() {

                    }
                }
            }
        })
    }


    return {
        init: function() {
            DatatableJsonPregunta()
            handelTutorSubmit()
        },
        modalPreguntaNewSubmit: function() {
            modalPreguntaNewSubmit()
        },
        modalPreguntaUpdateSubmit: function(id) {
            modalPreguntaUpdateSubmit(id)
        },
        modalPreguntaDeleteSubmit: function(id) {
            modalPreguntaDeleteSubmit(id)
        }

    }
}();

$(document).ready(function() {
    js_pregunta.init()

})