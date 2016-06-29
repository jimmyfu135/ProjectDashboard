<?php

namespace backend\controllers;

use yii\web\Controller;
use common\models\Taskproject;
use common\models\Task;
use common\models\Projectplan;
use common\models\User;
use yii\helpers\Html;
use yii\data\Pagination;
use common\models\CommConfigData;

use Yii;


class TaskprojectController extends Controller{

	public function actionIndex(){
		return $this->render('index');
	}

	public function actionAddtaskproj()
	{
		$model = new Task();
		$modelTask = new Taskproject();//获取任务状态
		$myCommConfigData = new CommConfigData();
		$taskStatus = $myCommConfigData->getTaskStatus();
		//新增保存
		if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $modelTask->load(Yii::$app->request->post()) && yii::$app->request->isAjax ) {
			$modelTask->begindate = $model->begindate;
			$modelTask->enddate = $model->enddate;
			$modelTask->taskstatus = $model->taskstatus;
			$modelTask->workload = $model->workload;
			//事务
			$transaction = \Yii::$app->db->beginTransaction();
			//主从表保存
			if ($modelTask->save()) {
				$model->taskid = $modelTask->id;
				if (!$model->save()) {
					$transaction->rollback();
					return $this->renderAjax('add', ['model' => $model, 'categorys' => Task::getUser(), 'modelTask' => $modelTask, 'taskstatus' => $taskStatus]);
				} else {
					$transaction->commit();
					return 'ok';
				}
			} else {
				$transaction->rollback();
				return $this->renderAjax('add', ['model' => $model, 'categorys' => Task::getUser(), 'modelTask' => $modelTask, 'taskstatus' => $taskStatus]);
			}
		}
		else {
			//传递过来的开始时间和结束时间
			$begindate = yii::$app->getRequest()->getQueryParam('begindate');
			$enddate = yii::$app->getRequest()->getQueryParam('enddate');
			$model->begindate = $begindate;
			$model->enddate = $enddate;
		}
		return $this->renderAjax('add', ['model' => $model, 'categorys' => Task::getUser(), 'modelTask' => $modelTask, 'taskstatus' => $taskStatus]);
	}


	public function actionEdit($id){
		$id = (int)$id;
		if($id > 0 && ($model = Task::findOne($id))){
			if(Yii::$app->request->isPost && $model -> load(Yii::$app->request->post()) && $model->save()){
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

    //任务指派
	public function actionAssignedtask($id)
	{
		//需求id
		$id = (int)$id;
		$projectplanModel = new Projectplan();
		$projectplanModel = Projectplan::findOne($id);
		//判断该需求关联的任务是否存在，如果不存在则新增一条任务记录
		$taskproject = Taskproject::find()->where(['planid' => $id])->one();;
		if (!$taskproject) {
			//新增一条记录
			$taskproject = new Taskproject();
			$taskproject->planid = $projectplanModel->id;
			$taskproject->subject = $projectplanModel->subject;
			$taskproject->begindate = $projectplanModel->begindate;
			$taskproject->enddate = $projectplanModel->enddate;
			$taskproject->workload = $projectplanModel->workload;
			$taskproject->projecttype = $projectplanModel->projecttype;
			$taskproject->projectlevel = $projectplanModel->projectlevel;
			$taskproject->pmid = $projectplanModel->pmid;
			$taskproject->departid = $projectplanModel->departid;
			$taskproject->careerdepartid = $projectplanModel->careerdepartid;
			$taskproject->save(false);
		}
		$taskid= $taskproject->id;
		return $this->redirect(['task/index','taskid'=>$taskid]);
	}
}
?>