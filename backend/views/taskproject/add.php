<?php
$this->registerCssFile('@web/css/public.css');
?>
<div class="inner-container">
</div>
<?=$this->render('_form' , ['model' => $model,'modelTask'=>$modelTask, 'categorys' => $categorys,'taskstatus'=>$taskstatus]);?>