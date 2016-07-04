<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/** 
 * This is the model class for table "customer". 
 * 
 * @property integer $id
 * @property string $name
 * @property integer $careerdepartmentid
 * @property integer $departid
 */ 
class Customer extends ActiveRecord{
    public static function tableName()
    {
        return '{{%customer}}';
    }
}