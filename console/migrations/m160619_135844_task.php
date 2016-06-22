<?php

use yii\db\Migration;

class m160619_135844_task extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'subject' => $this->string(100)->notNull(),
            'begindate' => $this->dateTime(),
            'enddate' => $this->dateTime(),
            'planid' => $this->integer(),
            'pmid' => $this->integer(),
            'pmname' => $this->string(20),
            'departid' => $this->integer(),
            'departname' => $this->string(50),
            'careerdepartid' => $this->integer(),
            'careerdepartname' => $this->string(50),
            'projecttype' => $this->integer(),//枚举：专项批次、零星
            'workload' => $this->double(),
            'projectlevel' => $this->integer(),//枚举：已汇款、已签约未回款、未签约先投入
            'taskstatus' => $this->integer(),//枚举：未开始、处理中、已完成
            'userid' => $this->integer(),
            'username' => $this->string(20),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%task}}');
    }
}
