function addTaskModal(bgnDate, enddate) {
	$(".modal-title").text("新增任务");
	$.get("index.php?r=taskproject/addtaskproj&begindate=" + bgnDate
		+ "&enddate=" + enddate, {}, function(data) {
		$('.modal-body').html(data);
	});
	$('#create-modal').modal('show');
}

/*
 * 修改
 */
function editTaskModal(id) {
	$(".modal-title").text("修改任务");
	$.get("index.php?r=taskproject/edittaskproj&id=" + id, {}, function(data) {
		$('.modal-body').html(data);
	});
	$('#create-modal').modal('show');
}


function submitAddTaskProj(){
	var $form = $('#addForm');
	submitTaskProj('index.php?r=taskproject/addtaskproj',$form.serialize());
}

function submitEditTaskProj(id){
	var $form = $('#editForm');
	submitTaskProj('index.php?r=taskproject/edittaskproj&id='+id, $form.serialize());
}

function submitDelTaskProj(id){
	var $form = $('#addForm');
	submitTaskProj('index.php?r=taskproject/deltaskproj&id='+id, $form.serialize());
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
				$('#resourceCalendar').fullCalendar('refetchEvents');
			}else{
				$('.modal-body').html(data);
			}
		}
	});
}




