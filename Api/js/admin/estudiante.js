var js_estudiante = function() {
    var datatable = $('.m_regEstudiante');

    var DatatableJsonEstudiante = function() {

        if ($('.m_regEstudiante').length > 0) {

            var datatable = $('.m_regEstudiante').mDatatable({
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
                            url: 'Api/json/admin/matriculaTabla.json.php'
                        },
                    },
                    pageSize: 30,
                },

                // layout definition
                layout: {
                    theme: "default",
                    class: "",
                    scroll: !0,
                    height: 750,
                    footer: !0
                },
                sortable: !0,
                filterable: !1,
                pagination: !0,
                search: {
                    input: $("#generalSearch")
                },


                serverPaging: !0,
                serverFiltering: !0,
                serverSorting: !0,

                // columns definition
                columns: [{
                        field: 'id',
                        title: "#",
                        sortable: 'desc',
                        textAlign: 'center',
                        width: 50,
                        locked: {
                            left: "xl",
                        },
                    }, {
                        field: 'nombre',
                        title: "ESTUDANTE",
                        textAlign: 'center',
                        width: 250,
                        locked: {
                            left: "xl",
                        },
                    }, {
                        field: 'codigo',
                        title: "CODIGO ETA",
                        width: 50,
                        textAlign: 'center',
                    }, {
                        field: "foto",
                        title: "FOTO",
                        width: 50,
                        textAlign: 'center',
                        template: function(row, index, datatable) {
                            return '<div class="m-card-user m-card-user--sm">\
                            <div class="m-card-user__pic">\
                                <img src="assets/media/img/estudiante/' + row.foto + '" class="m--img-rounded m--marginless" alt="photo">\
                            </div>\
                        </div>';
                        }
                    }, {
                        field: 'aula',
                        title: "SALON",
                        width: 150,
                        textAlign: 'center'
                    }, {
                        field: 'anio',
                        title: "AÑO",
                        textAlign: 'center'

                    }, {
                        field: 'colegio',
                        title: "INSTUTICIÓN EDUCATIVA",
                        width: 150,
                        textAlign: 'center'
                    },
                    {
                        field: "Acciones",
                        sortable: false,
                        title: "Acciones",
                        overflow: 'visible',
                        textAlign: 'center',
                        locked: {
                            right: "xl",
                        },
                        template: function(row, index, datatable) {
                            var status = {
                                1: { icon: 'flaticon-delete-2', class: 'm-btn--hover-danger', valor: '0', title: "Deshabilitar" },
                                0: { icon: 'flaticon-user-ok', class: 'm-btn--hover-success', valor: '1', title: "Habilitar" },
                            };
                            return '\<a onclick="js_estudiante.modalEstudianteUpdateSubmit(' + row.id + ')" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Actualizar">\
                                        <i class="flaticon-edit-1"></i>\
                                    </a>\
                                    <a onclick="js_estudiante.modalEstudianteAvatarSubmit(' + row.id + ',\'' + row.foto + '\')" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Fotografia">\
                                        <i class="flaticon-profile"></i>\
                                    </a>\
                                    \<a onclick="js_estudiante.modalEstudianteEstadoSubmit(' + row.id + ',' + status[row.estado].valor + ')" class="btn m-btn ' + status[row.estado].class + ' m-btn--icon m-btn--icon-only m-btn--pill" title="' + status[row.estado].title + '">\
                                                <i class="' + status[row.estado].icon + '"></i>\
                                        </a>\
                                    ';


                        }
                    }
                ]
            });
            var query = datatable.getDataSourceQuery();
        }
    }

    var modalEstudianteSubmit = function(id) {
        var url = "view/modal/tutor/modalSemanal.php?e=" + id;
        window.open(url, 'popup', 'width=1150,height=850')
    }

    var handelEstudianteSubmit = function() {
        $('#btn-submit-new').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    idcolegio: {
                        required: true
                    },
                    nombre: {
                        required: true
                    },
                    paterno: {
                        required: true
                    },
                    materno: {
                        required: true
                    },
                    dni: {
                        required: true,
                        digits: true,
                        minlength: 8
                    },
                    telefono1: {
                        required: true,
                        digits: true,
                        minlength: 9
                    },
                    correo: {
                        required: true,
                        email: true
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
                    idcolegio: {
                        required: ""
                    },
                    nombre: {
                        required: "Por favor, Ingrese Nombre completos."
                    },
                    paterno: {
                        required: "Por favor, Ingrese apellido paterno."
                    },
                    materno: {
                        required: "Por favor, Ingrese apellido materno."
                    },
                    dni: {
                        required: "Por favor, Ingrese numero del DNI.",
                        minlength: "Por favor, Ingrese 8 digitos del DNI.",
                        digits: "Por favor, Ingrese un numero DNI valido."
                    },
                    telefono1: {
                        required: "Por favor, Ingrese un numero Celular",
                        minlength: "Por favor, Ingrese un mumero de celular valido.",
                        digits: "Por favor, Ingrese un numero de celular valido."
                    },
                    correo: {
                        required: "Por favor, Ingresar un correo electronico.",
                        email: "Por favor, Ingrese un corre electronico valido."
                    },
                    grado: {
                        required: ""
                    },
                    seccion: {
                        required: ""
                    },
                    nivel: {
                        required: ""
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.closest('.form-group').parent('.input-group').length) {
                        error.insertAfter(element.parent()); // radio/checkbox?
                    } else if (element.closest('.form-group').hasClass('select2-hidden-accessible')) {
                        element.closest('.form-group').hasClass('select2-hidden-accessible').next('span').addClass('has-danger');
                        element = $("#select2-" + element.closest('.form-group').attr("id") + "-container").parent();
                    } else {
                        error.insertAfter(element); // default
                    }
                    $(element).closest('.form-group').parent('.m-input-icon').children('i');
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

            $('.select2Colegio, .select2Grado, .select2Seccion, .select2Nivel').on('change', function() {
                $(this).valid();
            });


            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            form.ajaxSubmit({
                type: 'POST',
                url: 'Api/core/module/admin/estudianteGestor.php',
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

        $('#btn_cancel-new').click(function(e) {
            $('#btn-submit-new').removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false)
        });

        $('#btn-submit-update').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            form.ajaxSubmit({
                type: 'POST',
                url: 'Api/core/module/admin/estudianteGestor.php',
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

        $("#btn-submit-foto").click(function(e) {

            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            var formData = new FormData(document.getElementById("from-foto"));

            $.ajax({
                type: "POST",
                url: "Api/core/module/admin/estudianteGestor.php",
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response, status, xhr, $form) {

                    btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);

                    if (response[0] == 1) {
                        $('#m-modalFoto').modal('hide');
                        js_sistema.showErrorMsg(response[1], 'success');
                        datatable.mDatatable('reload');
                    } else if (response[0] == 2) {
                        $('#m_modalFoto').modal('show');
                        js_sistema.showErrorMsg(response[1], 'warning');
                    } else {
                        $('#m_modalFoto').modal('show');
                        js_sistema.showErrorMsg(response[1], 'error');
                    }
                }
            });
        });

        $("#btn-cancel-foto").click(function() {
            $("#btn-submit-foto").removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
        });
    }

    var modalEstudianteEstadoSubmit = function(id, estado) {
        $.post('Api/core/module/admin/estudianteGestor.php', { id: id, estado: estado, estado_estudiante: 1 }, function(data) {
            datatable.mDatatable('reload');
            if (estado == 0) {
                js_sistema.showErrorMsg('ESTUDIANTE DESHABILITADO', 'warning', 3000);
            } else {
                js_sistema.showErrorMsg('ESTUDIANTE HABILITADO', 'success', 3000);
            }
        })
    }

    var modalEstudianteNewSubmit = function() {
        $('#m_modalAgregar').modal('show');
        $.post('view/modal/director/direccionMatriculaNew.php', function(data) {
            $('#m_modalNew').html(data);
        })
    }

    var modalEstudianteAvatarSubmit = function(id, foto) {
        $('#m-modalFoto').modal('show');
        $.post('view/modal/director/direccionMatriculaAvatar.php', { id: id, foto: foto }, function(data) {
            $('#m_Avatar').html(data);
        })
    }

    var modalEstudianteUpdateSubmit = function(id) {
        $('#m_modalActualizar').modal('show');
        $.post('view/modal/director/direccionMatriculaUpdate.php', { id: id }, function(data) {
            $('#m_modalUpdate').html(data);

            a = $('#idgrado').val(),
                $.post("view/core/json/grado.json.php", function(r) {
                    $('.select2Grado').select2({ data: r, cache: false });
                    $('.select2Grado').val(a).trigger('change.select2')
                }, 'json');

            b = $('#idseccion').val(),
                $.post("view/core/json/seccion.json.php", function(r) {
                    $('.select2Seccion').select2({ data: r, cache: false });
                    $('.select2Seccion').val(b).trigger('change.select2')
                }, 'json');

            c = $('#idnivel').val(),
                $.post("view/core/json/nivel.json.php", function(r) {
                    $('.select2Nivel').select2({ data: r, cache: false });
                    $('.select2Nivel').val(c).trigger('change.select2')
                }, 'json');

            d = $('#idcolegio').val(),
                $.post("view/core/json/colegio.json.php", function(r) {
                    $('.select2Colegio').select2({ data: r, cache: false });
                    $('.select2Colegio').val(d).trigger('change.select2')
                }, 'json')

        })
    }

    var modalEstudianteDeleteSubmit = function(id) {}


    return {
        init: function() {
            handelEstudianteSubmit()
            DatatableJsonEstudiante()
        },
        modalEstudianteSubmit: function(id) {
            modalEstudianteSubmit(id)
        },
        modalEstudianteNewSubmit: function() {
            modalEstudianteNewSubmit()
        },
        modalEstudianteUpdateSubmit: function(id) {
            modalEstudianteUpdateSubmit(id)
        },
        modalEstudianteDeleteSubmit: function(id) {
            modalEstudianteDeleteSubmit(id)
        },
        modalEstudianteAvatarSubmit(id, foto) {
            modalEstudianteAvatarSubmit(id, foto);
        },
        modalEstudianteEstadoSubmit(id, estado) {
            modalEstudianteEstadoSubmit(id, estado);
        }

    }
}();

$(document).ready(function() {
    js_estudiante.init()
    js_sistema.selects();
})