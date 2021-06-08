<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%card}}`.
 */
class m210602_035200_CreateCardTable extends Migration {

    private $table = '{{%card}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable($this->table, [

            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'code' => $this->char(50),
            'created_at' => $this->integer(11)->null()->defaultValue(null),
            'updated_at' => $this->integer(11)->null()->defaultValue(null),
            'created_by' => $this->string(10)->null()->defaultValue(null),
            'updated_by' => $this->string(10)->null()->defaultValue(null),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable($this->table);
    }
}
