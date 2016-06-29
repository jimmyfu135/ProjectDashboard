<?php

/* @var $this yii\web\View */
use backend\assets\AppAsset;
use yii\bootstrap\Modal;
//FullCalendarAsset::register($this);

$this->registerJsFile('@web/js/site.js',['depends' => ['backend\assets\FullCalendarAsset']]);
AppAsset::addMultipleSelect($this,'@web/js/multiplescript.js','@web/css/multipleselect.css');
$this->registerJsFile('@web/js/projectplan.js',['depends' => ['backend\assets\AppAsset']]);
$this->registerJsFile('@web/js/taskproject.js',['depends' => ['backend\assets\AppAsset']]);
$this->title = 'My Yii Application';
?>

<ul class="select">
    <li class="select-list">
        <dl id="select2">
            <dt>ABU：</dt>
            <dd class="select-all selected"><a href="#">上海一组</a></dd>
            <dd><a href="#">上海二组</a></dd>
            <dd><a href="#">上海三组</a></dd>
        </dl>
    </li>
</ul>

<ul class="nav nav-tabs">
    <li class="active">
        <a href="#tab_requirementCalendar" data-toggle="tab">需求视图</a>
    </li>
    <li>
        <a id="navResource" href="#tab_resourceCalendar" data-toggle="tab">资源视图</a>
    </li>
</ul>

<div id="myTabContent" class="tab-content">
    <div style="margin-top: 5px;" class="tab-pane fade in active" id='tab_requirementCalendar'>
        <div id="requirementCalendar"></div>
    </div>
    <div style="margin-top: 5px;" class="tab-pane fade" id='tab_resourceCalendar'>
        <div id="resourceCalendar"></div>
    </div>
</div>

<?php
Modal::begin([
    'id' => 'create-modal',
    'header' => '<h4 class="modal-title">新增项目计划</h4>',
    'size' => 'modal-lg'
]);
Modal::end();
?>
