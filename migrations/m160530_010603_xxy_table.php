<?php

use yii\db\Migration;

class m160530_010603_xxy_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('xxy_table', [
           'id' => 'pk',
            'username' => 'string  NOT NULL COMMENT "用户名"',
            'pass' => 'string NOT NULL COMMENT "密码"',
            'authKey' => 'char(100) DEFAULT "" NOT NULL',
            'accessToken'=> 'char(100) DEFAULT "" NOT NULL'
        ]);
        $this->insert('xxy_table', [
            'username' => 'root',
            'pass' => '1234567'
        ]);
        // $this->createTable('xxy_userinfo', [
        //    'id' => 'pk',
        //    'uid' => 'int  NOT NULL COMMENT "用户id"',
        //    'phone' => 'int NOT NULL COMMENT "手机"',
        //    'sex' => 'int DEFAULT 0 NOT NULL COMMENT "性别"',
        //    'hobby'=> 'string NOT NULL COMMENT "爱好"',
           
        // ]);
        $this->createTable('xxy_ip',[
            'id' => 'pk',
            'sip' => 'varchar(15) NOT NULL COMMENT "startip"',
            `scip` => 'int(11) unsigned NOT NULL COMMENT "start整形"',
            `eip` => 'varchar(15) NOT NULL COMMENT "endip"',
            `ecip` => 'int(11) unsigned NOT NULL COMMENT "endip整形"',
            `address` => 'varchar(255) NOT NULL COMMENT "地址"',
            `isp` => 'varchar(255) NOT NULL COMMENT "供应商"'
            ]
    }

    public function safeDown()
    {
        $this->delete('xxy_table',['id' =>1]);
        $this->dropTable('xxy_table');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
