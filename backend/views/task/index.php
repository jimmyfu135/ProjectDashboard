<?php
   use yii\widgets\Breadcrumbs;
	use yii\helpers\Url;
    use yii\bootstrap\Modal;
     use yii\widgets\LinkPager;
?>
<style>
	.inner-container{font-family:Microsoft YaHei}
</style>
<div class="inner-container">
<?=Breadcrumbs::widget([
	'homeLink' => ['label' => '首页'],
	'links' => [
		'任务分配列表',
	]
])?>
<p style="text-align:right;">
	<a href="<?=Url::to(['add','taskid'=>$modelTask->id])?>" class="btn btn-primary">指派任务</a>
</p>
<table class="table table-hover">
	<caption><h4>需求：<small><strong><?=$modelTask->subject?></strong></small></h4></caption>
<tr>
	<th>人员</th><th>岗位</th><th>工作量</th><th>计划开始日期</th><th>计划完成日期</th><th>状态</th><th>修改日期</th><th>操作</th>
</tr>
<?php foreach($data as $v){?>
<tr>
	<td><?=isset($categorys[$v['userid']])  ? $categorys[$v['userid']]['usernameChn'] : '用户不存在';?></td>
	<td><?=$v->stationname?></td>
	<td><?=$v->workload?></td>
	<td><?=$v->begindate?></td>
	<td><?=$v->enddate?></td>
	<td><?=isset($taskstatus[$v['taskstatus']])  ? $taskstatus[$v['taskstatus']]['name'] : '无';?></td>
	<td><?=date('Y-m-d' , $v['updated_at'])?></td>
	<td><a href="<?=Url::to(['edit' , 'id'=>$v->id,'taskid'=>$modelTask->id])?>" class="data_op data_edit">编辑</a> | <a href="<?=Url::to(['delete' , 'id'=>$v->id,'taskid'=>$modelTask->id]) ?>" class="data_op data_delete">删除</a></td>
</tr>
<?php }?>
</table>
	<?=LinkPager::widget([
		'pagination' => $pagination,
	])?>
</div>
