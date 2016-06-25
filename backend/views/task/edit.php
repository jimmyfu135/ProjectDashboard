<?php
use yii\widgets\Breadcrumbs;
$this->registerCssFile('@web/css/public.css');
?>
<div class="inner-container">
<?=Breadcrumbs::widget([
    'homeLink' => ['label' => '首页'],
    'links' => [
        ['label' => '任务分配列表' , 'url' => ['index']],
        '指派调整'
    ]
])?>
<?=$this->render('_form' , ['model' => $model,'categorys' => $categorys,'taskstatus'=>$taskstatus]);?>
</div>
