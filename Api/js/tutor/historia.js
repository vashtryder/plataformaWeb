var js_historia = function() {

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
                        $('#eventContent').modal('show');
                        $("#startTime").html(moment(event.start).format('YYYY-MM-DD'));
                        $("#endTime").html(moment(event.end).format('YYYY-MM-DD'));
                        $("#eventInfo").html(event.description);

                        if(event.contact == 'media'){
                            $('#eventLink').html('<video controls width="100%" height="auto" autoplay><source src="'+ event.url +'" ></video>');
                            $('#btn-submit-event').attr('href',event.url);
                        } else {
                        $('#eventLink').html('<div class="responsive-wrapper responsive-wrapper-wxh-572x612" style="-webkit-overflow-scrolling: touch; overflow: auto;"><iframe src="'+ event.url +'" frameborder="0"></iframe></div>');
                            $('#btn-submit-event').attr('href',event.url);
                        }
                    });

                }
            });
        },
        megaupload: function() {
            $('#btn-submit-event').click(function(e) {
                e.preventDefault();  //stop the browser from following
                link = $(this).attr('href');
                window.location.href= link;
            });
        }
    };
}();

jQuery(document).ready(function() {
    js_historia.init();
    js_historia.megaupload();

});