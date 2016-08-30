<?php
   use yii\widgets\Breadcrumbs;
	use yii\helpers\Url;
	use yii\helpers\Html;
use yii\helpers\ArrayHelper;
    use yii\bootstrap\Modal;
	use yii\widgets\LinkPager;

$this->registerJsFile('/ProjectDashboard/common/editgrid/plus/import.inc.js',['depends' => ['backend\assets\AppAsset']]);
$this->registerJsFile('@web/js/addtask.js',['depends' => ['backend\assets\AppAsset']]);

?>
<style>
	.inner-container{font-family:Microsoft YaHei}
</style>
<div class="inner-container">
<p style="text-align:right;">
	<a href="<?=Url::to(['site/index'])?>" class="btn btn-primary">返回首页</a>
</p>
	<caption><h4>需求：<small><strong><span id="cl"> <?=$modelTask->subject?></span></strong></small></h4></caption>
	<input type="hidden" style="display:none" id="teamUserJson" value='<?= $teamUser ?>'> </input>
	<input type="hidden" style="display:none" id="taskid" value='<?= $modelTask->id ?>'> </input>
	<div id="myTabContent" class="tab-content">
		<!--可编辑表格-->
		<div class="tab-pane fade in active" id="tab2">
			<table class="table table-striped table-hover" id="reportTable"></table>
			<a href="javascript:addRow()" class="btn btn-primary">新增</a>
			<a href="<?="javascript:Save('$modelTask->id')"?>"" class="btn btn-primary">提交</a>

		</div>
	</div>
</div>