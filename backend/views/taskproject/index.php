<?php
   use yii\widgets\Breadcrumbs;
	use yii\helpers\Url;
    use yii\bootstrap\Modal;
$this->registerJsFile('js/taskproject.js');
?>
<style>
	.inner-container{font-family:Microsoft YaHei}
</style>
<div class="inner-container">
<?=Breadcrumbs::widget([
	'homeLink' => ['label' => '首页'],
	'links' => [
		'新增任务',
	]
])?>
	<a class="btn btn-success" id='newproj' href="javascript:showProjModal('2016-06-05','2016-06-10')" >新增任务</a>

	<p style="text-align:right;">
		<a href="<?=Url::to(['taskproject/assignedtask','id'=>24])?>" class="btn btn-primary">指派任务(高普林调用)</a>
	</p>

	<?php
	Modal::begin([
		'id' => 'create-modal',
		'header' => '<h4 class="modal-title">新增任务</h4>',
		'size' => 'modal-lg'
	]);
	Modal::end();
	?>
