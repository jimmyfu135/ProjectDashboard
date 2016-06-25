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
use yii\helpers\Json;
use common\models\Projectplan;

class TestController extends Controller{
    public function actionIndex(){
        //$this->layout = false;
        //return $this->render('index');
        //$calendarList = [{title: \'All Day Event\',start: \'2016-05-01\'}];


        /*yii中json对象写法
         * $calendarList = [[
            'title' =>  'All Day Event',
            'start' =>  '2016-05-01']
        ];
        echo Json::encode($calendarList);
        */
       $model = Projectplan::calendarList();
        /*$ProjectPlanModel = new ProjectPlanModel();

        foreach ($model as $m){
            $ProjectPlanModel->title = $model->subject;
            $ProjectPlanModel->start = $model->begindate;
            $ProjectPlanModel->end = $model->enddate;
        }*/

        echo Json::encode($model);
    }
}