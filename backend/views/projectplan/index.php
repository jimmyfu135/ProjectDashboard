<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use dosamigos\datepicker\DatePicker;
use yii\base\Widget;

?>
<script src= "js/projectplan.js" >
<script type="text/javascript">



</script>
<a class="btn btn-success" id='newproj' data-toggle='modal' data-target='#create-modal'>新增项目计划</a>


<?php 
Modal::begin([
'id' => 'create-modal',
'header' => '<h4 class="modal-title">新增项目计划</h4>',
'size'=>'modal-lg',
//'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
]); 

$requestUrl = Url::to(['addprojplan','from'=>"modal",'begindate'=>'2016-06-23','enddate'=>'2016-06-28']);
$js = <<<JS
$.get('{$requestUrl}', {},
function (data) {
$('.modal-body').html(data);
} 
);
JS;
$this->registerJs($js);

Modal::end(); 
?>


<?php
echo Html::a('备用的模态窗体', ['addprojplan','from'=>"modal"], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#ajax','size'=>'modal-lg']) 
?>
<div class="modal bs-example-modal-lg modal-lg" id="ajax">

 <div class="modal-dialog">
 
 <div class="modal-content width_reset" id="tmpl-modal-output-render"> </div>

 </div>
 
</div>

