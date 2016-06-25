
$(document).ready(function(){ 
	
})

function changeload(a){
	var workload=document.getElementById("projectplan-workload").value;
	var fworkload=parseFloat(workload);
	if(isNaN(fworkload)){
		alert("请录入数字");
	}else{
		if(fworkload>=5){
			document.getElementById("projecttypeshow").value="专项批次";
		}else{
			document.getElementById("projecttypeshow").value="零星需求";
		}
	}
}