<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;
use yii\base\Widget;
?>


<script src= "js/addprojplan.js" />
<div class="inner-container">
    <?=Html::beginForm('index.php?r=projectplan/updateprojplan&id=' . $model->id , 'post' , ['enctype' => 'multipart/form-data' , 'class' => 'form-horizontal' , 'id' =>'addForm' ])?>
	   
 		<?= $this->render('_form' , [ 'model' => $model,'pmdata'=>$pmdata,'projectlevel'=>$projectlevel,'careerdepart'=>$careerdepart]); ?>
 		
		<div class="form-group">
		 	<div style="margin-top:10px" class="col-sm-10 col-sm-offset-9 ">
		 		<a href="<?=Url::to(['delprojplan' , 'id'=>$model->id]) ?>" class="btn btn-primary">删除</a>
		 		<button class="btn btn-primary" type="submit">提交</button>
				<a href="#" class="btn btn-primary" data-dismiss="modal">关闭</a>
		 	</div>
		</div>
	<?=Html::endForm();?>
</div>