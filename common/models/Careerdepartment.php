<?php
namespace common\models;

use yii\db\ActiveRecord;

class Careerdepartment extends ActiveRecord{
    public static function tableName()
    {
        return '{{%careerdepartment}}';
    }
    
}
