function addTaskModal(bgnDate, enddate) {
	$(".modal-title").text("新增任务");
	$.get("index.php?r=taskproject/addtaskproj&begindate=" + bgnDate
		+ "&enddate=" + enddate, {}, function(data) {
		$('.modal-body').html(data);
	});
	$('#create-modal').modal('show');
}


function submitAddTaskProj(){
	var $form = $('#addForm');
	submitTaskProj('index.php?r=taskproject/addtaskproj',$form.serialize());
}


/*
 * ajax提交
 */
function submitTaskProj(url,data){
	$.ajax({
		url: url,
		type: 'post',
		data: data,
		success: function (data) {
			if(data=="ok"){
				$('#create-modal').modal('hide');
				$('#requirementCalendar').fullCalendar('refetchEvents');
			}else{
				$('.modal-body').html(data);
			}
		}
	});
}