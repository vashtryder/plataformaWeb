var js_estudiante = function(){
    var datatable = $('.m_regEstudiante');

    var DatatableJsonEstudiante = function(){
        if ($('.m_regEstudiante').length > 0) {
            var datatable = $('.m_regEstudiante').mDatatable({
                    translate: {
                        records:{
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
                                url: 'view/module/director/direccionMatriculaTabla.php'
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
                        sortable: 'desc',
                        width: 30,
                        textAlign: 'center'
                    }, {
                        field: 'codigo',
                        title: "CODIGO ETA",
                        width: 55,
                        textAlign: 'center'
                    },{
                        field: 'nombre',
                        title: "ESTUDANTE",
                        width: 120,
                        textAlign: 'center'
                    },{
                        field: "foto",
                        title: "FOTO",
                        width: 40,
                        textAlign: 'center',
                        template: function (row, index, datatable){
                        return '<div class="m-card-user m-card-user--sm">\
                            <div class="m-card-user__pic">\
                                <img src="view/img/estudiante/'+ row.foto +'" class="m--img-rounded m--marginless" alt="photo">\
                            </div>\
                        </div>';
                        }
                    },{
                        field: 'aula',
                        title: "SALON",
                        width: 100,
                        textAlign: 'center'
                    },{
                        field: 'anio',
                        title: "AÑO",
                        width: 36,
                        textAlign: 'center'

                    },
                    {
                        field: "Acciones",
                        width: 150,
                        sortable: false,
                        title: "Acciones",
                        overflow: 'visible',
                        textAlign: 'center',
                        template: function (row, index, datatable) {
                            var status = {
                                0: {'title': 'fa-remove', 'class': 'm-btn--hover-danger', 'valor': '1'},
                                1: {'title': 'fa-check', 'class': 'm-btn--hover-success', 'valor': '0'},
                            };
                            return '\<a onclick="js_estudiante.modalEstudianteUpdateSubmit('+ row.id +')" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Actualizar">\
                                        <i class="fa fa-pencil"></i>\
                                    </a>\
                                    <a onclick="js_estudiante.modalEstudianteAvatarSubmit('+ row.id+',\''+row.foto+'\')" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Fotografia">\
                                        <i class="fa fa-user-circle-o"></i>\
                                    </a>\
                                    \<a onclick="js_estudiante.modalEstudianteEstadoSubmit('+ row.id +','+ status[row.estado].valor +')" class="btn m-btn ' + status[row.estado].class + ' m-btn--icon m-btn--icon-only m-btn--pill" title="Activar">\
                                                <i class="fa ' + status[row.estado].title + '"></i>\
                                        </a>\
                                    ';


                        }
                    }]
            });
            var query = datatable.getDataSourceQuery();
        }
    }

    var modalEstudianteSubmit = function(id){
        var url="view/core/php/tutor/modalSemanal.php?e="+id;
        window.open(url,'popup','width=1150,height=850')
    }

    var handleJsonChart = function(){
        var chart = AmCharts.makeChart("chartdiv", {
          "type": "serial",
          "theme": "none",
          "marginRight": 70,
          "dataProvider": [{
            "country": "ETA 01",
            "visits": 70,
            "color": "#0D8ECF"
          },{
            "country": "ETA 02",
            "visits": 50,
            "color": "#04D215"
          },{
            "country": "ETA 03",
            "visits": 40,
            "color": "#FF6600"
          },{
            "country": "ETA 03",
            "visits": 44,
            "color": "#FF6600"
          },{
            "country": "ETA 03",
            "visits": 34,
            "color": "#FF6600"
          },{
            "country": "ETA 03",
            "visits":45,
            "color": "#FF6600"
          }],
          "valueAxes": [{
            "axisAlpha": 0,
            "position": "left",
            "title": ""
          }],
          "startDuration": 1,
          "graphs": [{
            "balloonText": "<b>[[value]]%</b>",
            "fillColorsField": "color",
            "fillAlphas": 0.9,
            "lineAlpha": 0.2,
            "type": "column",
            "valueField": "visits"
          }],
          "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": false
          },
          "categoryField": "country",
          "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 45
          },
          "export": {
            "enabled": false
          }
        });
    }

    var handelEstudianteSubmit = function(){
        $('#btn-submit-new').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    nombre: {
                        required: true
                    },
                    paterno:{
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
                    nombre: {
                        required: "Por favor, Ingrese Nombre completos."
                    },
                    paterno: {
                        required: "Por favor, Ingrese apellido paterno."
                    } ,
                    materno: {
                        required: "Por favor, Ingrese apellido paterno."
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
    }

    var modalEstudianteEstadoSubmit = function(id,estado) {
        $.post('view/module/director/direccion.php',{id:id, estado:estado, estado_estudiante:1},function(data){
            if(data == 0){
                js_sistema.showErrorMsg('ESTUDIANTE DESCTIVADO','warning',3000);
                datatable.mDatatable('reload');
            } else {
                js_sistema.showErrorMsg('ESTUDIANTE ACTIVADO','success',3000);
            }
        })
    }

    var modalEstudianteNewSubmit = function(){
        $('#m_modalAgregar').modal('show');
        $.post('view/module/director/direccionMatriculaNew.php',function(data){
            $('#m_modalNew').html(data);
        })
    }

    var modalEstudianteAvatarSubmit = function(id,foto){
        $('#m-modalFoto').modal('show');
        $.post('view/module/director/direccionMatriculaAvatar.php',{id:id,foto:foto},function(data){
            $('#m_Avatar').html(data);
        })
    }

    var modalEstudianteUpdateSubmit = function(id){
        $('#m_modalActualizar').modal('show');
        $.post('view/module/director/direccionMatriculaUpdate.php',{id:id},function(data){
            $('#m_modalUpdate').html(data);

            a = $('#idgrado').val(),
            $.post("view/core/json/grado.json.php", function (r) {
                $('.select2Grado').select2({data: r, cache: false });
                $('.select2Grado').val(a).trigger('change.select2')
            },'json');

            b = $('#idseccion').val(),
            $.post("view/core/json/seccion.json.php", function (r) {
                $('.select2Seccion').select2({data: r, cache: false });
                $('.select2Seccion').val(b).trigger('change.select2')
            },'json');

            c = $('#idnivel').val(),
            $.post("view/core/json/nivel.json.php", function (r) {
                $('.select2Nivel').select2({data: r, cache: false });
                $('.select2Nivel').val(c).trigger('change.select2')
            },'json');

            d = $('#idcolegio').val(),
            $.post("view/core/json/colegio.json.php", function (r) {
                $('.select2Colegio').select2({data: r, cache: false });
                $('.select2Colegio').val(d).trigger('change.select2')
            },'json')

        })
    }

    var modalEstudianteDeleteSubmit = function(id){
    }


    return{
        init: function(){
            handleJsonChart()
            DatatableJsonEstudiante()
            handelEstudianteSubmit()
        },
        modalEstudianteSubmit: function(id){
            modalEstudianteSubmit(id)
        },
        modalEstudianteNewSubmit: function(){
            modalEstudianteNewSubmit()
        },
        modalEstudianteUpdateSubmit: function(id){
            modalEstudianteUpdateSubmit(id)
        },
        modalEstudianteDeleteSubmit: function(id){
            modalEstudianteDeleteSubmit(id)
        },
        modalEstudianteAvatarSubmit(id,foto){
            modalEstudianteAvatarSubmit(id,foto);
        },
        modalEstudianteEstadoSubmit(id,estado){
            modalEstudianteEstadoSubmit(id,estado);
        }

    }
}();

$(document).ready(function(){
    js_estudiante.init()
})

// <a onclick="js_estudiante.modalEstudianteDeleteSubmit('+ row.id +')" class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Eliminar">\
//                                     <i class="fa fa-trash"></i>\
//                                 // </a>\