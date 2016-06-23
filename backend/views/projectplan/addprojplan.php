<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\base\Widget;
?>
<div class="inner-container">
    <?=Html::beginForm('index.php?r=projectplan/addprojplan' , 'post' , ['enctype' => 'multipart/form-data' , 'class' => 'form-horizontal' , 'id' =>'addForm' ])?>
	    <div class="form-group">
            <?=Html::label('项目计划名称' , 'subject' , ['class' =>'control-label col-sm-2 col-md-2'])?>
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
             <?=Html::label('计划提交时间' , 'yjsubmitdate' , ['class' =>'control-label col-sm-2 col-md-2'])?>
            <div class="controls col-sm-10 col-md-4">
                <?=Html::activeInput('date' , $model , 'yjsubmitdate' , ['class' => 'form-control date'])?>
                <?=Html::error($model , 'yjsubmitdate')?>
            </div>
            <?=Html::label('需求PM' , 'pmid', ['class' =>'control-label col-sm-2 col-md-2'])?>
            <div class="controls col-sm-10 col-md-4">
                <?=Html::activeDropDownList($model,'pmid' ,ArrayHelper::map($pmdata,'id', 'name'), ['class' => 'form-control select'])?>
                <?=Html::error($model , 'pmid')?>
            </div>
		</div>
		<div class="form-group">
		 	<?=Html::label('需求级别' , 'projectlevel', ['class' =>'control-label col-sm-2 col-md-2'])?>
            <div class="controls col-sm-10 col-md-4">
                <?=Html::activeDropDownList($model,'projectlevel' ,ArrayHelper::map($projectlevel,'id', 'name'), ['class' => 'form-control select'])?>
                <?=Html::error($model , 'projectlevel')?>
            </div>
             <?=Html::label('预计工作量' , 'workload' , ['class' =>'control-label col-sm-2 col-md-2'])?>
            <div class="controls col-sm-10 col-md-4">
                <?=Html::activeInput('input' , $model , 'workload' , ['class' => 'form-control date'])?>
                <?=Html::error($model , 'workload')?>
            </div>
		</div>
		 <div class="form-group">
            <?=Html::label('客户名称' , 'customer' , ['class' =>'control-label col-sm-2 col-md-2'])?>
            <div class="controls col-sm-10 col-md-10">
                <?=Html::activeInput('text' , $model , 'customer' , ['class' => 'form-control input'])?>
                <?=Html::error($model , 'customer')?>
            </div>
		</div>
		
		<div class="form-group">
		 	<div style="margin-top:10px" class="col-sm-10 col-sm-offset-10 ">
		 		<button class="btn btn-primary" type="submit">提交</button>
				
		 	</div>
		</div>
	<?=Html::endForm();?>
</div>

<?php
echo Html::a('选择用户', ['choiceuser','from'=>"modal"], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#ajax']) 
?>
<div class="modal bs-example-modal-lg modal-lg" id="ajax">

 <div class="modal-dialog">
 
 <div class="modal-content width_reset" id="tmpl-modal-output-render"> </div>

 </div>
 
</div>
