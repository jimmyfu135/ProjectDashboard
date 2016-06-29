<?php

namespace backend\controllers;

use common\models\Taskproject;
use yii\web\Controller;
use common\models\Projectplan;
use common\models\Task;
use common\models\User;
use yii\helpers\Html;
use yii\data\Pagination;
use common\models\CommConfigData;

use Yii;


class TaskController extends Controller{

	public function actionIndex(){
		$user = Task::find();
		$pagination = new Pagination(['totalCount' => $user->count(), 'pageSize' => 5]);
		$data = $user->offset($pagination->offset)->limit($pagination->limit)->all();
		//获取任务状态
		$myCommConfigData=new CommConfigData();
		$taskStatus=$myCommConfigData->getTaskStatus();

		return $this->render('index' , ['data' => $data, 'pagination' => $pagination , 'pagination' => $pagination, 'categorys' => Task::geAlltUser(),'taskstatus'=>$taskStatus]);
	}



	public function actionAdd(){

		$model = new Task();

		if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()){
			//echo 'success';
			Yii::$app->session->setFlash('success', '指派成功');
			return $this->redirect(['index']);
		}
		//获取任务状态
		$myCommConfigData=new CommConfigData();
		$taskStatus=$myCommConfigData->getTaskStatus();
		return $this->render('add' , ['model' => $model,'categorys' => Task::getUser(),'taskstatus'=>$taskStatus]);
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

	public function actionAssignedtask($id)
	{
		//需求id
		$id = (int)$id;
		$projectplanModel=new Projectplan();
		$projectplanModel=Projectplan::findOne($id);
		//判断该需求关联的任务是否存在，如果不存在则新增一条任务记录
		$taskproject=Taskproject::find()->where(['planid'=>$id])->one();;
		if(!$taskproject) {
			//新增一条记录
			$taskproject = new Taskproject();
			$taskproject->planid=$projectplanModel->id;
			$taskproject->subject = $projectplanModel->subject;
			$taskproject->begindate = $projectplanModel->begindate;
			$taskproject->enddate = $projectplanModel->enddate;
			$taskproject->workload = $projectplanModel->workload;
			$taskproject->projecttype = $projectplanModel->projecttype;
			$taskproject->projectlevel = $projectplanModel->projectlevel;
			$taskproject->pmid = $projectplanModel->pmid;
			$taskproject->pmname = $projectplanModel->pmname;
			$taskproject->departid = $projectplanModel->departid;
			$taskproject->departname = $projectplanModel->departname;
			$taskproject->careerdepartid = $projectplanModel->careerdepartid;
			$taskproject->careerdepartname = $projectplanModel->careerdepartname;
			$taskproject->save(false);
		}

		$taskAssingn = Task::find()->where(['taskid'=>$taskproject->id]);
		$pagination = new Pagination(['totalCount' => $taskAssingn->count(), 'pageSize' => 5]);
		$data = $taskAssingn->offset($pagination->offset)->limit($pagination->limit)->all();
		//获取任务状态
		$myCommConfigData=new CommConfigData();
		$taskStatus=$myCommConfigData->getTaskStatus();
		return $this->redirect('index' , ['data' => $data, 'pagination' => $pagination , 'pagination' => $pagination, 'categorys' => Task::geAlltUser()]);
	}

}








?>