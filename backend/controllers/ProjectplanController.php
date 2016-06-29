<?php
namespace backend\controllers;

use yii\web\Controller;
use common\models;
use common\models\Projectplan;
use yii;
use common\models\User;
use common\models\CommConfigData;
use common\models\Careerdepartment;
use yii\base\Response;

class ProjectplanController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }
   
    /*
     * 只用于首次打开，如新增、修改打开界面，从后端提取界面展示数据
     */
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
        $careerdepart = new Careerdepartment();
        $careerdepart = Careerdepartment::find()->all();

        $arrchargeuserid=[];
        // 如果是修改的话
        $projplanid = yii::$app->getRequest()->getQueryParam('id');
        if ($projplanid == NULL) {
            // 新增
            // 传递过来的开始时间和结束时间
            $begindate = yii::$app->getRequest()->getQueryParam('begindate');
            $enddate = yii::$app->getRequest()->getQueryParam('enddate');
            $model->setAttribute('begindate', $begindate);
            $model->setAttribute('enddate', $enddate);
            
            
            return $this->renderAjax('addprojplan', [
                'model' => $model,
                'pmdata' => $pmdata,
                'projectlevel' => $projectlevel,
                'careerdepart' => $careerdepart,
                'arrchargeuserid'=>[]
            ]);
        } else {
            // 修改
            $model = Projectplan::findOne([
                'id' => $projplanid
            ]);
            
            $model->begindate=substr($model->begindate,0,10);
            $model->enddate=substr($model->enddate, 0,10);
            $model->yjsubmitdate=substr($model->yjsubmitdate, 0,10);
            
            $careerdepartid = $model->careerdepartid;
            $careeruser=new User;
            if($careerdepartid!=NULL){
                //$taskproject=Taskproject::find()->where(['planid'=>$id])->one();;
                $sql = 'select usernameChn,id from user where careerdepartmentid = :careerdepartmentid';
                $careeruser= User::findBySql($sql)->addParams([':careerdepartmentid' => $careerdepartid])->asArray()->all();
            }else{
                $careeruser=[];
            }
            
            return $this->renderAjax('editprojplan', [
                'model' => $model,
                'pmdata' => $pmdata,
                'projectlevel' => $projectlevel,
                'careerdepart' => $careerdepart,
                'arrchargeuserid'=>$careeruser
            ]);
        }
    
    }
    
    public function saveInterl($model){
        $model->setAttribute('pmname', User::findOne([
            'id' => $model->pmid
        ])->usernameChn);
        
        // 设置当前操纵用户的信息
        $userid = yii::$app->user->id;
        
        $model->setAttribute('userid', $userid);
        
        $workload = $model->workload;
        if ($workload >= 5) {
            // 专项
            $model->setAttribute('projecttype', 2);
        } else {
            // 零星
            $model->setAttribute('projecttype', 1);
        }
        
        $model->save();
        return 'ok';
    }
    
    /*
     * ajax提交新增的数据
     */
    public function actionAjaxaddprojplan(){
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
        $careerdepart = new Careerdepartment();
        $careerdepart = Careerdepartment::find()->all();
        
        if ($model->load(yii::$app->request->post()) && yii::$app->request->isAjax) {
            // return $this->render('/projectplan/index');
            $careerdepartid = $model->careerdepartid;
            $careeruser=new User;
            if($careerdepartid!=NULL){
                //$taskproject=Taskproject::find()->where(['planid'=>$id])->one();;
                $sql = 'select usernameChn,id from user where careerdepartmentid = :careerdepartmentid';
                $careeruser= User::findBySql($sql)->addParams([':careerdepartmentid' => $careerdepartid])->asArray()->all();
            }else{
                $careeruser=[];
            }
            if($model->validate()){
               
                // 设置当前操纵用户的信息
                $userid = yii::$app->user->id;
               
                $model->setAttribute('userid', $userid);
                
                $workload = $model->workload;
                if ($workload >= 5) {
                    // 专项
                    $model->setAttribute('projecttype', 2);
                } else {
                    // 零星
                    $model->setAttribute('projecttype', 1);
                }
                
                $model->save();
                return 'ok'; 
            }else{
                return $this->renderAjax('addprojplan', [
                        'model' => $model,
                        'pmdata' => $pmdata,
                        'projectlevel' => $projectlevel,
                        'careerdepart' => $careerdepart,
                        'arrchargeuserid'=>$careeruser
                    ]);
            }
        }
    }
    
    /*
     * ajax提交修改的数据
     */
    public function actionAjaxupdateprojplan(){
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
        $careerdepart = new Careerdepartment();
        $careerdepart = Careerdepartment::find()->all();
    
        $projplanid = yii::$app->getRequest()->getQueryParam('id');
        
        
        if ($projplanid != NULL && ($model = Projectplan::findOne($projplanid)) && $model->load(yii::$app->request->post()) && yii::$app->request->isAjax) {
            $careerdepartid = $model->careerdepartid;
            $careeruser=new User;
            if($careerdepartid!=NULL){
                //$taskproject=Taskproject::find()->where(['planid'=>$id])->one();;
                $sql = 'select usernameChn,id from user where careerdepartmentid = :careerdepartmentid';
                $careeruser= User::findBySql($sql)->addParams([':careerdepartmentid' => $careerdepartid])->asArray()->all();
            }else{
                $careeruser=[];
            }
            if($model->validate()){
                $model->save();
                return 'ok';
            }else{
                
                return $this->renderAjax('editprojplan', [
                    'model' => $model,
                    'pmdata' => $pmdata,
                    'projectlevel' => $projectlevel,
                    'careerdepart' => $careerdepart,
                    'arrchargeuserid'=>$careeruser
                ]);
            }
        }
    }

    /*
     * 删除项目计划
     */
    public function actionDelprojplan()
    {
        $id = Yii::$app->getRequest()->getQueryParam('id');
        
        if ($id != NULL && $model = Projectplan::findOne($id)) {

            $model->delete();
            
            return 'ok';
        }else{
            return '找不到对应的需求计划，请刷新页面重试！';
        }
    }
   
    /*
     * 获取指定事业部下面的所有用户
     */
    public function actionAjaxgetcareeruser(){
        $id = Yii::$app->getRequest()->getQueryParam('careerdepartid');
        $careeruser=new User;
        if($id!=NULL){
            //$taskproject=Taskproject::find()->where(['planid'=>$id])->one();;
            $sql = 'select usernameChn,id from user where careerdepartmentid = :careerdepartmentid';
           
            $careeruser= User::findBySql($sql)->addParams([':careerdepartmentid' => $id])->asArray()->all();
            
            //return $careeruser;
            //\yii\helpers\Json::encode($test);
            return yii\helpers\Json::encode($careeruser);
        }else{
            return '没有收到';
        }
    }
}