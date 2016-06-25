<?php

namespace common\models;

class CommConfigData  {
    /*
    const �ѻؿ�=1;
    const ��ǩԼδ�ؿ�=2;
    const δǩԼ��Ͷ��=3;
    */
   
    public function getProjectlevel(){
        return [
            ['id'=>'1','name'=>'已回款'],
            ['id'=>'2','name'=>'已签约未回款'],
            ['id'=>'3','name'=>'未签约先投入']
        ];
    }
    public function getTaskStatus()
    {
        return [
            ['id' => '1', 'name' => '未开始'],
            ['id' => '2', 'name' => '处理中'],
            ['id' => '3', 'name' => '已完成']
        ];
    }
}