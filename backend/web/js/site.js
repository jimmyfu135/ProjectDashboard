/**
 * Created by fuj01 on 2016/6/21.
 */
$(document).ready(function() {

    $('#calendar').fullCalendar({
        lang:'zh-cn',//引入语言包
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month'
        },
        //defaultDate: '2016-05-12',
        selectable: true,
        selectHelper: true,
        select: function(start, end) {
            var title = showProjModal('2016-06-25','2016-06-26');
            var eventData;
            if (title) {
                eventData = {
                    title: title,
                    start: start,
                    end: end
                };
                $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
            }
            $('#calendar').fullCalendar('unselect');
        },
        editable: true,
        dragOpacity: {
            agenda: .5,
            '':.6
        },
        //eventLimit: true, // allow "more" link when too many events
        events: 'index.php?r=site/calendar-list'
    });

});