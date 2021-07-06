<?php

use yii\db\Migration;

/**
 * Class m210706_064542_AlterKehadiranDiInternalSistemTable
 */
class m210706_064542_AlterKehadiranDiInternalSistemTable extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->alterColumn('kehadiran_di_internal_sistem', 'aturan_uang_kehadiran_id', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->alterColumn('kehadiran_di_internal_sistem', 'aturan_uang_kehadiran_id', $this->integer()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210706_064542_AlterKehadiranDiInternalSistemTable cannot be reverted.\n";

        return false;
    }
    */
}
