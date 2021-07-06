<?php

use yii\db\Migration;

/**
 * Class m210705_131026_AlterKehadiranDiInternalSistemTable
 */
class m210705_131026_AlterKehadiranDiInternalSistemTable extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn('kehadiran_di_internal_sistem', 'aturan_uang_kehadiran_id',
            $this->integer()->notNull());

        $this->createIndex('aturan_uang_kehadiran_di_internal_sistem', 'kehadiran_di_internal_sistem', 'aturan_uang_kehadiran_id');
        $this->addForeignKey('aturan_uang_kehadiran_di_internal_sistem', 'kehadiran_di_internal_sistem',
            'aturan_uang_kehadiran_id',
            'aturan_uang_kehadiran',
            'id',
            'RESTRICT',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn('kehadiran_di_internal_sistem', 'aturan_uang_kehadiran_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210705_131026_AlterKehadiranDiInternalSistemTable cannot be reverted.\n";

        return false;
    }
    */
}
