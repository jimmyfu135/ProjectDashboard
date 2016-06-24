<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    //根据需要导入js和css文件
    public static function addMultipleSelect($view,$jsfile,$cssfile){
        $view->registerJsFile($jsfile,[AppAsset::className(),'depends' => 'backend\assets\AppAsset']);
        $view->registerCssFile($cssfile,[AppAsset::className(),'depends' => 'backend\assets\AppAsset']);
    }
}
