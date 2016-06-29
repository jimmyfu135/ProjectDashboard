<?php

namespace common\models;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property string $subject
 * @property string $begindate
 * @property string $enddate
 * @property integer $planid
 * @property integer $pmid
 * @property string $pmname
 * @property integer $departid
 * @property string $departname
 * @property integer $careerdepartid
 * @property string $careerdepartname
 * @property integer $projecttype
 * @property double $workload
 * @property integer $projectlevel
 * @property integer $taskstatus
 * @property integer $userid
 * @property string $username
 * @property integer $created_at
 * @property integer $updated_at
 */
class Taskproject extends ActiveRecord{

	public static function tableName(){
		return '{{%task}}';
	}

	public function rules(){
		return [
			['subject' , 'safe'],
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
		return ArrayHelper::index(User::find()->select('id,usernameChn')->asArray()->all(), 'id');
	}


}









?>