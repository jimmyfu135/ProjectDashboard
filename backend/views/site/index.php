<?php

/* @var $this yii\web\View */
use backend\assets\AppAsset;

//FullCalendarAsset::register($this);

$this->registerJsFile('@web/js/site.js',['depends' => ['backend\assets\FullCalendarAsset']]);
AppAsset::addMultipleSelect($this,'@web/js/multiplescript.js','@web/css/multipleselect.css');
$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="demo">
                <ul class="select">
                    <li class="select-list">
                        <dl id="select1">
                            <dt>视图：</dt>
                            <dd class="select-all selected"><a href="#">需求视图</a></dd>
                            <dd><a href="#">资源视图</a></dd>
                        </dl>
                    </li>
                    <li class="select-list">
                        <dl id="select2">
                            <dt>ABU：</dt>
                            <dd class="select-all selected"><a href="#">上海一组</a></dd>
                            <dd><a href="#">上海二组</a></dd>
                            <dd><a href="#">上海三组</a></dd>
                        </dl>
                    </li>
                    <li class="select-result">
                        <dl>
                            <dt>已选条件：</dt>
                            <dd class="select-no">暂时没有选择过滤条件</dd>
                        </dl>
                    </li>
                </ul>
            </div>

            <div id='calendar'></div>
        </div>
    </div>
</div>
