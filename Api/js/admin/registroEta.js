var js_eta = function() {

    var calificarSubmit = function(id) {
        var table = '#calificarEta_' + id;
        var formdata = $(table).serialize();
        mApp.block(table + " .m-form__group", {
            overlayColor: "#000000",
            type: "loader",
            state: "info",
            message: "Procesando...",
            size: "lg"
        })

        $.ajax({
            type: 'POST',
            url: 'Api/core/module/admin/registroEtaGestor.php',
            data: formdata,
            dataType: "json",
            cache: false
        }).done(function(respuesta) {
            if (respuesta[0] == 1) {
                mApp.unblock(table + " .form-group");
                js_sistema.showErrorMsg(respuesta[1], 'success', 4000);
                js_eta.init();
                js_sistema.selects();
            } else {
                js_sistema.showErrorMsg(respuesta[1], 'darger', 4000);
            }
        })
    }

    var eliminarSubmit = function(tabla) {

        bootbox.dialog({
            message: "ESTA SEGURO DE ELIMINAR",
            buttons: {
                success: {
                    label: "SI",
                    className: "btn btn-outline-success",
                    callback: function() {
                        $.ajax({
                            type: 'POST',
                            url: 'Api/core/module/admin/registroEtaGestor.php',
                            data: { tabla: tabla, delete_registro: 1 },
                            dataType: "json",
                            cache: false
                        }).done(function(respuesta) {
                            if (respuesta[0] == 1) {
                                js_sistema.showErrorMsg(respuesta[1], 'success', 4000);
                                js_eta.init();
                                js_sistema.selects();
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

    var verTablaRegistro = function() {
        $.post("Api/json/admin/administradorEtaTabla.php", function(data) {
            $('#tablaRegistro').html(data);
        })
    };

    return {
        init: function() {
            verTablaRegistro();
        },
        calificarSubmit: function(id) {
            calificarSubmit(id)
        },
        eliminarSubmit: function(tabla) {
            eliminarSubmit(tabla)
        }
    }
}();

$(document).ready(function() {
    js_eta.init();
    js_sistema.selects();

})