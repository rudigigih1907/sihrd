<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cuti_normatif}}`.
 */
class m210625_080109_CreateCutiNormatifTable extends Migration
{

    private $table = '{{%cuti_normatif}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cuti_normatif}}', [
            'id' => $this->primaryKey(),
            'nama' => $this->string()->notNull(),
            'lama' => $this->integer()->notNull()->comment('Dalam Satuan Hari'),
            'dibayar' => "ENUM('Ya', 'Tidak') DEFAULT 'Ya'",
            'created_at' => $this->integer(11)->null()->defaultValue(null),
            'updated_at' => $this->integer(11)->null()->defaultValue(null),
            'created_by' => $this->string(10)->null()->defaultValue(null),
            'updated_by' => $this->string(10)->null()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cuti_normatif}}');
    }
}
