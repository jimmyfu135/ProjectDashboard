<?php
namespace backend\controllers;

use yii\web\Controller;
use common\models;
use common\models\Projectplan;
use yii;
use common\models\User;
use common\models\CommConfigData;

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
        /*
         * 从数据库动态获取PM的名称和id
        $pmuser=new User();
        //找出所有PM，拼成数组
        $pmuser=User::find(['role'=>'1']);
        
        foreach ($pmuser as $key=>$attr){
            $value1=['id'=>$attr->getAttribute('id'),'name'=>$attr->getAttribute('username')];
            array_push($pmdata, $value1);
        }*/
       /*
        * 固定需求级别
        */
        $myCommConfigData=new CommConfigData();
        $projectlevel=$myCommConfigData->getProjectlevel();
        
        $from=yii::$app->getRequest()->getQueryParam('from');
       // $ispost= yii::$app->getRequest()->isPost();
        if($from=='modal'){
            
            //传递过来的开始时间和结束时间
            $begindate=yii::$app->getRequest()->getQueryParam('begindate');
            $enddate=yii::$app->getRequest()->getQueryParam('enddate');
            $model->setAttribute('begindate', $begindate);
            $model->setAttribute('enddate', $enddate);

            return $this->renderAjax('addprojplan',[ 'model' => $model,'pmdata'=>$pmdata,'projectlevel'=>$projectlevel]);
        }else if( $model->load(yii::$app->request->post()) ){
            //return $this->render('/projectplan/index');
            $model->validate();
            //var_dump($model->errors);
            
            $value='某人';
            $model->setAttribute('pmname', $value);
            
            //设置当前操纵用户的信息
            $userid= yii::$app->user->id;
            $currentuser=new User();
            $currentuser=User::findIdentity($userid);
            var_dump($currentuser);
            $username=$currentuser->username;
            $model->setAttribute('userid', $userid);
            $model->setAttribute('username', $username);
            
            $workload= $model->workload;
            if($workload>=5){
                //专项
                $model->setAttribute('projecttype', 2);
            }else{
                //零星
                $model->setAttribute('projecttype', 1);
            }
            
            $model->save();
            //echo $model->begindate;
            return $this->redirect('index.php?r=projectplan');
        }
        
    }
    /*
     * 选择用户
     */
    public function actionChoiceuser(){
        $model=User::findAll();
        return $this->renderAjax('choiceuser',[ 'model' => $model]);
    }
    
}