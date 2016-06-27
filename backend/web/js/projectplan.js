/*
 * 心脏项目计划
 */
function showProjModal(bgnDate, enddate) {

	editProjPlan('34');
	return ;
	
	$.get("index.php?r=projectplan/addprojplan&from=modal&begindate=" + bgnDate
			+ "&enddate=" + enddate, {}, function(data) {
		$('.modal-body').html(data);
	});
	$('#create-modal').modal('show');
}

/*
 * 修改项目计划
 */
function editProjPlan(projPlanID) {
	$.get("index.php?r=projectplan/addprojplan&from=modal&id=" + projPlanID, {}, function(data) {
		$('.modal-body').html(data);
	});
	$('#create-modal').modal('show');
}