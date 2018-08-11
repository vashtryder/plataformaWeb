var js_asignacion = function() {
    var srtRootFile = 'Api/json';
    var datatable = $('.m_regAsignacion');

    var DatatableJsonAsignacion = function() {
        var datatable = $('.m_regAsignacion').mDatatable({
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
                        url: 'Api/json/admin/asignacionTabla.json.php'
                    },
                },
                pageSize: 10,
            },

            // layout definition
            layout: {
                theme: 'default', // datatable theme
                class: '', // custom wrapper class
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: !0,
            pagination: !0,

            search: {
                input: $('#generalSearch')
            },

            // columns definition
            columns: [{
                    field: 'id',
                    title: "#",
                    responsive: { visible: 'lg' },
                    sortable: true,
                    textAlign: 'center'
                }, {
                    field: 'docente',
                    title: "DOCENTE",
                    width: 150,
                    textAlign: 'center'
                },
                {
                    field: 'grado',
                    title: "GRADO",
                    width: 60,
                    textAlign: 'center'
                },
                {
                    field: 'seccion',
                    title: "SECCION",
                    width: 70,
                    textAlign: 'center'
                },
                {
                    field: 'nivel',
                    title: "NIVEL",
                    width: 100,
                    textAlign: 'center'
                }, {
                    field: 'colegio',
                    title: "INSTITUCIÓN EDUCATIVA",
                    width: 100,
                    textAlign: 'center'
                }, {
                    field: "Acciones",
                    width: 110,
                    sortable: false,
                    title: "Acciones",
                    overflow: 'visible',
                    template: function(row, index, datatable) {
                        return '\<a onclick="js_asignacion.modalAsignacionUpdateSubmit(' + row.id + ')" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Actualizar">\
                                    <i class="flaticon-edit-1"></i>\
                                </a>\
                                <a onclick="js_asignacion.modalAsignacionDeleteSubmit(' + row.id + ')" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Eliminar">\
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
                    colegio: {
                        required: true
                    },
                    docente: {
                        required: true
                    },
                    grado: {
                        required: true
                    },
                    seccion: {
                        required: true
                    },
                    nivel: {
                        required: true
                    }
                },

                messages: { // custom messages for radio buttons and checkboxes
                    colegio: {
                        required: "Por favor, Seleccionar una Instittucion Educativa."
                    },
                    docente: {
                        required: "Por favor, Seleccionar un docente."
                    },
                    grado: {
                        required: "Por favor, Seleccionar un grado académico."
                    },
                    seccion: {
                        required: "Por favor, Seleccionar una seccion académica"
                    },
                    nivel: {
                        required: "Por favor, Seleccionar un nivel académico."
                    }
                },
            });

            $('.select2Colegio, .select2-Docente, .select2Grado, .select2Seccion, .select2Nivel').on('change', function() {
                $(this).valid();
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            form.ajaxSubmit({
                type: 'POST',
                url: 'Api/core/module/admin/tutorGestor.php',
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

            // btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            form.ajaxSubmit({
                type: 'POST',
                url: 'Api/core/module/admin/tutorGestor.php',
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

    var modalAsignacionNewSubmit = function() {
        $('#m_modalAgregar').modal('show');
        $.post('view/modal/admin/administradorAsignacionNew.php', function(data) {
            $('#m_modalNew').html(data);
        })
    }

    var modalAsignacionUpdateSubmit = function(id) {
        $('#m_modalActualizar').modal('show');
        $.post('view/modal/admin/administradorAsignacionUpdate.php', { id: id }, function(data) {
            $('#m_modalUpdate').html(data);
            a = $('#colegio').val();
            $.post(srtRootFile + "/admin/colegio.json.php", function(r) {
                $('.select2Colegio').select2({ data: r, cache: false });
                $('.select2Colegio').val(a).trigger('change.select2')
            }, 'json');
            b = $('#docente').val();
            $.post(srtRootFile + "/director/docente.json.php", { e: a }, function(r) {
                $('.select2-Docente').select2({ data: r, cache: false });
                $('.select2-Docente').html().val(b).trigger('change.select2')
            }, 'json');
            c = $('#grado').val();
            $.post(srtRootFile + "/admin/grado.json.php", function(r) {
                $('.select2Grado').select2({ data: r, cache: false });
                $('.select2Grado').val(c).trigger('change.select2')
            }, 'json');
            d = $('#seccion').val();
            $.post(srtRootFile + "/admin/seccion.json.php", function(r) {
                $('.select2Seccion').select2({ data: r, cache: false });
                $('.select2Seccion').val(d).trigger('change.select2')
            }, 'json');
            e = $('#nivel').val();
            $.post(srtRootFile + "/admin/nivel.json.php", function(r) {
                $('.select2Nivel').select2({ data: r, cache: false });
                $('.select2Nivel').val(e).trigger('change.select2')
            }, 'json');
        })
    }

    var modalAsignacionDeleteSubmit = function(id) {
        bootbox.dialog({
            message: "ESTA SEGURO DE ELIMINAR",
            buttons: {
                success: {
                    label: "SI",
                    className: "btn btn-outline-success",
                    callback: function() {
                        $.ajax({
                            type: 'POST',
                            url: 'Api/core/module/admin/tutorGestor.php',
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
            DatatableJsonAsignacion()
            handelTutorSubmit()
        },
        modalAsignacionNewSubmit: function() {
            modalAsignacionNewSubmit()
        },
        modalAsignacionUpdateSubmit: function(id) {
            modalAsignacionUpdateSubmit(id)
        },
        modalAsignacionDeleteSubmit: function(id) {
            modalAsignacionDeleteSubmit(id)
        }

    }
}();

$(document).ready(function() {
    js_asignacion.init()

})