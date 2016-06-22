<?php

/* @var $this yii\web\View */
//use backend\assets\FullCalendarAsset;

//FullCalendarAsset::register($this);

$this->registerJsFile('@web/js/site.js',['depends' => ['backend\assets\FullCalendarAsset']]);
$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div id='calendar'></div>
        </div>
    </div>
</div>
