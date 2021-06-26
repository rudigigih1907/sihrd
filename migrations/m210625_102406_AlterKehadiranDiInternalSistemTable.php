<?php

use yii\db\Migration;

/**
 * Class m210625_102406_AlterKehadiranDiInternalSistemTable
 */
class m210625_102406_AlterKehadiranDiInternalSistemTable extends Migration
{

    private $table = '{{%kehadiran_di_internal_sistem}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'tanggal', $this->date()->after('jam_kerja_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->table, 'tanggal');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210625_102406_AlterKehadiranDiInternalSistemTable cannot be reverted.\n";

        return false;
    }
    */
}
