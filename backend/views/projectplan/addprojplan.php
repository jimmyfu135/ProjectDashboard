<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<div class="inner-container">
    <?=Html::beginForm('index.php?r=projectplan/addprojplan' , 'post' , ['enctype' => 'multipart/form-data' , 'class' => 'form-horizontal' , 'id' =>'addForm' ])?>
	    <div class="form-group">
            <?=Html::label('需求主题' , 'subject' , ['class' =>'control-label col-sm-2 col-md-2'])?>
            <div class="controls col-sm-10 col-md-10">
                <?=Html::activeInput('text' , $model , 'subject' , ['class' => 'form-control input'])?>
                <?=Html::error($model , 'subject')?>
            </div>
		</div>
		
        <div class="form-group">
            <?=Html::label('计划开始时间' , 'begindate' , ['class' =>'control-label col-sm-2 col-md-2'])?>
            <div class="controls col-sm-10 col-md-4">
                <?=Html::activeInput('date' , $model , 'begindate' , ['class' => 'form-control date'])?>
                <?=Html::error($model , 'begindate')?>
            </div>
            <?=Html::label('计划结束时间' , 'enddate' , ['class' =>'control-label col-sm-2 col-md-2'])?>
            <div class="controls col-sm-10 col-md-4">
                <?=Html::activeInput('date' , $model , 'enddate' , ['class' => 'form-control date'])?>
                <?=Html::error($model , 'enddate')?>
            </div>
		</div>
	    <div class="form-group">
             <?=Html::label('预计提交时间' , 'yjsubmitdate' , ['class' =>'control-label col-sm-2 col-md-2'])?>
            <div class="controls col-sm-10 col-md-4">
                <?=Html::activeInput('date' , $model , 'yjsubmitdate' , ['class' => 'form-control date'])?>
                <?=Html::error($model , 'yjsubmitdate')?>
            </div>
            <?=Html::label('需求PM' , 'chargeuserid', ['class' =>'control-label col-sm-2 col-md-2'])?>
            <div class="controls col-sm-10 col-md-4">
                <?=Html::activeDropDownList($model,'chargeuserid' ,ArrayHelper::map($pmdata,'id', 'name'), ['class' => 'form-control select'])?>
                <?=Html::error($model , 'chargeuserid')?>
            </div>
		</div>
		<div class="form-group">
		 	<div style="margin-top:10px" class="col-sm-10 col-sm-offset-2 col-md-11 col-md-offset-1">
		 		<button class="btn btn-primary" type="submit">提交</button>
				
		 	</div>
		</div>
	<?=Html::endForm();?>
</div>