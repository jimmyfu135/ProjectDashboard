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

	<?= $this->render('_form' , [ 'model' => $model,'pmdata'=>$pmdata,'projectlevel'=>$projectlevel,'careerdepart'=>$careerdepart,
	    'arrchargeuserid'=>$arrchargeuserid,'arrcustomer'=>$arrcustomer]); ?>

	<?=Html::endForm();?>
</div>