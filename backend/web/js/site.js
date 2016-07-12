/**
 * Created by fuj01 on 2016/6/21.
 */
$(document).ready(function() {
    //展示图例
    showLegend();
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
            var preEnd = calDate(formatEnd);
            showProjModal(formatStart,preEnd);
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
        eventOrder:'userid',
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
            var preEnd = calDate(formatEnd);
            addTaskModal(formatStart,preEnd);
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
        }else {
            $('#resourceCalendar').fullCalendar('refetchEvents');
        }
    });

    $("#navRequirement").on('shown.bs.tab',function(e) {
        $('#requirementCalendar').fullCalendar('refetchEvents');
    });
});

function showLegend() {
    var abuName = "";
    $("#select2 dd").each(function () {
        if($(this).hasClass("selected")){
            abuName = $(this).text();
            return false;
        }
    });
    $.ajax({
        url:'index.php?r=site/user-list&abuname=' + abuName,
        success:function (data) {
            var events = [];
            events = JSON.parse(data);
            console.log(events);
            //加载图例
            var legendHTML = "";
            $("#resourceLegend").empty();
            for(var i = 0;i<events.length;i++) {
                legendHTML += "<label style='margin-right: 5px;border-radius: 5px;background-color: " + events[i].color + ";width: 50px;'>" + events[i].usernameChn + "</label>";
            }
            $("#resourceLegend").append(legendHTML);
        }
    });
}

//计算date的前一天
//传入的date参数格式必须为：XXXX-XX-XX
function calDate(date) {
    var arrDate = date.split("-");
    var newDate = new Date();
    newDate.setFullYear(arrDate[0]);
    newDate.setMonth(arrDate[1]);
    newDate.setDate(arrDate[2]);
    var preDate = new Date(newDate.getTime() - 24*60*60*1000);  //前一天
    return preDate.getFullYear() + "-" + (preDate.getMonth() < 10 ? "0"+preDate.getMonth():preDate.getMonth()) + "-" + (preDate.getDate() < 10 ? "0"+preDate.getDate():preDate.getDate());
}