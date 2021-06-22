<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%libur}}`.
 */
class m210622_043615_CreateLiburTable extends Migration {

    private $table = '{{%libur}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%libur}}', [
            'id' => $this->primaryKey(),
            'tanggal' => $this->date()->notNull(),
            'keterangan' => $this->text()->notNull(),
            'status' => "ENUM('Hari Libur', 'Cuti Bersama') DEFAULT 'Hari Libur' NOT NULL",
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
        $this->dropTable('{{%libur}}');
    }
}
