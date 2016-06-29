$(document).ready(function(){

	$("#select2 dd").click(function () {
		$(this).addClass("selected").siblings().removeClass("selected");
		//重新加载日历数据
		$('#requirementCalendar').fullCalendar('refetchEvents'); //重新获取所有事件数据
	});
});