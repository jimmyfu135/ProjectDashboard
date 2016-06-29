<?php

namespace backend\controllers;

use common\models\Taskproject;
use yii\web\Controller;
use common\models\Task;
use common\models\User;
use yii\helpers\Html;
use yii\data\Pagination;
use common\models\CommConfigData;

use Yii;


class TaskController extends Controller{

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
		//获取任务状态
		$myCommConfigData = new CommConfigData();
		$taskStatus = $myCommConfigData->getTaskStatus();
		return $this->render('index', ['data' => $data, 'modelTask' => $modelTask, 'pagination' => $pagination, 'categorys' => Task::geAlltUser(), 'taskstatus' => $taskStatus]);
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