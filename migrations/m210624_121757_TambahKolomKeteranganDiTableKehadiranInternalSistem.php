<?php

use yii\db\Migration;

/**
 * Class m210624_121757_TambahKolomKeteranganDiTableKehadiranInternalSistem
 */
class m210624_121757_TambahKolomKeteranganDiTableKehadiranInternalSistem extends Migration {

    private $table = '{{%kehadiran_di_internal_sistem}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn($this->table, 'keterangan', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn($this->table, 'keterangan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210624_121757_TambahKolomKeteranganDiTableKehadiranInternalSistem cannot be reverted.\n";

        return false;
    }
    */
}
