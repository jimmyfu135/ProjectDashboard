<?php
/**
 * Created by PhpStorm.
 * User: fuj01
 * Date: 2016/6/22
 * Time: 9:28
 */
/* @var $this yii\web\View */

$this->registerJsFile('@web/js/site.js',['depends' => ['backend\assets\TestAsset']]);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id='calendar'></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
