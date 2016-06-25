<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use backend\assets\AppAsset;

$this->registerJsFile('js/projectplan.js');
?>

<script src= "js/projectplan.js"></script>
<a class="btn btn-success" id='newproj' data-toggle='modal' data-target='#create-modal'>新增项目计划</a>

<a class="btn btn-success" id='newproj' href="javascript:showProjModal('2016-05-05','2016-07-07')" >新增项目计划</a>

<?php
Modal::begin([
    'id' => 'create-modal',
    'header' => '<h4 class="modal-title">新增项目计划</h4>',
    'size' => 'modal-lg'
])
// 'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
;

Modal::end();
?>


