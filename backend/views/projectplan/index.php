<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
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
'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
]); 

$requestUrl = Url::to(['addprojplan','from'=>"modal"]);
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