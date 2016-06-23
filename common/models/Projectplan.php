<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Projectplan extends ActiveRecord{
    public static function tableName()
    {
        return '{{%projectplan}}';
    }
    
    public function rules()
    {
        return [
            ['subject' , 'required' ,'message'=>'主题不允许为空'],
            ['begindate' , 'required'],
            ['enddate' , 'required'],
            ['yjsubmitdate' , 'required'],
            ['pmid' , 'required'],
            ['projectlevel' , 'required'],
            ['workload' , 'required'],
            ['customer' , 'required'],
            
        ];
        /*return array(
            //必填校验
            array('subject, begindate, enddate,yjsubmitdate,chargeuserid', 'required')
        );*/
    }
}
