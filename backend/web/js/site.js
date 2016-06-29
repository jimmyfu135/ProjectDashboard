/**
 * Created by fuj01 on 2016/6/21.
 */
$(document).ready(function() {

    $('#requirementCalendar').fullCalendar({
        lang:'zh-cn',//引入语言包
        header: {
            left: 'prev,next today',
            center: 'title',
            right: ''
        },
        editable: true,
        dragOpacity: {
            agenda: .5,
            '':.6
        },
        selectable: true,
        selectHelper: true,
        //events: 'index.php?r=site/calendar-list',
        events:function (start,end,timezone,callback) {
            var abuName = "";
            $("#select2 dd").each(function () {
                if($(this).hasClass("selected")){
                    abuName = $(this).text();
                    return false;
                }
            });
            $.ajax({
                url:'index.php?r=site/requirement-calendar-list&abuname=' + abuName,
                success:function (data) {
                    var events = [];
                    events = JSON.parse(data);
                    callback(events);
                }
            });
        },
        select: function(start, end) {
            var formatStart = start.format();
            var formatEnd = end.format();
            showProjModal(formatStart,formatEnd);
            //$('#calendar').fullCalendar('unselect');
        },
        eventClick:function (calEvent,jsEvent,view) {
            editProjPlan(calEvent.id);
        }        
    });

    $('#resourceCalendar').fullCalendar({
        lang:'zh-cn',//引入语言包
        header: {
            left: 'prev,next today',
            center: 'title',
            right: ''
        },
        editable: true,
        dragOpacity: {
            agenda: .5,
            '':.6
        },
        selectable: true,
        selectHelper: true,
        events: function (start,end,timezone,callback) {
            var abuName = "";
            $("#select2 dd").each(function () {
                if($(this).hasClass("selected")){
                    abuName = $(this).text();
                    return false;
                }
            });
            $.ajax({
                url:'index.php?r=site/task-calendar-list&abuname=' + abuName,
                success:function (data) {
                    var events = [];
                    events = JSON.parse(data);
                    callback(events);
                }
            });
        },
        select: function(start, end) {
            var formatStart = start.format();
            var formatEnd = end.format();
            addTaskModal(formatStart,formatEnd);
        },
        eventClick:function (calEvent,jsEvent,view) {
            editTaskModal(calEvent.id);
        }
    });

    //由于日历无法在隐藏的div中加载，所以在显示的时候加载一次
    var resourceCalendarIsloaded = false;
    $("#navResource").on('shown.bs.tab',function(e) {
        if(!resourceCalendarIsloaded){
            //console.log("加载了111");
            $("#resourceCalendar").fullCalendar('render');
            resourceCalendarIsloaded = true;
        }
    });
});