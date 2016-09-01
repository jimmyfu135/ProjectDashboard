/**
 * Created by gaopl on 2016/8/16.
 */
$(function(){
    //编辑表格
    $('#reportTable').bootstrapTable({
        method: 'get',
        editable:true,//开启编辑模式
        clickToSelect: true,
        columns: [
            [
               {field:"stationname",edit:{
                    type:'select',//下拉框
                    //url:'user/getUser.htm',
                    data:[{id:'开发',text:'开发'},{id:'测试',text:'测试'}],
                    valueField:'id',
                    textField:'text',
                   required:true,
                    onSelect:function(val){
                        initiUserList(val);
                    }
                },title:"岗位",align:"center",width:"80px"},
                {field:"userid",edit:{
                    type:'select',//下拉框
                    //url:'user/getUser.htm',
                    data:JSON.parse($("#teamUserJson").val()),
                    valueField:'id',
                    textField:'text',
                    required:true,
                    onSelect:function(val,rec){
                        console.log(val,rec);
                    }
                },title:"人员",align:"center",width:"120px"},
                {field:"begindate",edit:{
                    type:'date',//日期
                    required:true,
                    click:function(){

                    }
                },title:"开始时间",align:"center",width:"120px"},
                {field:"enddate",edit:{
                    type:'date',//日期
                    required:true,
                    click:function(){

                    }
                },title:"结束时间",align:"center",width:"120px"},
                //工作量
                {field:"workload",edit:{
                    type:'num',//日期
                    required:true,
                },title:"工作量",align:"center",width:"150px"},
                //操作
                {field:"useraction",title:"操作",align:"center",formatter:function(value,row,rowIndex){
                    var strHtml = '<a href="javascript:void(0);" onclick="removeRow('+rowIndex+')">删除</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="addRow()">添加</a>';
                    return strHtml;
                },edit:false,width:"80px"}
            ]
        ],
        data :getSavedData()
    });

    $('#addRowbtn').click(function(){
        var data = {
            stationname:'',
            workload:0
        };
        $('#reportTable').bootstrapTable('append',data);

    });
    $('.form_datetime').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 1,
        language:'zh-CN',
        format: 'yyyy-mm-dd',
        formatViewType:'time',
        pickerPosition: 'bottom-left',
        showMeridian: 1
    });
});
function removeRow(rowIndex){
    $('#reportTable').bootstrapTable('removeRow',rowIndex);
}
function addRow(){
    var data = {
        stationname:'',
        workload:0
    };
    $('#reportTable').bootstrapTable('append',data);
}

function initiUserList(stationname,a,b,c,d,e,f,g){
    //TODO--联动效果
    return;
}
//ajax获取已经保存了的数据
function getSavedData(){
    var rtn=[];
    $.ajax({
        url: 'index.php?r=task/gettask&taskid='+$("#taskid").val(),
        type: 'get',
        data: "",
        async:false,
        success: function (data) {
            rtn= JSON.parse(data);
        }
    });
    if(rtn.length==0){
        rtn=[{"stationname":"请选择","userid":"","begindate":"","enddate":"","workload":""}]
    }
    return rtn;
}

function Save(taskid){
    var datas="";
    var Rows=$("#reportTable")[0].rows;
    $.each(Rows, function(i, item) {debugger;
        if (i != 0 && item.cells[0].innerText!="没有找到匹配的记录") {
            datas +=JSON.stringify({
                "stationname":item.cells[0].innerText,
                "userid":item.cells[1].innerText,
                "begindate":item.cells[2].innerText,
                "enddate":item.cells[3].innerText,
                "workload":item.cells[4].innerText
            })+"|";
        }
    });

    var url="index.php?r=task/ajaxsavetask&taskid="+taskid;
    if(datas==""){
        datas="|";
    }
    $.ajax({
        url: url,
        type: 'post',
        data: datas,
        success: function (data) {
            alert("指派完成！");
        },
        error:function(XMLHttpRequest, textStatus, errorThrown) {
            //alert("status:"+XMLHttpRequest.status+",readyState:"+XMLHttpRequest.readyState+",textStatus:"+textStatus);
        }
    });
}
