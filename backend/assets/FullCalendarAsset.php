<?php
/**
 * Created by PhpStorm.
 * User: fuj01
 * Date: 2016/6/21
 * Time: 12:50
 */
namespace backend\assets;

use yii\web\AssetBundle;

class FullCalendarAsset extends AssetBundle{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        ['fullcalendar/fullcalendar.css'],
        ['fullcalendar/fullcalendar.print.css','media' => 'print']
    ];
    public $js = [
        'fullcalendar/moment.min.js',
        'fullcalendar/fullcalendar.js'
    ];
    public $depends = [
        'backend\assets\AppAsset'
    ];
}