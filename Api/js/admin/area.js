var js_area = function() {
    var datatable = $('.m_regArea');
    var DatatableJsonArea = function() {
        var datatable = $('.m_regArea').mDatatable({
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
                        url: 'Api/json/admin/areaTabla.json.php'
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
                field: 'area',
                title: "AREA ACADÉMICA",
                // width: 250,
                textAlign: 'center'
            }, {
                field: 'nivel',
                title: "NIVEL",
                // width: 250,
                textAlign: 'center'
            }, {
                field: "Acciones",
                width: 110,
                sortable: false,
                title: "Acciones",
                overflow: 'visible',
                template: function(row, index, datatable) {
                    return '\<a onclick="js_area.modalAreaUpdateSubmit(' + row.id + ')" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Actualizar">\
                                    <i class="flaticon-edit-1"></i>\
                                </a>\
                                <a onclick="js_area.modalAreaDeleteSubmit(' + row.id + ')" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Eliminar">\
                                    <i class="flaticon-delete-2"></i>\
                                </a>\
                            ';
                }
            }]
        });
        var query = datatable.getDataSourceQuery();
    }

    var handelAreaSubmit = function() {
        $('#btn-submit-new').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    area: {
                        required: true
                    }
                },

                messages: { // custom messages for radio buttons and checkboxes
                    area: {
                        required: "Por favor, Ingrese nombre de área académica."
                    }
                },
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            form.ajaxSubmit({
                type: 'POST',
                url: 'Api/core/module/admin/areaGestor.php',
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
                url: 'Api/core/module/admin/areaGestor.php',
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


    var modalAreaNewSubmit = function() {
        $('#m_modalAgregar').modal('show');
        $.post('view/modal/admin/administradorAreaNew.php', function(data) {
            $('#m_modalNew').html(data);
        })
    }

    var modalAreaUpdateSubmit = function(id) {
        $('#m_modalActualizar').modal('show');
        $.post('view/modal/admin/administradorAreaUpdate.php', { id: id }, function(data) {
            $('#m_modalUpdate').html(data);
            a = $('#idnivel').val();
            $.post("view/core/json/nivel.json.php", function(r) {
                $('.select2Nivel').select2({ data: r, cache: false });
                $('.select2Nivel').val(a).trigger('change.select2')
            }, 'json');
        })
    }

    var modalAreaDeleteSubmit = function(id) {
        bootbox.dialog({
            message: "ESTA SEGURO DE ELIMINAR",
            buttons: {
                success: {
                    label: "SI",
                    className: "btn btn-outline-success",
                    callback: function() {
                        $.ajax({
                            type: 'POST',
                            url: 'Api/core/module/admin/areaGestor.php',
                            data: { id: id, delete_area: 1 },
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
            DatatableJsonArea()
            handelAreaSubmit()
        },
        modalAreaNewSubmit: function() {
            modalAreaNewSubmit()
        },
        modalAreaUpdateSubmit: function(id) {
            modalAreaUpdateSubmit(id)
        },
        modalAreaDeleteSubmit: function(id) {
            modalAreaDeleteSubmit(id)
        }

    }
}();

$(document).ready(function() {
    js_area.init()

})