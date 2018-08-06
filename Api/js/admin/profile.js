var js_profile = function(){

    var dataRecibido = $('.m_regMensajeRecibido');
    var dataEnviado  = $('.m_regMensajeRecibido');

    var datatableJsonMensaje = function() {
        if ($('.m_regMensajeRecibido').length > 0) {

            var dataRecibido = $('.m_regMensajeRecibido').mDatatable({
                translate: {
                    records: {
                        processing: 'Cargando...',
                        noRecords: 'No se encontrarón mensaje(s)'
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
                                info: 'Viendo {{start}} - {{end}} de {{total}} mensaje(s)'
                            }
                        }
                    }
                },

                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: 'view/module/administrador/administradorMensajeRecibidoTabla.php'
                        },
                    },
                },

                // layout definition
                layout: {
                    theme: 'default', // datatable theme
                    class: '', // custom wrapper class
                    scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                    footer: false // display/hide footer
                },

                // column sorting
                sortable: !1,
                pagination: !0,
                pageLength: 15,

                search: {
                    input: $('#generalSearchRecibido')
                },

                // columns definition
                columns: [{
                    field: 'id',
                    title: "#",
                    responsive: {visible: 'lg'},
                    sortable: 'desc',
                    width: 50,
                    textAlign: 'center'
                },
                {
                    field: 'para',
                    title: "PARA",
                    width: 150,
                    textAlign: 'center'
                },{
                    field: 'asunto',
                    title: "ASUNTO",
                    width: 150,
                    textAlign: 'center'
                },{
                    field: 'fecha',
                    title: "ENVIADO",
                    width: 150,
                    textAlign: 'center'
                },{
                    field: 'status',
                    title: "ESTADO",
                    // width: 50,
                    textAlign: 'center',
                    template: function (row, index, datatable) {
                        var status = {
                            0: {'title': 'Sin Leer', 'class': 'm-badge--danger'},
                            1: {'title': 'Leido', 'class': 'm-badge--success'},
                        };

                        return '<span class="m-badge '+ status[row.status].class +' m-badge--wide">'+ status[row.status].title +'</span>';
                    }
                },{
                    field: "Acciones",
                    width: 100,
                    sortable: false,
                    title: "Acciones",
                    overflow: 'visible',
                    template: function (row, index, datatable) {
                        return '<a onclick="js_profile.modalMensajViewsubmit('+ row.id +')" class="btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" title="Ver Mensaje">\
                                    <i class="fa fa-envelope-open-o"></i>\
                                </a>\
                                <a onclick="js_profile.modalMensajeDeleteSubmit('+ row.id +')" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Eliminar">\
                                    <i class="fa fa-trash"></i>\
                                </a>\
                            ';
                    }
                }]
            });

            var query = dataRecibido.getDataSourceQuery();

            $('#m_form_status').on('change', function() {
                dataRecibido.search($(this).val().toLowerCase(), 'status');
            });
        }

        if ($('.m_regMensajeEnviado').length > 0) {
            var dataEnviado = $('.m_regMensajeEnviado').mDatatable({
                translate: {
                    records: {
                        processing: 'Cargando...',
                        noRecords: 'No se encontrarón mensaje(s)'
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
                                info: 'Viendo {{start}} - {{end}} de {{total}} mensaje(s)'
                            }
                        }
                    }
                },

                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: 'view/module/administrador/administradorMensajeEnviadoTabla.php'
                        },
                    },
                },

                // layout definition
                layout: {
                    theme: 'default', // datatable theme
                    class: '', // custom wrapper class
                    scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                    footer: false // display/hide footer
                },

                // column sorting
                sortable: !1,
                pagination: !0,
                pageLength: 15,

                search: {
                    input: $('#generalSearchEnviado')
                },

                // columns definition
                columns: [{
                    field: 'id',
                    title: "#",
                    responsive: {visible: 'lg'},
                    sortable: 'desc',
                    width: 50,
                    textAlign: 'center'
                },
                {
                    field: 'para',
                    title: "PARA",
                    width: 150,
                    textAlign: 'center'
                },{
                    field: 'asunto',
                    title: "ASUNTO",
                    width: 150,
                    textAlign: 'center'
                },{
                    field: 'fecha',
                    title: "ENVIADO",
                    width: 150,
                    textAlign: 'center'
                },
                // {
                //     field: 'status',
                //     title: "ESTADO",
                //     // width: 50,
                //     textAlign: 'center',
                //     template: function (row, index, datatable) {
                //         var status = {
                //             1: {'title': 'Leido', 'class': 'm-badge--success'},
                //             0: {'title': 'Sin Leer', 'class': 'm-badge--danger'},
                //         };

                //         return '<span class="m-badge '+ status[row.status].class +' m-badge--wide">'+ status[row.status].title +'</span>';
                //     }
                // }
                // {
                //     field: "Acciones",
                //     width: 100,
                //     sortable: false,
                //     title: "Acciones",
                //     overflow: 'visible',
                    // template: function (row, index, datatable) {
                    //     return '<a onclick="js_profile.modalMensajViewsubmit('+ row.id +')" class="btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" title="Ver Mensaje">\
                    //                 <i class="fa fa-envelope-open-o"></i>\
                    //             </a>\
                    //             <a onclick="js_profile.modalMensajeDeleteSubmit('+ row.id +')" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Eliminar">\
                    //                 <i class="fa fa-trash"></i>\
                    //             </a>\
                    //         ';
                    // }
                // }
                ]
            });

            var query = dataEnviado.getDataSourceQuery();
        }
    }

    var modalMensajViewsubmit = function(id){

        $('#m-MensajeRecibido').modal('show')

        $.post('view/module/administrador/administradorModalMensajeUpdate.php',{id:id},function(data){
            $('#m_Mensaje_Recibido').html(data)
        });

        var data = {id:id, update_mensaje:1}
        $.post('view/module/administrador/administrador.php',data,function(data){
            dataRecibido.mDatatable('reload');
        })

    }

    var modalMensajeDeleteSubmit = function(id){
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
                                data: {id:id, delete_mensaje: 1},
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

    var modalUserUpdateSubmit = function(id){
        $('#m-modalDatos').modal('show');
        $.post('view/module/administrador/administradorModalDatos.php',{id:id},function(data){
            $('#m_modal_datos').html(data);
        })
    }

    var handleUserUpdateSubmit = function(){

        $("#btn-submit-user").click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    nombres: {
                        required: true
                    },
                    paterno: {
                        required: true
                    },
                    materno: {
                        required: true
                    },
                    celular1: {
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
                    nombres: {
                        required: "Por favor, Ingrese Nombre Completo."
                    },
                    paterno: {
                        required: "Por favor, Ingrese Apellido Materno."

                    },
                    materno: {
                        required: "Por favor, Ingrese Apellido Paterno."

                    },
                    celular1:{
                        required: "Por favor, Ingrese un numero Celular",
                        minlength: "Por favor, Ingrese un mumero de celular valido.",
                        digits: "Por favor, Ingrese un numero de celular valido."
                    },
                    correo: {
                        required: "Por favor, Ingresar un correo electronico.",
                        email: "Por favor, Ingrese un corre electronico valido."
                    }
                },
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            var nombres = $('#nombres').val();
            var paterno = $('#paterno').val();
            var materno = $('#materno').val();


            form.ajaxSubmit({
                type: 'POST',
                url: 'view/module/director/direccion.php',
                data: form.serialize(),
                dataType: 'json',
                success: function(response, status, xhr, $form) {


                    btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
                    $('#m-modalDatos').modal("hide");
                    if(response[0] == 1){
                        $('.m-nameuser').html(materno+" "+paterno+", "+nombres);
                        js_sistema.showErrorMsg(response[1],'success',3000);
                    }else{
                        js_sistema.showErrorMsg(response[1],'danger',3000);
                    }
                }
            });
        });

        $("#btn-cancel-user").click(function(){
            $("#btn-submit-user").removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
        });

        $("#btn-submit-password").click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 5
                    },
                    rpassword: {
                        required: true,
                        minlength: 5,
                        equalTo: '#password'
                    }

                },
                messages: { // custom messages for radio buttons and checkboxes
                    password: {
                        required: "Por favor, Ingrese una contraseña.",
                        minlength: "Por favor, Ingresar mínimo 5 caracteres."
                    },
                    rpassword: {
                        required: "Por favor, Repita la contraseña.",
                        minlength: "Por favor, Ingresar mínimo 5 caracteres.",
                        equalTo: "Por favor, Las contraseñas deben coincidir."
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
                    $('#m-modalSignIn').modal("hide");
                    if(response[0] == 1){
                        js_sistema.showErrorMsg(response[1],'success',3000);
                    }else{
                        js_sistema.showErrorMsg(response[1],'error',3000);
                    }
                }
            });
        });

        $("#btn-cancel-password").click(function(){
            $("#btn-submit-password").removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
        });

        $("#btn-submit-avatar").click(function(e){
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
                    console.log("response", response);
                    btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
                    if(response[0] == 1){
                        $('#m-modalAvatar').modal('hide');
                        js_sistema.showErrorMsg(response[1],'success');
                        $('.fotografia').removeAttr('scr');
                        $('.fotografia').attr('src',response[2]);
                    } else if(response[0] == 2) {
                        $('#m-modalAvatar').modal('show');
                        js_sistema.showErrorMsg(response[1],'warning');
                    } else {
                        $('#m-modalAvatar').modal('show');
                        js_sistema.showErrorMsg(response[1],'error');
                    }
                }
            });
        });

        $("#btn-cancel-avatar").click(function(){
            $("#btn-submit-avartar").removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
        });

        $("#btn-submit-mensaje").click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    para: { required: true },
                    asunto: { required: true },
                    texto: { required: true }
                },

                messages: { // custom messages for radio buttons and checkboxes
                    para: { required: "Por favor, Seleccionar un personal." },
                    asunto: { required: "Por favor, Ingrese un asunto." },
                    texto: { required: "Por favor, Ingrese un mensaje." }
                },
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            form.ajaxSubmit({
                type: 'POST',
                url: 'view/module/administrador/administrador.php',
                data: form.serialize(),
                dataType: 'json',
                success: function(response, status, xhr, $form) {
                    btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
                    $('#m-modalMensaje').modal("hide");
                    if(response[0] == 1){
                        btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);
                        dataEnviado.mDatatable('reload');
                        dataRecibido.mDatatable('reload');
                        js_sistema.showErrorMsg(response[1],'success',3000);
                    }else{
                        js_sistema.showErrorMsg(response[1],'danger',3000);
                    }
                }
            });
        });

        $("#btn-submit-faq").click(function(e){
        })
    }

    var modalSingInUpdateSubmit = function(id){
        $('#m-modalSignIn').modal('show');
        $.post('view/module/administrador/administradorModalPassword.php',{id:id},function(data){
            $('#m_modal_SignIn').html(data);
        })
    }

    var modalAvatarUpdateSubmit = function(id){
        $('#m-modalAvatar').modal('show');
        $.post('view/module/administrador/administradorModalFoto.php',{id:id},function(data){
            $('#m_modal_avatar').html(data);
        })
    }

    var modaleMessageUpdateSubmit = function(id){
        $('#m-modalMensaje').modal('show');
        $.post('view/module/administrador/administradorModalMensaje.php',{id:id},function(data){
            $('#m_modal_Mensaje').html(data);
        })
    }

    var modaleSopportUpdateSubmit = function(id){
        $('#m-modalSoporte').modal('show');
        $.post('view/module/administrador/administradorModalSoporte.php',{id:id},function(data){
            $('#m_modal_Soporte').html(data);
        })
    }

    var modaleFAQUpdateSubmit = function(id){
        $('#m-modalFaq').modal('show');
        $.post('view/module/administrador/administradorModalFAQ.php',{id:id},function(data){
            $('#m_modal_Faq').html(data);
        })
    }

    return{
        init: function(){
            handleUserUpdateSubmit()
            datatableJsonMensaje()
        },
        modalUserUpdateSubmit: function(id){
            modalUserUpdateSubmit(id)
        },
        modalSingInUpdateSubmit: function(id){
            modalSingInUpdateSubmit(id)
        },
        modalAvatarUpdateSubmit: function(id){
            modalAvatarUpdateSubmit(id)
        },
        modaleMessageUpdateSubmit: function(id){
            modaleMessageUpdateSubmit(id)
        },
        modaleSopportUpdateSubmit: function(id){
            modaleSopportUpdateSubmit(id)
        },
        modaleFAQUpdateSubmit: function(id){
            modaleFAQUpdateSubmit(id)
        },
        modalMensajViewsubmit: function(id){
            modalMensajViewsubmit(id)
        },
        modalMensajeDeleteSubmit(id){
            modalMensajeDeleteSubmit(id);
        }
    }
}();

$(document).ready(function(){
    js_profile.init()
})