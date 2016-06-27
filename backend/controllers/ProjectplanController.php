<?php
namespace backend\controllers;

use yii\web\Controller;
use common\models;
use common\models\Projectplan;
use yii;
use common\models\User;
use common\models\CommConfigData;
use common\models\Careerdepartment;

class ProjectplanController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAddprojplan()
    {
        $model = new Projectplan();
        
        /*
         * 从数据库动态获取PM的名称和id
         *
         */
        $pmdata = new User();
        // 找出所有PM，拼成数组
        $pmdata = User::findAll([
            'stationid' => '2'
        ]);
        
        /*
         * 固定需求级别
         */
        $myCommConfigData = new CommConfigData();
        $projectlevel = $myCommConfigData->getProjectlevel();
        
        /*
         * 事业部
         */
        $arrCareerdepartment = [];
        $Careerdepartment = new Careerdepartment();
        $Careerdepartment = Careerdepartment::find()->all();
        
        $from = yii::$app->getRequest()->getQueryParam('from');
        // $ispost= yii::$app->getRequest()->isPost();
        if ($from == 'modal') {
            // 如果是修改的话
            $projplanid = yii::$app->getRequest()->getQueryParam('id');
            if ($projplanid == NULL) {
                // 传递过来的开始时间和结束时间
                $begindate = yii::$app->getRequest()->getQueryParam('begindate');
                $enddate = yii::$app->getRequest()->getQueryParam('enddate');
                $model->setAttribute('begindate', $begindate);
                $model->setAttribute('enddate', $enddate);

                return $this->renderAjax('addprojplan', [
                    'model' => $model,
                    'pmdata' => $pmdata,
                    'projectlevel' => $projectlevel,
                    'careerdepart' => $Careerdepartment
                ]);
            } else {
                $model = Projectplan::findOne(['id'=>$projplanid]);
                
                return $this->renderAjax('editprojplan', [
                    'model' => $model,
                    'pmdata' => $pmdata,
                    'projectlevel' => $projectlevel,
                    'careerdepart' => $Careerdepartment
                ]);
            }
        } else 
            if ($model->load(yii::$app->request->post())) {
                // return $this->render('/projectplan/index');
                $model->validate();

                $model->setAttribute('pmname', User::findOne(['id'=>$model->pmid])->usernameChn);
                
                // 设置当前操纵用户的信息
                $userid = yii::$app->user->id;
                $currentuser = new User();
                $currentuser = User::findIdentity($userid);
                var_dump($currentuser);
                $username = $currentuser->usernameChn;
                $model->setAttribute('userid', $userid);
                $model->setAttribute('username', $username);
                
                $workload = $model->workload;
                if ($workload >= 5) {
                    // 专项
                    $model->setAttribute('projecttype', 2);
                } else {
                    // 零星
                    $model->setAttribute('projecttype', 1);
                }
                
                $model->save();
                // echo $model->begindate;
                return $this->redirect('index.php');
            }
       
    }
    
    public function actionUpdateprojplan(){
        $model = new Projectplan();
        if ($model->load(yii::$app->request->post())) {
            $model->update();
            Url::to(['index']);
        }
    }
    
    public function actionDelprojplan(){
        $id=Yii::$app->getRequest()->getQueryParam('id');
       
        Projectplan::deleteAll(['id'=>$id]);
        
        Url::to(['index']);
    }
    
    /*
     * 选择用户
     */
    public function actionChoiceuser(){
        $model=User::findAll();
        return $this->renderAjax('choiceuser',[ 'model' => $model]);
    }
    
}