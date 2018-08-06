var js_personal = function() {
    var datatable = $('.m_regPersonal');

    var DatatableJsonPersonal = function(){
        if ($('.m_regPersonal').length > 0) {
            var datatable = $('.m_regPersonal').mDatatable({
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
                            url: 'view/module/director/direccionPersonalTabla.php'
                        },
                    },
                    pageSize: 15,
                },

                // layout definition
                layout: {
                    theme: 'default', // datatable theme
                    class: '', // custom wrapper class
                    scroll: !0, // enable/disable datatable scroll both horizontal and vertical when needed.
                    footer: !0, // display/hide footer
                    height: 750,
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
                    responsive: {visible: 'lg'},
                    sortable: 'desc',
                    width: 50,
                    locked: {
                        left: "xl",
                    },
                    textAlign: 'center'
                },
                {
                    field: 'docente',
                    title: "PERSONAL",
                    width: 250,
                    locked: {
                        left: "xl",
                    },
                    textAlign: 'center'
                },{
                    field: 'dni',
                    title: "DNI",
                    width: 100,
                    textAlign: 'center'
                },{
                    field: 'telefono',
                    title: "TELEFONO",
                    width: 100,
                    textAlign: 'center'
                },{
                    field: 'modulo',
                    title: "MODULO",
                    width: 100,
                    textAlign: 'center'
                },{
                    field: 'colegio',
                    title: "COLEGIO",
                    width: 150,
                    textAlign: 'center'
                },
                {
                    field: "Acciones",
                    width: 110,
                    sortable: false,
                    title: "Acciones",
                    overflow: 'visible',
                     locked: {
                        right: "xl",
                    },
                    template: function (row, index, datatable) {
                        return '\<a onclick="js_personal.modalPersonalUpdateSubmit('+ row.id +',1)" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Actualizar">\
                                    <i class="fa fa-edit"></i>\
                                </a>\
                                <a onclick="js_personal.modalPersonalDeleteSubmit('+ row.id +')" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Eliminar">\
                                    <i class="fa fa-trash"></i>\
                                </a>\
                            ';
                    }
                }]
            });
            var query = datatable.getDataSourceQuery();
        }
    }

    var modalPersonalNewSubmit = function(){
        $('#m_modalAgregar').modal('show');
        $.post('view/module/administrador/administradorPersonalNew.php',function(data){
            $('#m_modalNew').html(data);
            $('#m_frmPersonal').html(data)
        })
    }

    var modalPersonalNew = function() {
        id = $('#idPersonal').val();
        $.post('view/module/administrador/administradorPersonalUpdate.php',{id:id},function(data){
            $('.m_frmPersonal').html(data)
            a = $('#idcolegio').val();
            $.post("view/core/json/colegio.json.php", function (r) {
                $('.select2Colegio').select2({data: r, cache: false });
                $('.select2Colegio').val(a).trigger('change.select2')
            },'json');
            b = $('#idmodulo').val();
            $.post("view/core/json/modulo.json.php", function (r) {
                $('.select2Modulo').select2({data: r, cache: false });
                $('.select2Modulo').val(b).trigger('change.select2')
            },'json');
        })
    }

    var modalPersonalUpdateSubmit = function(id,valor){
        $('#m_modalActualizar').modal('show');
        $.post('view/module/administrador/administradorPersonalUpdate.php',{id:id,valor:valor},function(data){
            $('#m_modalUpdate').html(data);
            a = $('#idcolegio').val();
            $.post("view/core/json/colegio.json.php", function (r) {
                $('.select2Colegio').select2({data: r, cache: false });
                $('.select2Colegio').val(a).trigger('change.select2')
            },'json');
            b = $('#idmodulo').val();
            $.post("view/core/json/modulo.json.php", function (r) {
                $('.select2Modulo').select2({data: r, cache: false });
                $('.select2Modulo').val(b).trigger('change.select2')
            },'json');
        })
    }

    var handelEstudianteSubmit = function(){
        $('#btn-submit-new').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                ignore: 'input[type=hidden]',
                rules: {
                    idcolegio:"required",
                    idmodulo: "required",
                    nombre: "required",
                    paterno: "required",
                    materno: "required",
                    dni: {
                        required: true,
                        digits: true,
                        minlength: 8
                    },
                    telefono1:{
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
                    idcolegio: "Por favor, Seleccionar Institución Educativa.",
                    idmodulo: "Por favor, Seleccionar Perfil.",
                    nombre: "Por favor, Ingrese Nombre completos.",
                    paterno:"Por favor, Ingrese apellido paterno.",
                    materno: "Por favor, Ingrese apellido paterno.",
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
                    }
                },
                // errorClass: "has-danger",
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

            $('.select2Colegio, .select2Modulo').on('change', function () {
                $(this).valid();
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

        $("#btn-submit-foto").click(function(e){

            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            var formData = new FormData(document.getElementById("from-foto"));

            $.ajax({
                type: "POST",
                url: "view/module/director/direccion.php",
                dataType: 'json',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response, status, xhr, $form) {

                    btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);

                    if(response[0] == 1){
                        $('#m-modalFoto').modal('hide');
                        js_sistema.showErrorMsg(response[1],'success');
                        datatable.mDatatable('reload');
                    } else if(response[0] == 2) {
                        $('#m_modalFoto').modal('show');
                        js_sistema.showErrorMsg(response[1],'warning');
                    } else {
                        $('#m_modalFoto').modal('show');
                        js_sistema.showErrorMsg(response[1],'error');
                    }
                }
            });
        });

        $("#btn-cancel-foto").click(function(){
            $("#btn-submit-foto").removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
        });

        $("#btn-submit-personal").click(function(e){
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
                    if(response[0] == 1){
                        js_sistema.showErrorMsg(response[1],'success',3000);
                    }else{
                        js_sistema.showErrorMsg(response[1],'danger',3000);
                    }
                }
            });
        })
    }

    var modalPersonalDeleteSubmit = function(id){
        bootbox.dialog({
                message: "ESTA SEGURO DE ELIMINAR",
                buttons: {
                    success: {
                        label: "SI",
                        className: "btn btn-outline-success",
                        callback: function() {
                            $.ajax({
                                type:'POST',
                                url:'view/module/administrador/administrador.php',
                                data: {id:id, delete_periodo: 1},
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
            modalPersonalNew()
            DatatableJsonPersonal()
            handelEstudianteSubmit()
        },
        modalPersonalNewSubmit: function() {
            modalPersonalNewSubmit()
        },
        modalPersonalUpdateSubmit: function(id,valor){
            modalPersonalUpdateSubmit(id,valor)
        },
        modalPersonalDeleteSubmit: function(id) {
            modalPersonalDeleteSubmit(id)
        },
        modalMensajViewsubmit: function(id){
            modalMensajViewsubmit(id)
        },
        modalMensajeDeleteSubmit(id){
            modalMensajeDeleteSubmit(id);
        }
    }
}();

$(document).ready(function() {
    js_personal.init()
})