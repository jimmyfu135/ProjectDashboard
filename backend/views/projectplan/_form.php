<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\base\Widget;

$this->registerCssFile('@web/css/modal-self.css');
$this->registerJsFile('@web/js/projectplanform.js');
?>

<div class="form-group">
    <?=Html::label('项目计划名称' , 'subject' , ['class' =>'control-label col-sm-2 col-md-2'])?>
    <div class="controls col-sm-10 col-md-10">
        <?=Html::activeInput('text' , $model , 'subject' , ['class' => 'form-control input'])?>
        <?=Html::error($model , 'subject', ['class' => 'error'])?>
    </div>
</div>
<div class="form-group">
    <?=Html::label('客户名称' , 'customer' , ['class' =>'control-label col-sm-2 col-md-2'])?>
    <div class="controls col-sm-10 col-md-4">
        <?=Html::activeInput('text' , $model , 'customer' , ['class' => 'form-control input'])?>
        <?=Html::error($model , 'customer', ['class' => 'error'])?>
    </div>
    <?=Html::label('需求PM' , 'pmid', ['class' =>'control-label col-sm-2 col-md-2'])?>
    <div class="controls col-sm-10 col-md-4">
        <?=Html::activeDropDownList($model,'pmid' ,ArrayHelper::map($pmdata,'id', 'usernameChn'), ['prompt'=>'请选择','class' => 'form-control select'])?>
        <?=Html::error($model , 'pmid', ['class' => 'error'])?>
    </div>
</div>
<div class="form-group">
    <?=Html::label('计划开始时间' , 'begindate' , ['class' =>'control-label col-sm-2 col-md-2'])?>
    <div class="controls col-sm-10 col-md-4">
        <?=Html::activeInput('date' , $model , 'begindate' , ['class' => 'form-control date'])?>
        <?=Html::error($model , 'begindate', ['class' => 'error'])?>
    </div>
    <?=Html::label('计划结束时间' , 'enddate' , ['class' =>'control-label col-sm-2 col-md-2'])?>
    <div class="controls col-sm-10 col-md-4">
        <?=Html::activeInput('date' , $model , 'enddate' , ['class' => 'form-control date'])?>
        <?=Html::error($model , 'enddate', ['class' => 'error'])?>
    </div>
</div>
<div class="form-group">
     <?=Html::label('计划提交时间' , 'yjsubmitdate' , ['class' =>'control-label col-sm-2 col-md-2'])?>
    <div class="controls col-sm-10 col-md-4">
        <?=Html::activeInput('date' , $model , 'yjsubmitdate' , ['class' => 'form-control date'])?>
        <?=Html::error($model , 'yjsubmitdate', ['class' => 'error'])?>
    </div>
    <?=Html::label('需求级别' , 'projectlevel', ['class' =>'control-label col-sm-2 col-md-2'])?>
    <div class="controls col-sm-10 col-md-4">
        <?=Html::activeDropDownList($model,'projectlevel' ,ArrayHelper::map($projectlevel,'id', 'name'), ['prompt'=>'请选择','class' => 'form-control select'])?>
        <?=Html::error($model , 'projectlevel', ['class' => 'error'])?>
    </div>
</div>
<div class="form-group">
     <?=Html::label('预计工作量' , 'workload' , ['class' =>'control-label col-sm-2 col-md-2'])?>
    <div class="controls col-sm-10 col-md-4">
        <?=Html::activeInput('input' , $model , 'workload' , ['class' => 'form-control date','onchange'=>'changeload()'])?>
        <?=Html::error($model , 'workload', ['class' => 'error'])?>
    </div>
    <?=Html::label('需求类型' , 'projecttype' , ['class' =>'control-label col-sm-2 col-md-2'])?>
    <div class="controls col-sm-10 col-md-4">
        <input class="form-control" type="text" placeholder="" readonly id="projecttypeshow">
        <?=Html::error($model , 'projecttype', ['class' => 'error'])?>
    </div>
</div>
 
 <div class="form-group">
    <?=Html::label('责任事业部' , 'careerdepartid', ['class' =>'control-label col-sm-2 col-md-2'])?>
    <div class="controls col-sm-10 col-md-4">
        <?=Html::activeDropDownList($model,'careerdepartid' ,ArrayHelper::map($careerdepart,'id', 'name'), ['prompt'=>'请选择','class' => 'form-control select','onchange'=>'changecareerdepart()'])?>
        <?=Html::error($model , 'careerdepartid', ['class' => 'error'])?>
    </div>
    <?=Html::label('需求负责人' , 'chargeuserid', ['class' =>'control-label col-sm-2 col-md-2'])?>
     <div class="controls col-sm-10 col-md-4">
        <?=Html::activeDropDownList($model,'chargeuserid' ,ArrayHelper::map($arrchargeuserid,'id', 'name'), ['prompt'=>'请选择','class' => 'form-control select'])?>
        <?=Html::error($model , 'chargeuserid', ['class' => 'error'])?>
    </div>
</div>
