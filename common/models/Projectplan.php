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

    public static function calendarList(){
        //return Projectplan::find()->all();
        $sql = 'select `subject` as `title`, date_format(`begindate`,\'%Y-%m-%d\') as `start`,date_format(`enddate`,\'%Y-%m-%d\') as `end` from projectplan';
        return Projectplan::findBySql($sql)->asArray()->all();
    }
}
