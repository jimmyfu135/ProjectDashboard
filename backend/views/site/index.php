<?php

/* @var $this yii\web\View */
use backend\assets\AppAsset;
use yii\bootstrap\Modal;
//FullCalendarAsset::register($this);
AppAsset::addMultipleSelect($this,'@web/js/multiplescript.js','@web/css/multipleselect.css');
$this->registerJsFile('@web/js/site.js',['depends' => ['backend\assets\FullCalendarAsset']]);
$this->registerJsFile('@web/fullcalendar/scheduler.js',['depends' => ['backend\assets\FullCalendarAsset']]);
$this->registerCssFile('@web/fullcalendar/scheduler.css',['depends' => ['backend\assets\FullCalendarAsset']]);
$this->registerJsFile('@web/js/projectplan.js',['depends' => ['backend\assets\AppAsset']]);
$this->registerCssFile('@web/css/site.css');
$this->registerJsFile('@web/js/taskproject.js',['depends' => ['backend\assets\AppAsset']]);
$this->title = 'My Yii Application';
?>

<form class="form-inline center">
    <div class="form-group" id="abuFont"><span>A&nbsp;B&nbsp;U:&nbsp;</span> </div>
    <div class="form-group" id="abuSelect">
    <select class="selectpicker" id="abuChoose">
        <option>全部</option>
        <option>上海一组</option>
        <option>上海二组</option>
        <option>上海三组</option>
    </select>
</div>

    <div class="form-group" id="sybFont">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>&nbsp;事&nbsp;业&nbsp;部:&nbsp;</span></div>
    <div class="form-group" id="sybSelect">
        <select class="selectpicker"  id="sybChoose">
            <option>全部</option>
            <option>上海客户事业一部</option>
            <option>上海客户事业二部</option>
            <option>上海客户事业三部</option>
            <option>上海客户事业四部</option>
            <option>上海客户事业五部</option>
        </select>
    </div>
</form>

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
