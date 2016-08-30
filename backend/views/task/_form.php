<?php
	use yii\helpers\Html;
     use frontend\models\User;
     use yii\helpers\ArrayHelper;
    $this->registerCssFile('@web/css/public.css');
?>
	<div class="inner-container">
<?=Html::beginForm('' , 'post', ['enctype' => 'multipart/form-data' ,'class' => 'form-horizontal']);?>
		<caption><h4>需求：<small><strong><?=$modelTask->subject?></strong></small></h4></caption>

	<div class="form-group">
		<?=Html::label('人员：' , 'userid' , ['class' =>'control-label col-sm-2 col-md-2' ])?>
		<div class="controls col-sm-10 col-md-4">
			<?=Html::activeDropDownList($model, 'userid', ArrayHelper::map($categorys,'id', 'usernameChn'), ['prompt'=>'请选择','class' => 'form-control'])?>
			<?=Html::error($model , 'userid' , ['class' => 'error']);?>
		</div>
		<?=Html::label('岗位' , 'stationname', ['class' =>'control-label col-sm-2 col-md-2'])?>
		<div class="controls col-sm-10 col-md-4">
			<?=Html::activeDropDownList($model,'stationname' ,['开发' => '开发', '测试' => '测试', '设计' => '设计', 'PM' => 'PM'],['prompt'=>'请选择','class' => 'form-control select'])?>
			<?=Html::error($model , 'stationname', ['class' => 'error'])?>
		</div>
	</div>
	<div class="form-group">
		<?=Html::label('计划开始时间' , 'begindate' , ['class' =>'control-label col-sm-2 col-md-2'])?>
		<div class="controls col-sm-10 col-md-4">
			<?=Html::activeInput('date' , $model , 'begindate' , ['class' => 'form-control date'])?>
			<?=Html::error($model , 'begindate', ['class' => 'error'])?>
		</div>
		<?=Html::label('计划完成时间' , 'enddate' , ['class' =>'control-label col-sm-2 col-md-2'])?>
		<div class="controls col-sm-10 col-md-4">
			<?=Html::activeInput('date' , $model , 'enddate' , ['class' => 'form-control date'])?>
			<?=Html::error($model , 'enddate', ['class' => 'error'])?>
		</div>
	</div>
	<div class="form-group">
		<?=Html::label('工作量：' , 'workload' , ['class' => 'control-label col-sm-2 col-md-2'])?>
		<div class="controls col-sm-10 col-md-4">
			<?=Html::activeInput('text' , $model , 'workload' , ['class' => 'form-control'])?>
			<?=Html::error($model , 'workload' , ['class' => 'error']);?>
		</div>
		<?=Html::label('任务状态' , 'taskstatus', ['class' =>'control-label col-sm-2 col-md-2'])?>
		<div class="controls col-sm-10 col-md-4">
			<?=Html::activeDropDownList($model,'taskstatus' ,ArrayHelper::map($taskstatus,'id', 'name'), ['prompt'=>'请选择','class' => 'form-control select'])?>
			<?=Html::error($model , 'taskstatus', ['class' => 'error'])?>
		</div>
	</div>

<div class="form-group">
	<?=Html::submitButton("确认" , ['class' => 'btn btn-primary col-sm-offset-2']);?>
	<a href="<?=\yii\helpers\Url::to(['index','taskid'=>$modelTask->id])?>" class="btn btn-default">返回</a>
</div>

<?=Html::endForm();?>
	</div>
