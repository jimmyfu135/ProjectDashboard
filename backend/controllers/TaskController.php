<?php

namespace backend\controllers;

use common\models\Taskproject;
use yii\web\Controller;
use common\models\Task;
use common\models\User;
use yii\helpers\Html;
use yii\data\Pagination;
use common\models\CommConfigData;

use yii;


class TaskController extends Controller{
	public $enableCsrfValidation = false;
	public function actionIndex()
	{
		$taskid = yii::$app->getRequest()->getQueryParam('taskid');
		if ($taskid) {
			$id = (int)$taskid;
			$user = Task::find()->where(['taskid' => $taskid]);
		} else {
			$user = Task::find();
		}
		$modelTask = Taskproject::findOne($taskid);
		$pagination = new Pagination(['totalCount' => $user->count(), 'pageSize' => 5]);
		$data = $user->offset($pagination->offset)->limit($pagination->limit)->all();
		//获取当前任务下的所有用户信息

		//获取任务状态
		$myCommConfigData = new CommConfigData();
		$taskStatus = $myCommConfigData->getTaskStatus();
		return $this->render('index', ['data' => $data, 'modelTask' => $modelTask, 'pagination' => $pagination, 'categorys' => Task::geAlltUser(), 'taskstatus' => $taskStatus,'teamUser'=>Task::getTeamUser($modelTask->departid)]);
	}



	public function actionAdd()
	{

		$model = new Task();
		$taskid = yii::$app->getRequest()->getQueryParam('taskid');
		$model->taskid = $taskid;
		if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
			//echo 'success';
			Yii::$app->session->setFlash('success', '指派成功');
			return $this->redirect(['index', "taskid" => $taskid]);
		}
		//任务主信息
		$modelTask = Taskproject::findOne($taskid);
		//获取任务状态
		$myCommConfigData = new CommConfigData();
		$taskStatus = $myCommConfigData->getTaskStatus();
		return $this->render('add', ['model' => $model,'modelTask'=>$modelTask, 'categorys' => Task::getUser(), 'taskstatus' => $taskStatus]);
	}


	public function actionEdit($id){
		$id = (int)$id;
		$taskid = yii::$app->getRequest()->getQueryParam('taskid');
		//任务主信息
		$modelTask = Taskproject::findOne($taskid);
		if($id > 0 && ($model = Task::findOne($id))){
			$model->begindate=substr($model->begindate,0,10);
			$model->enddate=substr($model->enddate, 0,10);
			if(Yii::$app->request->isPost && $model -> load(Yii::$app->request->post()) && $model->save()){
				Yii::$app->session->setFlash('success', '修改成功');
				return $this->redirect(['index', 'taskid' => $taskid]);
			}
			//获取任务状态
			$myCommConfigData=new CommConfigData();
			$taskStatus=$myCommConfigData->getTaskStatus();
			return $this->render('edit' , ['model' => $model,'modelTask'=>$modelTask,'categorys' => Task::getUser(),'taskstatus'=>$taskStatus]);
		}

		return $this->redirect(['index', 'taskid' => $taskid]);
	}
	//保存任务
	public function actionAjaxsavetask(){

		$taskid = yii::$app->getRequest()->getQueryParam('taskid');
		//1.删除当前计划下的所有任务指派
		$taskassign=Task::findBySql("select id from taskassign where taskid=:taskid")->addParams([':taskid'=>$taskid])->asArray()->all();
		foreach($taskassign as $id){
			Task::findOne($id)->delete();
		}
		//添加用户
		$data= file_get_contents("php://input");

		$arrTaskAssign=explode('|',$data);
		foreach($arrTaskAssign as $u){
			if($u!=""){
				$taskinfoObj=json_decode($u);
				$taskmodel=new Task();
				$taskmodel->taskid=$taskid;
				//substr($model->begindate,0,10)
				$taskmodel->begindate=$taskinfoObj->{"begindate"};
				$taskmodel->enddate=$taskinfoObj->{"enddate"};
				$taskmodel->stationname=$taskinfoObj->{"stationname"};
				$taskmodel->workload=$taskinfoObj->{"workload"};
				$userid=User::findIDByUsernameChn($taskinfoObj->{"userid"});
				$taskmodel->userid=$userid;
				$taskmodel->taskstatus="1";
				$taskmodel->save();
			}
		}
		return "ok";
		/*

		$taskid=76;
		$taskassign=Task::findBySql("select id from taskassign where taskid=:taskid")->addParams([':taskid'=>$taskid])->asArray()->all();
		foreach($taskassign as $id){
			Task::findOne($id)->delete();
		}
		return "ok";
		*/
	}
	//获取任务
	public  function actionGettask(){
		$taskid = yii::$app->getRequest()->getQueryParam('taskid');
		$taskassign=Task::findBySql("select stationname ,userid ,begindate,enddate,workload from taskassign where taskid=:taskid")->addParams([':taskid'=>$taskid])->asArray()->all();
		return yii\helpers\Json::encode($taskassign);
	}
	public function actionDelete($id)
	{
		$id = (int)$id;
		$taskid = yii::$app->getRequest()->getQueryParam('taskid');
		//任务主信息
		$modelTask = Taskproject::findOne($taskid);
		if ($id > 0) {
			if (Task::findOne($id)->delete()) {
				Yii::$app->session->setFlash('success', '删除成功');
			} else {
				Yii::$app->session->setFlash('error', '删除失败');
			}
		}
		return $this->redirect(['index','taskid'=>$taskid]);
	}



}








?>