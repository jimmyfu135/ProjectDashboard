function addTaskModal(bgnDate, enddate) {
	$(".modal-title").text("新增任务");
	$.get("index.php?r=taskproject/addtaskproj&begindate=" + bgnDate
		+ "&enddate=" + enddate, {}, function(data) {
		$('.modal-body').html(data);
	});
	$('#create-modal').modal('show');
}