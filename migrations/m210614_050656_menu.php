<?php

use yii\db\Schema;
use yii\db\Migration;

class m210614_050656_menu extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%menu}}',
            [
                'id'=> $this->primaryKey(),
                'name'=> $this->string(128)->notNull(),
                'parent'=> $this->integer()->null()->defaultValue(null),
                'route'=> $this->string(255)->null()->defaultValue(null),
                'order'=> $this->integer()->null()->defaultValue(null),
                'data'=> $this->binary()->null()->defaultValue(null),
            ],$tableOptions
        );
        $this->createIndex('parent','{{%menu}}',['parent'],false);

    }

    public function safeDown()
    {
        $this->dropIndex('parent', '{{%menu}}');
        $this->dropTable('{{%menu}}');
    }
}
