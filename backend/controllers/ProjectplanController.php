<?php
namespace backend\controllers;

use yii\web\Controller;
use common\models;
use common\models\Projectplan;
use yii;
use yii\data\ArrayDataProvider;
use common\models\User;

class ProjectplanController extends Controller{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionAddprojplan(){
        $model=new Projectplan();
        $pmdata=[
            ['id'=>'1','name'=>'杨正国'],
            ['id'=>'2','name'=>'赵红伟'],
            ['id'=>'3','name'=>'王磊']
        ];
        $pmuser=new User();
        //找出所有PM，拼成数组
        $pmuser=User::find(['role'=>'1']);
        
        /*foreach ($pmuser as $key=>$attr){
            $value1=['id'=>$attr->getAttribute('id'),'name'=>$attr->getAttribute('username')];
            array_push($pmdata, $value1);
        }*/
        /*
        if ($model->load(yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }*/
        
        $from=yii::$app->getRequest()->getQueryParam('from');
       // $ispost= yii::$app->getRequest()->isPost();
        if($from=='modal'){
            return $this->renderAjax('addprojplan',[ 'model' => $model,'pmdata'=>$pmdata]);
        }else if( $model->load(yii::$app->request->post()) ){
            //return $this->render('/projectplan/index');
            $value='某人';
            $model->setAttribute('chargeusername', $value);
            $model->save();
            return $this->redirect('index.php?r=projectplan');
        }
        
    }
    
}