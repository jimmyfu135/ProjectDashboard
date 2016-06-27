<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Projectplan model
 *
 * @property integer $id
 * @property string $subject
 * @property string $begindate
 * @property string $enddate
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
            ['careerdepartid' , 'required'],
            
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
