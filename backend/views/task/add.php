<?php
use yii\widgets\Breadcrumbs;
$this->registerCssFile('@web/css/public.css');
?>
<div class="inner-container">
<?=Breadcrumbs::widget([
    'homeLink' => ['label' => '首页'],
    'links' => [
        ['label' => '任务分配列表'],
        '指派任务'
    ]
])?>
</div>
<?=$this->render('_form' , ['model' => $model,'modelTask'=>$modelTask, 'categorys' => $categorys,'taskstatus'=>$taskstatus]);?>