<?php
/**
 * Created by PhpStorm.
 * User: fuj01
 * Date: 2016/6/22
 * Time: 9:23
 */
namespace backend\controllers;

use yii\rest\Action;
use yii\web\Controller;

class TestController extends Controller{
    public function actionIndex(){
        $this->layout = false;
        return $this->render('index');
    }
}