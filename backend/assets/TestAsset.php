<?php
/**
 * Created by PhpStorm.
 * User: fuj01
 * Date: 2016/6/22
 * Time: 9:59
 */
namespace backend\assets;

use yii\web\AssetBundle;

class TestAsset extends AssetBundle{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        ['fullcalendar/fullcalendar.css'],
        ['fullcalendar/fullcalendar.print.css','media' => 'print']
    ];
    public $js = [
        'fullcalendar/moment.min.js',
        'fullcalendar/fullcalendar.min.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}