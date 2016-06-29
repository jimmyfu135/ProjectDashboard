<?php
$this->registerCssFile('@web/css/public.css');
?>
<div class="inner-container">
<?=$this->render('_form' , ['model' => $model,'categorys' => $categorys,'taskstatus'=>$taskstatus]);?>
</div>
