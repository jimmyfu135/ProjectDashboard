<?php
namespace backend\controllers;

use yii\web\Controller;
use common\models;
use common\models\Projectplan;
use common\models\Customer;
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
        
        $arrchargeuserid = [];
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
                'arrchargeuserid' => [],
                'arrcustomer' => []
            ]);
        } else {
            // 修改
            $model = Projectplan::findOne([
                'id' => $projplanid
            ]);
            
            $model->begindate = substr($model->begindate, 0, 10);
            $model->enddate = substr($model->enddate, 0, 10);
            $model->yjsubmitdate = substr($model->yjsubmitdate, 0, 10);
            
            $careerdepartid = $model->careerdepartid;
            $careeruser = new User();
            $customer=new Customer();
            //事业部用户
            if ($careerdepartid != NULL) {
                // $taskproject=Taskproject::find()->where(['planid'=>$id])->one();;
                $sql = 'select usernameChn,id from user where careerdepartmentid = :careerdepartmentid';
                $careeruser = User::findBySql($sql)->addParams([
                    ':careerdepartmentid' => $careerdepartid
                ])->asArray()->all();
                
                //客户
                $sql = 'select name,id from customer where careerdepartmentid = :careerdepartmentid';
                $customer = User::findBySql($sql)->addParams([
                    ':careerdepartmentid' => $careerdepartid
                ])->asArray()->all();
            } else {
                $careeruser = [];
                $customer=[];
            }
           
            return $this->renderAjax('editprojplan', [
                'model' => $model,
                'pmdata' => $pmdata,
                'projectlevel' => $projectlevel,
                'careerdepart' => $careerdepart,
                'arrchargeuserid' => $careeruser,
                'arrcustomer'=>$customer
            ]);
        }
    }

    /*
     * ajax提交新增的数据
     */
    public function actionAjaxaddprojplan()
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
        $careerdepart = new Careerdepartment();
        $careerdepart = Careerdepartment::find()->all();
        
        /*
         * 事业部下的客户
         */
        $customer = new Customer();
        if ($model->load(yii::$app->request->post()) && yii::$app->request->isAjax) {
            // 事业部负责人
            $careerdepartid = $model->careerdepartid;
            $careeruser = new User();
            if ($careerdepartid != NULL) {
                // $taskproject=Taskproject::find()->where(['planid'=>$id])->one();;
                $sql = 'select usernameChn,id from user where careerdepartmentid = :careerdepartmentid';
                $careeruser = User::findBySql($sql)->addParams([
                    ':careerdepartmentid' => $careerdepartid
                ])
                    ->asArray()
                    ->all();
            } else {
                $careeruser = [];
            }
            //事业部下的客户
            if ($careerdepartid != NULL) {
                $sql = 'select name,id from customer where careerdepartmentid = :careerdepartmentid';
                $customer = User::findBySql($sql)->addParams([
                    ':careerdepartmentid' => $careerdepartid
                ])->asArray()->all();
            }
            if ($model->validate()) {
                
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
                //保存客户名称
                $customerid=$model->customerid;
                if($customerid!=NULL){
                    $model->customer=Customer::findOne($customerid)->name;
                }
                $model->save();
                return 'ok';
            } else {
                return $this->renderAjax('addprojplan', [
                    'model' => $model,
                    'pmdata' => $pmdata,
                    'projectlevel' => $projectlevel,
                    'careerdepart' => $careerdepart,
                    'arrchargeuserid' => $careeruser,
                    'arrcustomer' => $customer
                ]);
            }
        }
    }

    /*
     * ajax提交修改的数据
     */
    public function actionAjaxupdateprojplan()
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
        $careerdepart = new Careerdepartment();
        $careerdepart = Careerdepartment::find()->all();
        
        $projplanid = yii::$app->getRequest()->getQueryParam('id');
        
        if ($projplanid != NULL && ($model = Projectplan::findOne($projplanid)) && $model->load(yii::$app->request->post()) && yii::$app->request->isAjax) {
            $careerdepartid = $model->careerdepartid;
            $careeruser = new User();
            if ($careerdepartid != NULL) {
                // $taskproject=Taskproject::find()->where(['planid'=>$id])->one();;
                $sql = 'select usernameChn,id from user where careerdepartmentid = :careerdepartmentid';
                $careeruser = User::findBySql($sql)->addParams([
                    ':careerdepartmentid' => $careerdepartid
                ])
                    ->asArray()
                    ->all();
                    //客户
                $sql = 'select name,id from customer where careerdepartmentid = :careerdepartmentid';
                $customer = User::findBySql($sql)->addParams([
                    ':careerdepartmentid' => $careerdepartid
                ])->asArray()->all();
            } else {
                $careeruser = [];
                $customer=[];
            }
            if ($model->validate()) {
                //保存客户名称
                $customerid=$model->customerid;
                if($customerid!=NULL){
                    $model->customer=Customer::findOne($customerid)->name;
                }
                $model->save();
                return 'ok';
            } else {
                
                return $this->renderAjax('editprojplan', [
                    'model' => $model,
                    'pmdata' => $pmdata,
                    'projectlevel' => $projectlevel,
                    'careerdepart' => $careerdepart,
                    'arrchargeuserid' => $careeruser,
                    'arrcustomer'=>$customer
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
        } else {
            return '找不到对应的需求计划，请刷新页面重试！';
        }
    }

    /*
     * 获取指定事业部下面的所有用户
     */
    public function actionAjaxgetcareeruser()
    {
        $id = Yii::$app->getRequest()->getQueryParam('careerdepartid');
        $careeruser = new User();
        if ($id != NULL) {
            // $taskproject=Taskproject::find()->where(['planid'=>$id])->one();;
            $sql = 'select usernameChn,id from user where careerdepartmentid = :careerdepartmentid';
            
            $careeruser = User::findBySql($sql)->addParams([
                ':careerdepartmentid' => $id
            ])
                ->asArray()
                ->all();
            
            return yii\helpers\Json::encode($careeruser);
        } else {
            return '没有收到';
        }
    }

    /*
     * 获取事业部下面的客户信息
     */
    public function actionAjaxgetcustomer()
    {
        $id = Yii::$app->getRequest()->getQueryParam('careerdepartid');
        $customer = new Customer();
        
        if ($id != NULL) {
            // $taskproject=Taskproject::find()->where(['planid'=>$id])->one();;
            $sql = 'select name,id from customer where careerdepartmentid = :careerdepartmentid';
            
            $customer = User::findBySql($sql)->addParams([
                ':careerdepartmentid' => $id
            ])
                ->asArray()
                ->all();
            
            return yii\helpers\Json::encode($customer);
        } else {
            return '没有收到';
        }
    }
}