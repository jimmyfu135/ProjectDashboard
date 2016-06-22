<?php

use yii\db\Migration;

class m160619_135857_taskassign extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%taskassign}}', [
            'id' => $this->primaryKey(),
            'taskid' => $this->integer(),
            'begindate' => $this->dateTime(),
            'enddate' => $this->dateTime(),
            'userid' => $this->integer(),
            'username' => $this->string(20),
            'workload' => $this->double(),
            'stationname' => $this->string(50),
            'taskstatus' => $this->integer(),//枚举：未开始、处理中、已完成

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%taskassign}}');
    }
}
