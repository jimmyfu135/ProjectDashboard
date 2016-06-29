<?php
use yii\helpers\Url;
use yii\helpers\Html;

use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\base\Widget;

$this->registerJsFile('@web/js/addprojplan.js',['depends' => ['backend\assets\AppAsset']]);

?>

<div class="inner-container">
	<?=Html::beginForm('' , 'post' , ['enctype' => 'multipart/form-data' , 'class' => 'form-horizontal' , 'id' =>'addForm' ])?>

	<?= $this->render('_form' , [ 'model' => $model,'pmdata'=>$pmdata,'projectlevel'=>$projectlevel,'careerdepart'=>$careerdepart]); ?>

	<div class="form-group">
		<div style="margin-top:10px" class="col-sm-10 col-sm-offset-10 ">

			<a href="javascript:submitAddProjPlan()" class="btn btn-primary">提交</a>
			<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>
		</div>
	</div>
	<?=Html::endForm();?>
</div>