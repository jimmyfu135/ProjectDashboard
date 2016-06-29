<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "projectplan".
 *
 * @property integer $id
 * @property string $subject
 * @property string $begindate
 * @property string $enddate
 * @property string $yjsubmitdate
 * @property integer $chargeuserid
 * @property string $chargeusername
 * @property integer $pmid
 * @property string $pmname
 * @property integer $departid
 * @property string $departname
 * @property integer $careerdepartid
 * @property string $careerdepartname
 * @property integer $projecttype
 * @property double $workload
 * @property integer $projectlevel
 * @property string $customer
 * @property integer $userid
 * @property string $username
 * @property integer $created_at
 * @property integer $updated_at
 */
class Projectplan extends ActiveRecord{
    public static function tableName()
    {
        return '{{%projectplan}}';
    }
    
    public function rules()
    {
        return [
            ['subject' , 'required' ,'message'=>'主题不允许为空'],
            ['begindate' , 'required' ,'message'=>'计划开始时间不允许为空'],
            ['enddate' , 'required' ,'message'=>'计划结束时间不允许为空'],
            ['yjsubmitdate' , 'required' ,'message'=>'预计提交时间不允许为空'],
            ['pmid' , 'required' ,'message'=>'需求PM不允许为空'],
            ['projectlevel' , 'required' ,'message'=>'需求级别不允许为空'],
            ['workload' , 'required' ,'message'=>'预计工作量不允许为空'],
            ['customer' , 'required' ,'message'=>'客户名称不允许为空'],
            ['careerdepartid' , 'required' ,'message'=>'责任事业部不允许为空'],
            ['chargeuserid', 'required' ,'message'=>'需求负责人不允许为空']
            
        ];
        /*return array(
            //必填校验
            array('subject, begindate, enddate,yjsubmitdate,chargeuserid', 'required')
        );*/
    }

    public static function requirementCalendarList($departName){
        //return Projectplan::find()->all();
        $sql = 'select `subject` as `title`, date_format(`begindate`,\'%Y-%m-%d\') as `start`,date_format(`enddate`,\'%Y-%m-%d\') as `end` from v_projectplan where departname = :departname';
        return Projectplan::findBySql($sql)->addParams([':departname' => $departName])->asArray()->all();
    }
}
