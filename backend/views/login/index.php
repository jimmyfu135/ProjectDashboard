<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->registerCssFile('@web/css/login.css');
$this->registerCssFile('@web/css/public.css');
$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inner-container">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>请填写用户和密码进行登录:</p>
    <?php $form = ActiveForm::begin(['id' => 'login-form','class' => 'form-horizontal']); ?>
    <ul>
        <li class="text">用户名：<?=Html::activeInput('text' , $model , 'username' , ['class' => 'input'])?></li>
        <li class="tip">&nbsp;<?=Html::error($model , 'username' , ['class' => 'error'])?></li>
        <li>密　码：<?=Html::activeInput('password' , $model , 'password' , ['class' => 'input'])?></li>
        <li class="tip">&nbsp;<?=Html::error($model , 'password' , ['class' => 'error'])?></li>
        <li class="tip remember"><input type="checkbox" id="remember" name="LoginForm[remember]" value="1"><label for="remember">&nbsp;保持登录状态</label></li>
    </ul>
</div>
<div class="form-group">
    <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
</div>

<?php ActiveForm::end(); ?>
</div>
