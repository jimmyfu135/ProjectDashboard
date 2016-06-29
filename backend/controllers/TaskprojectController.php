<?php

namespace backend\controllers;

use yii\web\Controller;
use common\models\Taskproject;
use common\models\Task;
use common\models\User;
use yii\helpers\Html;
use yii\data\Pagination;
use common\models\CommConfigData;

use Yii;


class TaskprojectController extends Controller{

	public function actionIndex(){
		return $this->render('index');
	}



	public function actionAddtaskproj(){
		$model = new Task();
		$modelTask = new Taskproject();
		//传递过来的开始时间和结束时间
		$begindate=yii::$app->getRequest()->getQueryParam('begindate');
		$enddate=yii::$app->getRequest()->getQueryParam('enddate');
		$model->begindate= $begindate;
		$model->enddate=$enddate;
		$model->username=User::findIdentity($model->userid);
		//新增保存
		if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $modelTask->load(Yii::$app->request->post())) {
			$modelTask->begindate = $model->begindate;
			$modelTask->enddate = $model->enddate;
			$modelTask->taskstatus = $model->taskstatus;
			$modelTask->workload = $model->workload;
			//事务
			$transaction = \Yii::$app->db->beginTransaction();
			//主从表保存
			if ($modelTask->save(false)) {
				$model->taskid=$modelTask->id;
				if (!$model->save()) {
					$transaction->rollback();
				} else {
					$transaction->commit();
					return $this->redirect(['index']);
				}
			} else {
				$transaction->rollback();
			}
		}
		//获取任务状态
		$myCommConfigData=new CommConfigData();
		$taskStatus=$myCommConfigData->getTaskStatus();
		return $this->renderAjax('add' , ['model' => $model,'categorys' => Task::getUser(),'modelTask'=>$modelTask,'taskstatus'=>$taskStatus]);
	}


	public function actionEdit($id){
		$id = (int)$id;
		if($id > 0 && ($model = Task::findOne($id))){

			if(Yii::$app->request->isPost && $model -> load(Yii::$app->request->post()) && $model->save()){
				Yii::$app->session->setFlash('success', '修改成功');
				return $this->redirect(['index']);
			}
			//获取任务状态
			$myCommConfigData=new CommConfigData();
			$taskStatus=$myCommConfigData->getTaskStatus();
			return $this->render('edit' , ['model' => $model,'categorys' => Task::getUser(),'taskstatus'=>$taskStatus]);
		}

		return $this->redirect(['index']);	
	}


	public function actionDelete($id)
	{
		$id = (int)$id;
		if ($id > 0) {
			if (Task::findOne($id)->delete()) {
				Yii::$app->session->setFlash('success', '删除成功');
			} else {
				Yii::$app->session->setFlash('error', '删除失败');
			}
		}
		return $this->redirect(['index']);
	}
}








?>