var js_user = function() {

    var datatable1 = $('.m_regDireccion');
    var datatable2 = $('.m_regTutor');
    var datatable3 = $('.m_regPadre');

    var DatatableJsonUser = function(){

        if ($('.m_regDireccion').length > 0) {
            var datatable = $('.m_regDireccion').mDatatable({
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
                                url: 'view/module/administrador/administradorDireccionTabla.php'
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
                    },{
                        field: 'nombre',
                        title: "APELLIDOS Y NOMBRES",
                        // width: 250,
                        textAlign: 'center'
                    }, {
                        field: 'user',
                        title: "USUARIO",
                        // width: 250,
                        textAlign: 'center'
                    },{
                        field: 'pass',
                        title: "CONTRASEÑA",
                        // width: 250,
                        textAlign: 'center'
                    },{
                        field: 'estado',
                        title: "ESTADO",
                        // width: 50,
                        textAlign: 'center',
                        template: function (row, index, datatable) {
                            var status = {
                                1: {'title': 'Habilitado', 'class': 'm-badge--success'},
                                0: {'title': 'Inhabilitado', 'class': 'm-badge--danger'},
                            };

                            return '<span class="m-badge '+ status[row.estado].class +' m-badge--wide">'+ status[row.estado].title +'</span>';
                        }
                    },{
                        field: 'colegio',
                        title: "INSTITUCIÓN EDUCATIVA",
                        // width: 50,
                        textAlign: 'center'
                    },
                    {
                        field: "Acciones",
                        width: 110,
                        sortable: false,
                        title: "Acciones",
                        overflow: 'visible',
                        template: function (row, index, datatable) {
                            var status = {
                                0: {'title': 'Habilitar', 'class': 'm-btn--hover-success','icon' : 'flaticon-user-ok', 'valor': '1'},
                                1: {'title': 'Inhabilitar', 'class':'m-btn--hover-danger','icon' : 'flaticon-cancel', 'valor': '0'},
                            };
                            return '\<a class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Actualizar">\
                                        <i class="flaticon-paper-plane"></i>\
                                    </a>\
                                    <a  onclick="js_user.handleDireccionEstadoSubmit('+ row.id+',\''+status[row.estado].valor+'\')" class="btn m-btn '+ status[row.estado].class +' m-btn--icon m-btn--icon-only m-btn--pill" title="'+status[row.estado].title+'">\
                                        <i class="'+ status[row.estado].icon +'"></i>\
                                    </a>\
                                ';
                        }
                    }]
            });
            var query = datatable.getDataSourceQuery();
        }


        if ($('.m_regTutor').length > 0) {
            var datatable = $('.m_regTutor').mDatatable({
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
                                url: 'view/module/administrador/administradorTutorTabla.php'
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
                        field: 'nombre',
                        title: "APELLIDOS Y NOMBRES",
                        // width: 250,
                        textAlign: 'center'
                    }, {
                        field: 'user',
                        title: "USUARIO",
                        // width: 250,
                        textAlign: 'center'
                    },{
                        field: 'pass',
                        title: "CONTRASEÑA",
                        // width: 250,
                        textAlign: 'center'
                    },{
                        field: 'estado',
                        title: "ESTADO",
                        // width: 50,
                        textAlign: 'center',
                        template: function (row, index, datatable) {
                            var status = {
                                1: {'title': 'Habilitado', 'class': 'm-badge--success'},
                                0: {'title': 'Inhabilitado', 'class': 'm-badge--danger'},
                            };

                            return '<span class="m-badge '+ status[row.estado].class +' m-badge--wide">'+ status[row.estado].title +'</span>';
                        }
                    },{
                        field: 'colegio',
                        title: "INSTITUCIÓN EDUCATIVA",
                        // width: 50,
                        textAlign: 'center'
                    },{
                        field: "Acciones",
                        width: 110,
                        sortable: false,
                        title: "Acciones",
                        overflow: 'visible',
                        template: function (row, index, datatable) {
                            var status = {
                                0: {'title': 'Habilitar', 'class': 'm-btn--hover-success','icon' : 'flaticon-user-ok', 'valor': '1'},
                                1: {'title': 'Inhabilitar', 'class':'m-btn--hover-danger','icon' : 'flaticon-cancel', 'valor': '0'},
                            };
                            return '\<a class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Actualizar">\
                                        <i class="flaticon-paper-plane"></i>\
                                    </a>\
                                    <a  onclick="js_user.handleDocenteEstadoSubmit('+ row.id+',\''+status[row.estado].valor+'\')" class="btn m-btn '+ status[row.estado].class +' m-btn--icon m-btn--icon-only m-btn--pill" title="'+status[row.estado].title+'">\
                                        <i class="'+ status[row.estado].icon +'"></i>\
                                    </a>\
                                ';
                        }
                    }]
            });
            var query = datatable.getDataSourceQuery();
        }

        if ($('.m_regPadre').length > 0) {
            var datatable = $('.m_regPadre').mDatatable({
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
                                url: 'view/module/administrador/administradorPadreTabla.php'
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
                        field: 'nombre',
                        title: "APELLIDOS Y NOMBRES",
                        // width: 250,
                        textAlign: 'center'
                    }, {
                        field: 'user',
                        title: "USUARIO",
                        // width: 250,
                        textAlign: 'center'
                    },{
                        field: 'pass',
                        title: "CONTRASEÑA",
                        // width: 250,
                        textAlign: 'center'
                    },{
                        field: 'estado',
                        title: "ESTADO",
                        // width: 50,
                        textAlign: 'center',
                        template: function (row, index, datatable) {
                            var status = {
                                1: {'title': 'Habilitado', 'class': 'm-badge--success'},
                                0: {'title': 'Inhabilitado', 'class': 'm-badge--danger'},
                            };

                            return '<span class="m-badge '+ status[row.estado].class +' m-badge--wide">'+ status[row.estado].title +'</span>';
                        }
                    },{
                        field: 'colegio',
                        title: "INSTITUCIÓN EDUCATIVA",
                        // width: 50,
                        textAlign: 'center'
                    },{
                        field: "Acciones",
                        width: 110,
                        sortable: false,
                        title: "Acciones",
                        overflow: 'visible',
                        template: function (row, index, datatable) {
                            var status = {
                                0: {'title': 'Habilitar', 'class': 'm-btn--hover-success','icon' : 'flaticon-user-ok', 'valor': '1'},
                                1: {'title': 'Inhabilitar', 'class':'m-btn--hover-danger','icon' : 'flaticon-cancel', 'valor': '0'},
                            };
                            return '\<a class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Actualizar">\
                                        <i class="flaticon-paper-plane"></i>\
                                    </a>\
                                    <a  onclick="js_user.handlePadreEstadoSubmit('+ row.id+',\''+status[row.estado].valor+'\')" class="btn m-btn '+ status[row.estado].class +' m-btn--icon m-btn--icon-only m-btn--pill" title="'+status[row.estado].title+'">\
                                        <i class="'+ status[row.estado].icon +'"></i>\
                                    </a>\
                                ';
                        }
                    }]
            });
            var query = datatable.getDataSourceQuery();
        }
    }

    var handleDireccionEstadoSubmit = function(id,estado) {
        $.post('view/module/administrador/administrador.php',{id:id, estado:estado, estado_director:1},function(data){
            datatable1.mDatatable('reload');
        },'json')
    }

    var handleDocenteEstadoSubmit = function(id,estado) {
        $.post('view/module/administrador/administrador.php',{id:id, estado:estado, estado_director:1},function(data){
            datatable2.mDatatable('reload');
        },'json')
    }


    var handlePadreEstadoSubmit = function(id,estado) {
        $.post('view/module/padre/padre.php',{id:id, estado:estado, estado_padre:1},function(data){
            datatable3.mDatatable('reload');
        },'json')
    }


    return{
        init: function(){
           DatatableJsonUser()
        },
        handleDireccionEstadoSubmit: function(id,estado) {
            handleDireccionEstadoSubmit(id,estado)
        },
        handlePadreEstadoSubmit: function(id,estado) {
            handlePadreEstadoSubmit(id,estado)
        }
    }
}();

$(document).ready(function(){
    js_user.init()
})




