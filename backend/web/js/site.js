/**
 * Created by fuj01 on 2016/6/21.
 */
$(document).ready(function() {
    $('#requirementCalendar').fullCalendar({
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        height: "auto",//高度根据内容自适应
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
            var filterType = "all";
            var abuName = $("#abuChoose option:selected").text();
            var careerName = $("#sybChoose option:selected").text();
            if (abuName == '全部' && careerName != '全部')
                filterType = "career";
            else if(abuName != '全部' && careerName == '全部')
                filterType = "abu";
            else
                filterType = "all";
            $.ajax({
                url: 'index.php?r=site/requirement-calendar-list&filtertype='+filterType+'&abuname=' + abuName + '&careername=' + careerName,
                success: function (data) {
                    var events = [];
                    events = JSON.parse(data);
                    callback(events);
                }
            });
        },
        select: function(start, end) {
            var formatStart = start.format();
            if (!end.hasTime()) {
                end.subtract(1, 'days');
            }
            var formatEnd = end.format();
            showProjModal(formatStart,formatEnd);
            //$('#calendar').fullCalendar('unselect');
        },
        eventRender: function (event, element) {
            $(element).popover({
                title: function () {
                    return "<B>" + event.subject + "</B>";
                },
                placement:'auto',
                html:true,
                trigger : 'focus',
                animation : 'false',
                content: function () {
                    return "<div>" +
                            "计划开始时间：" + event.start.format() +
                        "<br />计划结束时间：" + event.end.subtract(1, 'days').format() +
                        "<br />需求提交人：" + event.chargeusername +
                        "<br />需求PM：" + event.pmusername +
                        "<br />需求类型：" + event.projecttypechn +
                        "<br />预计工作量：" + event.workload +
                        "<br />需求级别：" + event.projectlevelchn +
                        "<br /><input type='hidden' value='" + event.id + "' />" +
                        "</div>" +
                    "<div style='text-align: right;margin-top: 10px;'>" +
                    "<button type='button' onclick='designProj(event);' class='btn btn-primary btn-xs'>指派</button>" +
                    "<button style='margin-left: 8px;' onclick='editProj(event);' type='button' class='btn btn-default btn-xs'>编辑</button>" +
                    // "<button style='margin-left: 8px;' onclick='delProj(event);' type='button' class='btn btn-default btn-xs'>删除</button>" +
                    "</div>";
                },
                container:'body'
            });
            $('body').on('click', function (e) {
                if (!element.is(e.target) && element.has(e.target).length === 0 && $('.popover').has(e.target).length === 0)
                    $(element).popover('hide');
            });
        },
        eventClick: function(calEvent, jsEvent, view) {
            $this = $(this);
            $this.popover('toggle');
        }
    });

    $('#resourceCalendar').fullCalendar({
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        height: "auto",
        lang:'zh-cn',//引入语言包
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'timelineMonth'
        },
        defaultView: 'timelineMonth',
        editable: true,
        dragOpacity: {
            agenda: .5,
            '':.6
        },
        selectable: true,
        selectHelper: true,
        resourceAreaWidth: '10%',
        resourceLabelText: '团队',
        resourceGroupField: 'stationname',
        resources: function (callback) {
            var abuName = $("#abuChoose option:selected").text();
            $.ajax({
                url:'index.php?r=site/user-list&abuname=' + abuName,
                success:function (data) {
                    var events = [];
                    events = JSON.parse(data);
                    callback(events);
                }
            });
        },
        events: function (start,end,timezone,callback) {
            var abuName = $("#abuChoose option:selected").text();
            $.ajax({
                url:'index.php?r=site/task-calendar-list&abuname=' + abuName,
                success:function (data) {
                    var events = [];
                    events = JSON.parse(data);
                    callback(events);   
                }
            });
        },
        select: function(start, end,jsEvent,view,resource) {
            var formatStart = start.format();
            if (!end.hasTime()) {
                end.subtract(1, 'days');
            }
            var formatEnd = end.format();
            var username = resource.title;
            var userid= resource.id;
            var stationname = resource.stationname;
            addTaskModal(formatStart,formatEnd,username,stationname,userid);
        },
        eventClick:function (calEvent,jsEvent,view) {
            editTaskModal(calEvent.id);
        }
    });

    //由于日历无法在隐藏的div中加载，所以在显示的时候加载一次
    var resourceCalendarIsloaded = false;
    $("#navResource").on('shown.bs.tab',function(e) {
        $('#sybChoose').hide();
        $('#sybFont').hide();
        if(!resourceCalendarIsloaded){
            //console.log("加载了111");
            $("#resourceCalendar").fullCalendar('render');
            resourceCalendarIsloaded = true;
        }else {
            $('#resourceCalendar').fullCalendar('refetchEvents');
        }
    });

    $("#navRequirement").on('shown.bs.tab',function(e) {
        $('#sybChoose').show();
        $('#sybFont').show();
        $('#requirementCalendar').fullCalendar('refetchEvents');
    });
    

});
