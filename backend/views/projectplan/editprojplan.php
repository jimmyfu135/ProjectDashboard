<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\base\Widget;
?>


<script src= "js/addprojplan.js" />
<div class="inner-container">
    <?=Html::beginForm('', 'post' , ['enctype' => 'multipart/form-data' , 'class' => 'form-horizontal' , 'id' =>'addForm' ])?>
	   
 		<?= $this->render('_form' , [ 'model' => $model,'pmdata'=>$pmdata,'projectlevel'=>$projectlevel,'careerdepart'=>$careerdepart,'arrchargeuserid'=>$arrchargeuserid]); ?>
 		
		<div class="form-group">
            <div class="control-label col-sm-2 col-md-2">
            	<a href="<?="javascript:submitSendTask('$model->id')"?>" class="btn btn-primary">指派</a>
            </div>
			<div class="control-label col-sm-2 col-md-2"></div>
            <div class="control-label col-sm-2 col-md-7">
            	<a href="<?="javascript:submitDelProjPlan('$model->id')"?>" class="btn btn-primary">删除</a>
		 		<a href="<?="javascript:submitEditProjPlan('$model->id')"?>" class="btn btn-primary">提交</a>
				<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>
            </div>
            <div class="control-label col-sm-2 col-md-1"></div>
        </div>
	<?=Html::endForm();?>
</div>