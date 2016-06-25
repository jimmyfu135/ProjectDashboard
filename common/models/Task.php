<?php

namespace common\models;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


class Task extends ActiveRecord{

	public static function tableName(){
		return '{{%taskassign}}';
	}

	public function rules(){
		return [
			['userid' , 'required','message' => '请选择人员'],
			['begindate' , 'required', 'message' => '开始日期不能为空'],
			['enddate' , 'required', 'message' => '结束日期不能为空'],
			//[['begindate', 'enddate'], 'date', 'message' => '日期格式不合法'],
			['workload' , 'number', 'min' => 0, 'message' => '请录入数值', 'tooSmall' => '请录入大于0的数值'],
			['workload' , 'required','message' => '请录入工作量'],
			['taskstatus' , 'required','message' => '请选择任务状态'],
			['stationname' , 'required','message' => '请选择岗位'],
		];
	}



	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			$time = time();
			if ($this->isNewRecord) $this->created_at = $time;
			$this->updated_at = $time;
			//$newDate = DateTime::createFromFormat('d-m-Y', $this->begindate);
			//$this->begindate = $newDate->format('d-m-Y');
			return true;
		}
		return false;
	}

	/**
	 * 读取 ， 根据id排序
	 */
	public static function getUser()
	{
		return User::find()->all();
	}

	/**
	 * 读取 ， 根据id排序
	 */
	public static function geAlltUser()
	{
		return ArrayHelper::index(User::find()->select('id,username')->asArray()->all(), 'id');
	}


}









?>