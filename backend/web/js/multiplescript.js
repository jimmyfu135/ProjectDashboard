$(document).ready(function(){

	$('.navfilter li').on('click', function() {
		$(this).toggleClass('active').siblings().removeClass('active');
		//重新获取所有事件数据
		$('#requirementCalendar').fullCalendar('refetchEvents');
		$('#resourceCalendar').fullCalendar('refetchResources');
		$('#resourceCalendar').fullCalendar('refetchEvents');
	});
});