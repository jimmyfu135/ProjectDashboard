/*
 * 新增项目计划
 */
function showProjModal(bgnDate, enddate) {
	
	$(".modal-title").text("新增项目计划");
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
	$(".modal-title").text("修改项目计划");
	$.get("index.php?r=projectplan/addprojplan&from=modal&id=" + projPlanID, {}, function(data) {
		$('.modal-body').html(data);
	});
	$('#create-modal').modal('show');
}
/*
 * ajax提交项目计划
 */
function submitProjPlan(url,data){
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

//ajax新增提交
function submitAddProjPlan(){
	var $form = $('#addForm');
	submitProjPlan('index.php?r=projectplan/ajaxaddprojplan',$form.serialize());
	
}
//ajax修改提交
function submitEditProjPlan(id){
	var $form = $('#addForm');
	submitProjPlan('index.php?r=projectplan/ajaxupdateprojplan&id='+id, $form.serialize());
}
//ajax删除项目计划
function submitDelProjPlan(id){
	var $form = $('#addForm');
	submitProjPlan('index.php?r=projectplan/delprojplan&id='+id, $form.serialize());
}

//选择事业部，默认带出事业部下面的用户
function changecareerdepart(){
	var scareerdepartid=$("#projectplan-careerdepartid").val();
	$.ajax({
        url: 'index.php?r=projectplan/ajaxgetcareeruser&careerdepartid='+scareerdepartid,
        type: 'get',
        data: scareerdepartid,
        success: function (data) {
        	var arrUser= JSON.parse(data);
        	$("#projectplan-chargeuserid").empty()
        	for (var i = 0; i < arrUser.length; i++) {
                $('#projectplan-chargeuserid').append("<option value=" + arrUser[i].id + ">" + arrUser[i].usernameChn + "</option>");
            }
        }
    });
}

//指派任务
function submitSendTask(id){
	alert(id);
}