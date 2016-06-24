<?php
use yii\widgets\Breadcrumbs;
?>
<?=Breadcrumbs::widget([
    'homeLink' => ['label' => '首页'],
    'links' => [
        ['label' => '任务分配列表' , 'url' => ['index']],
        '指派调整'
    ]
])?>
<?=$this->render('_form' , ['model' => $model,'categorys' => $categorys]);?>