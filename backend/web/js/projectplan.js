function showProjModal(bgnDate,enddate){
	
	$.get("index.php?r=projectplan/addprojplan&from=modal&begindate="+ bgnDate +"&enddate="+enddate,
		{},
		function (data){$('.modal-body').html(data);});
	$('#create-modal').modal('show');
}
