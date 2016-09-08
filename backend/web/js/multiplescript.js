$(document).ready(function(){
	
	$('.navfilter li').on('click', function() {
		if($(this).hasClass('active')){
			return;
		}
		$(this).toggleClass('active').siblings().removeClass('active');
		//重新获取所有事件数据
		$('#requirementCalendar').fullCalendar('refetchEvents');
		$('#resourceCalendar').fullCalendar('refetchResources');
		$('#resourceCalendar').fullCalendar('refetchEvents');
	});

	$('#abuChoose').change(function () {
		var  value= $("#abuChoose option:selected").text();
		if(value!='全部'){
			$("#sybChoose").get(0).options[0].selected = true
		}
		var result={Type:"ABU",Value:value}
		return result;
	})
	$('#sybChoose').change(function () {
		var  value= $("#sybChoose option:selected").text();
		if(value!='全部'){
			$("#abuChoose").get(0).options[0].selected = true
		}
		var result={Type:"SYB",Value:value}
		return result;
	})
	//默认选中
	var sCurrentDepartment="0";
	$.ajax({
		url: 'index.php?r=site/get-current-department',
		type: 'get',
		data: "",
		async:false,
		success: function (data) {
			sCurrentDepartment=data;
		}
	});
	if(sCurrentDepartment=="1" || sCurrentDepartment=="2" || sCurrentDepartment=="3"){
		//$("#depart"+sCurrentDepartment).addClass("active");
		$("#depart"+sCurrentDepartment).trigger("click");
	}else {
		$("#depart0").trigger("click");
	}
});