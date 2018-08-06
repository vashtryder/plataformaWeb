var js_evento = function() {

    var initialLocaleCode = 'es';

    return {
        //main function to initiate the module
        init: function() {
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

            $('#m_calendar').fullCalendar({
                locale: initialLocaleCode,

                header: {
                    // left: 'ant,next today',
                    center: 'title',
                    // right: 'month,agendaWeek,agendaDay,listWeek'
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                navLinks: true,
                selectable: true,
                droppable: true,
                events: {
                    url: 'view/module/tutor/tutorHistoria.php',
                },
                eventRender: function(event, element) {
                    if (element.hasClass('fc-day-grid-event')) {
                        element.data('content', event.description);
                        element.data('placement', 'top');
                        mApp.initPopover(element);
                    } else if (element.hasClass('fc-time-grid-event')) {
                        element.find('.fc-title').append('<div class="fc-description">' + event.description + '</div>');
                    } else if (element.find('.fc-list-item-title').lenght !== 0) {
                        element.find('.fc-list-item-title').append('<div class="fc-description">' + event.description + '</div>');
                    };

                    element.attr('href', 'javascript:void(0);');

                    element.click(function() {
                        $('#m_modalActualizar').modal('show');

                        $.post('view/module/administrador/administradorEventoUpdate.php',function(data){
                            $('#m_modalUpdate').html(data);
                            $(".startTime").val(moment(event.start).format('YYYY-MM-DD'));
                            $(".endTime").val(moment(event.end).format('YYYY-MM-DD'));
                            $(".eventInfo").val(event.description);
                            $(".eventid").val(event.id);
                        });

                    });

                },
                select: function(startDate, endDate){
                    $('#m_modalAgregar').modal('show');
                    $.post('view/module/administrador/administradorEventoNew.php',function(data){
                        $('#m_modalNew').html(data);
                        $(".startTime").val(startDate.format());
                        $(".endTime").val(endDate.format());
                    })
                }
            });
        },
        megaupload: function() {
            $('#btn-submit-event').click(function(e) {
                e.preventDefault();  //stop the browser from following
                link = $(this).attr('href');
                window.location.href= link;
            });
        },
        modalEventoNewSubmit: function() {
            $('#m_modalAgregar').modal('show');
            $.post('view/module/administrador/administradorEventoNew.php',function(data){
                $('#m_modalNew').html(data);
            })
        },
        modalEventoUpdateSubmit:function(id){
            $('#m_modalActualizar').modal('show');
            $.post('view/module/administrador/administradorEventoUpdate.php',{id:id},function(data){
                $('#m_modalUpdate').html(data);
            })
        },
        handelEventoSubmit: function(){
            $('#btn-submit-new').click(function(e){
                e.preventDefault();
                var btn = $(this);
                var form = $(this).closest('form');

                form.validate({
                    rules: {
                        title: {
                            required: true
                        },
                        start: {
                            required: true
                        },
                        end: {
                            required: true
                        }
                    },

                    messages: { // custom messages for radio buttons and checkboxes
                        title: {
                            required: "Por favor, Ingrese titulo de evento."
                        },
                        start: {
                            required: "Por favor, Seleccione fecha inicio."
                        },
                        end: {
                            required: "Por favor, Seleccione fecha final"
                        }
                    },
                });

                if (!form.valid()) {
                    return;
                }

                btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

                var formData = new FormData(document.getElementById("from-new"));

                console.log("formData", formData);

                $.ajax({
                    type: "POST",
                    url: "view/module/administrador/administrador.php",
                    dataType: 'json',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response, status, xhr, $form, events) {
                        btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);

                        $('#m_calendar').fullCalendar('refetchEvents');
                        $('#m_calendar').fullCalendar('rerenderEvents');

                        if(response.respuestaFile == 1){
                            $('#m_modalAgregar').modal('hide');
                            js_sistema.showErrorMsg(response.message,'success');
                        } else if(response.respuestaFile == 2) {
                            $('#m_modalAgregar').modal('show');
                            js_sistema.showErrorMsg(response.message,'warning');
                        } else {
                            $('#m_modalAgregar').modal('show');
                            js_sistema.showErrorMsg(response.message,'error');
                        }
                    }
                });
            });

            $('#btn_cancel-new').click(function(e){
                $('#btn-submit-new').removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false)
            });

            $('#btn-submit-update').click(function(e){
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            btn.addClass('m-loader m-loader--right m-loader--primary').attr('disabled', true);

            form.ajaxSubmit({
                type: 'POST',
                url: 'view/module/administrador/administrador.php',
                data: form.serialize(),
                dataType: 'json',
                success: function(response, status, xhr, $form, events) {
                    btn.removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false);

                    $('#m_modalActualizar').modal("hide");

                    $('#m_calendar').fullCalendar('refetchEvents');
                    $('#m_calendar').fullCalendar('rerenderEvents');

                    if(response.respuestaFile == 1){
                        js_sistema.showErrorMsg(response.message,'success',3000);
                    }else{
                        js_sistema.showErrorMsg(response.message,'danger',3000);
                    }
                }
            });
            });

            $('#btn-cancel-update').click(function(e){
                $('#btn-submit-update').removeClass('m-loader m-loader--right m-loader--primary').attr('disabled', false)
            });

            $('#btn-submit-delete').click(function(e){
                id = $(".eventid").val();

                $('#m_modalActualizar').modal("hide");

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
                                    data: {id:id, delete_evento: 1},
                                    dataType:"json",
                                    cache: false
                                }).done(function(respuesta){
                                    if(respuesta[0] == 1){
                                        js_sistema.showErrorMsg(respuesta[1],'success',4000);

                                        $('#m_calendar').fullCalendar('refetchEvents');
                                        $('#m_calendar').fullCalendar('rerenderEvents');

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
                                $('#m_modalActualizar').modal("show");
                            }
                        }
                    }
                })
            });

            $('#btn-submit-ver').click(function(e){
                $('#m_modalActualizar').modal('hide');
                id = $('#eventid').val();
                $.post('view/module/administrador/administradorEventoVer.php',{id:id},function(response){

                    // console.log("data", response.event_end);

                    $('#m_eventContent').modal('show');

                    $("#eventid").html(response.event_id);
                    $("#eventInfo").html(response.event_description);
                    $("#startTime").html(response.event_start);
                    $("#endTime").html(response.event_end);

                    if(response.event_contact == 'media'){
                        $('#eventLink').html('<video controls width="100%" height="auto" autoplay><source src="'+ response.event_url +'" ></video>');
                        $('#btn-submit-event').attr('href',response.event_url);
                    } else {
                        $('#eventLink').html('<div class="responsive-wrapper responsive-wrapper-wxh-572x612" style="-webkit-overflow-scrolling: touch; overflow: auto;"><iframe src="'+ response.event_url +'" frameborder="0"></iframe></div>');
                        $('#btn-submit-event').attr('href',response.event_url);
                    }
                },'json')
            })
        }

    };
}();

$(document).ready(function() {
    js_evento.init();
    js_evento.handelEventoSubmit();
});