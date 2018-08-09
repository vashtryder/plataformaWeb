var js_institucion = function() {
    var datatable = $('.m_regInstitucion');

    var DatatableJsonIntitucion = function() {
        var datatable = $('.m_regInstitucion').mDatatable({
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
                        url: 'Api/json/admin/institucionTabla.json.php'
                    },
                },
                pageSize: 30,
            },

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
                    sortable: true,
                    textAlign: 'center'
                }, {
                    field: 'colegio',
                    title: "INSTITUCION EDUCATIVA",
                    // width: 250,
                    textAlign: 'center'
                }, {
                    field: 'telefono',
                    title: "TELEFONO",
                    // width: 50,
                    textAlign: 'center'
                }, {
                    field: 'email',
                    title: "EMAIL",
                    // width: 50,
                    textAlign: 'center'
                },
                {
                    field: 'web',
                    title: "WEBSITE",
                    // width: 50,
                    textAlign: 'center'
                },
                {
                    field: "Acciones",
                    width: 110,
                    sortable: false,
                    title: "Acciones",
                    overflow: 'visible',
                    template: function(row, index, datatable) {
                        return '\<a onclick="js_institucion.modalInstitucionUpdateSubmit(' + row.id + ')" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Actualizar">\
                                    <i class="flaticon-edit-1"></i>\
                                </a>\
                                <a onclick="js_institucion.modalInstitucionDeleteSubmit(' + row.id + ')" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Eliminar">\
                                    <i class="flaticon-delete-2"></i>\
                                </a>\
                            ';
                    }
                }
            ]
        });
        var query = datatable.getDataSourceQuery();
    }

    var handelInstitucionSubmit = function() {
        $('#btn-submit-new').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    nombre: {
                        required: true
                    },
                    acronimo: {
                        required: true
                    },
                    direccion: {
                        required: true
                    },
                    telefono1: {
                        required: true,
                        digits: true,
                        minlength: 9
                    },
                    correo: {
                        required: true,
                        email: true

                    }
                },

                messages: { // custom messages for radio buttons and checkboxes
                    nombre: {
                        required: "Por favor, Ingrese Nombre del colegio."
                    },
                    acronimo: {
                        required: "Por favor, Ingrese acronimo."

                    },
                    direccion: {
                        required: "Por favor, Ingrese una direccion."

                    },
                    telefono1: {
                        required: "Por favor, Ingrese un numero Celular",
                        minlength: "Por favor, Ingrese un mumero de celular valido.",
                        digits: "Por favor, Ingrese un numero de celular valido."
                    },
                    correo: {
                        required: "Por favor, Ingresar un correo electronico.",
                        email: "Por favor, Ingrese un corre electronico valido."
                    }
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

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            form.ajaxSubmit({
                type: 'POST',
                url: 'Api/core/module/admin/colegioGestor.php',
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
                url: 'Api/core/module/admin/colegioGestor.php',
                data: form.serialize(),
                dataType: 'json',
                success: function(response, status, xhr, $form) {
                    // btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
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

    var modalInstitucionNewSubmit = function() {
        $('#m_modalAgregar').modal('show');
        $.post('view/modal/admin/administradorInstitucionNew.php', function(data) {
            $('#m_modalNew').html(data);
        })
    }

    var modalInstitucionUpdateSubmit = function(id) {
        $('#m_modalActualizar').modal('show');
        $.post('view/modal/admin/administradorInstitucionUpdate.php', { id: id }, function(data) {
            $('#m_modalUpdate').html(data);
        })
    }

    var modalInstitucionDeleteSubmit = function(id) {
        bootbox.dialog({
            message: "ESTA SEGURO DE ELIMINAR",
            buttons: {
                success: {
                    label: "SI",
                    className: "btn btn-outline-success",
                    callback: function() {
                        $.ajax({
                            type: 'POST',
                            url: 'Api/core/module/admin/colegioGestor.php',
                            data: { id: id, delete_colegio: 1 },
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
            DatatableJsonIntitucion()
            handelInstitucionSubmit()
        },
        modalInstitucionNewSubmit: function() {
            modalInstitucionNewSubmit()
        },
        modalInstitucionUpdateSubmit: function(id) {
            modalInstitucionUpdateSubmit(id)
        },
        modalInstitucionDeleteSubmit: function(id) {
            modalInstitucionDeleteSubmit(id)
        }
    }
}();

$(document).ready(function() {
    js_institucion.init()
})