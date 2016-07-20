<?php

/* @var $this yii\web\View */
use backend\assets\AppAsset;
use yii\bootstrap\Modal;
//FullCalendarAsset::register($this);

$this->registerJsFile('@web/js/site.js',['depends' => ['backend\assets\FullCalendarAsset']]);
$this->registerJsFile('@web/fullcalendar/scheduler.js',['depends' => ['backend\assets\FullCalendarAsset']]);
$this->registerCssFile('@web/fullcalendar/scheduler.css',['depends' => ['backend\assets\FullCalendarAsset']]);
AppAsset::addMultipleSelect($this,'@web/js/multiplescript.js','@web/css/multipleselect.css');
$this->registerJsFile('@web/js/projectplan.js',['depends' => ['backend\assets\AppAsset']]);
$this->registerJsFile('@web/js/taskproject.js',['depends' => ['backend\assets\AppAsset']]);
$this->title = 'My Yii Application';
?>

<ul id="navul" class="navfilter">
    <!--<li class="active">全部</li>-->
    <li class="active">上海一组</li>
    <li>上海二组</li>
    <li>上海三组</li>
</ul>

<ul class="nav nav-tabs">
    <li class="active">
        <a id="navRequirement" href="#tab_requirementCalendar" data-toggle="tab">需求视图</a>
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
