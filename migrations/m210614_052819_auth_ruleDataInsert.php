<?php

use yii\db\Schema;
use yii\db\Migration;

class m210614_052819_auth_ruleDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->execute("set foreign_key_checks=0");
        $this->truncateTable('{{%auth_rule}}');
        $this->execute("set foreign_key_checks=1");
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%auth_rule}} CASCADE');
    }
}
