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
 * @property integer $customerid
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
            ['customerid' , 'required' ,'message'=>'客户名称不允许为空'],
            ['careerdepartid' , 'required' ,'message'=>'责任事业部不允许为空'],
            ['chargeuserid', 'required' ,'message'=>'需求负责人不允许为空'],
            ['workload', 'number','message'=>'预计工作量必须是数值'],
            ['subject', 'string', 'max' => 100,'message'=>'项目计划名称不允许大于100字节'],
        ];
    }

    /*
     * 获取需求日历列表
     * $param string $departName abu名称
     * return array 需求列表
     * */
    public static function requirementCalendarList($filtertype,$departName,$careername)
    {
        //return Projectplan::find()->all();
        $sql = "";
        if ($filtertype == "abu") {
            $sql = 'select id,`title`, date_format(`begindate`,\'%Y-%m-%d\') as `start`,date_format(`enddate`,\'%Y-%m-%d\') as `end`
 ,`subject`,chargeusername,pmusername,projecttype,workload,projectlevel
 ,case projectlevel WHEN 1 then \'已回款\' when 1 then \'已签约未回款\' when 3 then \'未签约先投入\' ELSE \'其它\' end as projectlevelchn
 ,case projecttype when 1 then \'零星需求\' when 2 then \'专项批次\' ELSE \'其它\' END as projecttypechn
from v_projectplan where departname = :departname';
            return Projectplan::findBySql($sql)->addParams([':departname' => $departName])->asArray()->all();
        } else if($filtertype == "career") {
            $sql = 'select id,`title`, date_format(`begindate`,\'%Y-%m-%d\') as `start`,date_format(`enddate`,\'%Y-%m-%d\') as `end`
 ,`subject`,chargeusername,pmusername,projecttype,workload,projectlevel
 ,case projectlevel WHEN 1 then \'已回款\' when 1 then \'已签约未回款\' when 3 then \'未签约先投入\' ELSE \'其它\' end as projectlevelchn
 ,case projecttype when 1 then \'零星需求\' when 2 then \'专项批次\' ELSE \'其它\' END as projecttypechn
from v_projectplan where careername = :careername';
            return Projectplan::findBySql($sql)->addParams([':careername' => $careername])->asArray()->all();
        }else{
            $sql = 'select id,`title`, date_format(`begindate`,\'%Y-%m-%d\') as `start`,date_format(`enddate`,\'%Y-%m-%d\') as `end`
 ,`subject`,chargeusername,pmusername,projecttype,workload,projectlevel
 ,case projectlevel WHEN 1 then \'已回款\' when 1 then \'已签约未回款\' when 3 then \'未签约先投入\' ELSE \'其它\' end as projectlevelchn
 ,case projecttype when 1 then \'零星需求\' when 2 then \'专项批次\' ELSE \'其它\' END as projecttypechn
from v_projectplan';
            return Projectplan::findBySql($sql)->asArray()->all();
        }
        //return Projectplan::findBySql($sql)->addParams([':departname' => $departName,':careername' => $careername])->asArray()->all();
    }
}
