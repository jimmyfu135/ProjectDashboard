<?php

use yii\db\Migration;

class m160619_135829_projectplan extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%projectplan}}', [
            'id' => $this->primaryKey(),
            'subject' => $this->string(100)->notNull(),
            'begindate' => $this->dateTime(),
            'enddate' => $this->dateTime(),
            'yjsubmitdate' => $this->dateTime(),
            'chargeuserid' => $this->integer(),
            'chargeusername' => $this->string(20),
            'pmid' => $this->integer(),
            'pmname' => $this->string(20),
            'departid' => $this->integer(),
            'departname' => $this->string(50),
            'careerdepartid' => $this->integer(),
            'careerdepartname' => $this->string(50),
            'projecttype' => $this->integer(),//枚举：专项批次、零星
            'workload' => $this->double(),
            'projectlevel' => $this->integer(),//枚举：已汇款、已签约未回款、未签约先投入
            'customer' => $this->string(50),
            'userid' => $this->integer(),
            'username' => $this->string(20),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%projectplan}}');
    }
}
