$(document).ready(function(){

	$("#select2 dd").click(function () {
		$(this).addClass("selected").siblings().removeClass("selected");
		//重新获取所有事件数据
		$('#requirementCalendar').fullCalendar('refetchEvents');
		$('#resourceCalendar').fullCalendar('refetchEvents');
		//展示图例
		showLegend();
	});
});