var js_horario = function() {
    var datatable = $('.m_regHorario');

    var DatatableJsonHorario = function(){
        var datatable = $('.m_regHorario').mDatatable({
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
                            url: 'view/module/director/direccionHorarioTabla.php'
                        },
                    },
                    pageSize: 12,
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
                    responsive: {visible: 'lg'},
                    sortable: true,
                    textAlign: 'center'
                }, {
                    field: 'docente',
                    title: "DOCENTE",
                    // width: 250,
                    textAlign: 'center'
                },{
                    field: 'curso',
                    title: "CURSO ACADÉMICO",
                    // width: 250,
                    textAlign: 'center'
                },{
                    field: 'aula',
                    title: "SALON",
                    // width: 250,
                    textAlign: 'center'
                },{
                    field: "Acciones",
                    width: 110,
                    sortable: false,
                    title: "Acciones",
                    overflow: 'visible',
                    template: function (row, index, datatable) {
                        return '\<a onclick="js_horario.modalHorarioUpdateSubmit('+ row.id +')" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Actualizar">\
                                    <i class="fa fa-edit"></i>\
                                </a>\
                                <a onclick="js_horario.modalHorarioDeleteSubmit('+ row.id +')" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Eliminar">\
                                    <i class="fa fa-trash"></i>\
                                </a>\
                            ';
                    }
                }]
        });
        var query = datatable.getDataSourceQuery();
    }

    var handelHorarioSubmit = function(){
        $('#btn-submit-new').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    Horario: {
                        required: true
                    }
                },

                messages: { // custom messages for radio buttons and checkboxes
                    Horario: {
                        required: "Por favor, Ingrese nombre de Horario académico."
                    }
                },
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            form.ajaxSubmit({
                type: 'POST',
                url: 'view/module/director/direccion.php',
                data: form.serialize(),
                dataType: 'json',
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
                    $('#m_modalAgregar').modal("hide");
                    if(response[0] == 1){
                        js_sistema.showErrorMsg(response[1],'success',3000);
                        datatable.mDatatable('reload');
                    }else{
                        js_sistema.showErrorMsg(response[1],'danger',3000);
                    }
                }
            });

        });

        $('#btn-cancel-new').click(function(e){
            $('#btn-submit-new').removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false)
        });

        $('#btn-submit-update').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            form.ajaxSubmit({
                type: 'POST',
                url: 'view/module/director/direccion.php',
                data: form.serialize(),
                dataType: 'json',
                success: function(response, status, xhr, $form) {
                    btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
                    $('#m_modalActualizar').modal("hide");
                    if(response[0] == 1){
                        js_sistema.showErrorMsg(response[1],'success',3000);
                        datatable.mDatatable('reload');
                    }else{
                        js_sistema.showErrorMsg(response[1],'danger',3000);
                    }
                }
            });
        });

        $('#btn-cancel-update').click(function(e){
            $('#btn-submit-update').removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false)
        });
    }

    var modalHorarioNewSubmit = function(){
        $('#m_modalAgregar').modal('show');
        $.post('view/module/director/direccionHorarioNew.php',function(data){
            $('#m_modalNew').html(data);
        })
    }

    var modalHorarioUpdateSubmit = function(id){
        $('#m_modalActualizar').modal('show');
        $.post('view/module/director/direccionHorarioUpdate.php',{id:id},function(data){
            $('#m_modalUpdate').html(data);
            $('#m_modalUpdate').html(data);
            a = $('#colegio').val();
            $.post("view/core/json/colegio.json.php", function (r) {
                $('.select2Colegio').select2({data: r, cache: false });
                $('.select2Colegio').val(a).trigger('change.select2')
            },'json');
            b = $('#docente').val();
            $.post("view/core/json/docente.json.php",{e:a}, function (r) {
                $('.select2Docente').select2({data: r, cache: false });
                $('.select2Docente').html().val(b).trigger('change.select2')
            },'json');
            c = $('#curso').val();
            $.post("view/core/json/curso.json.php",{e:a}, function (r) {
                $('.select2Curso').select2({data: r, cache: false });
                $('.select2Curso').html().val(c).trigger('change.select2')
            },'json');
            d = $('#grado').val();
            $.post("view/core/json/grado.json.php", function (r) {
                $('.select2Grado').select2({data: r, cache: false });
                $('.select2Grado').val(d).trigger('change.select2')
            },'json');
            e = $('#seccion').val();
            $.post("view/core/json/seccion.json.php", function (r) {
                $('.select2Seccion').select2({data: r, cache: false });
                $('.select2Seccion').val(e).trigger('change.select2')
            },'json');
            f = $('#nivel').val();
            $.post("view/core/json/nivel.json.php", function (r) {
                $('.select2Nivel').select2({data: r, cache: false });
                $('.select2Nivel').val(f).trigger('change.select2')
            },'json');
        })
    }

    var modalHorarioDeleteSubmit = function(id){
        bootbox.dialog({
            message: "ESTA SEGURO DE ELIMINAR",
            buttons: {
                success: {
                    label: "SI",
                    className: "btn btn-outline-success",
                    callback: function() {
                        $.ajax({
                            type:'POST',
                            url:'view/module/direccion/direccion.php',
                            data: {id:id, delete_horario: 1},
                            dataType:"json",
                            cache: false
                        }).done(function(respuesta){
                            if(respuesta[0] == 1){
                                js_sistema.showErrorMsg(respuesta[1],'success',4000);
                                datatable.mDatatable('reload');
                            }else{
                                js_sistema.showErrorMsg(respuesta[1],'darger',4000);
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


    return{
        init: function(){
            DatatableJsonHorario()
            handelHorarioSubmit()
        },
        modalHorarioNewSubmit: function(){
            modalHorarioNewSubmit()
        },
        modalHorarioUpdateSubmit: function(id){
            modalHorarioUpdateSubmit(id)
        },
        modalHorarioDeleteSubmit: function(id){
            modalHorarioDeleteSubmit(id)
        }

    }
}();

$(document).ready(function(){
    js_horario.init()
})