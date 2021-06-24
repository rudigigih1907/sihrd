<?php

use yii\db\Migration;

/**
 * Class m210623_104250_AlterAbsensiIDToBigInteger
 */
class m210623_104250_AlterAbsensiIDToBigInteger extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->dropPrimaryKey('PRIMARY KEY', 'kehadiran_di_mesin_absensi');
        $this->alterColumn("kehadiran_di_mesin_absensi", 'id', $this->bigPrimaryKey());
        $this->dropPrimaryKey('PRIMARY KEY', 'kehadiran_di_internal_sistem');
        $this->alterColumn("kehadiran_di_internal_sistem", 'id', $this->bigPrimaryKey());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn("kehadiran_di_mesin_absensi", 'id', $this->integer());
        $this->alterColumn("kehadiran_di_internal_sistem", 'id', $this->integer());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210623_104250_AlterAbsensiIDToBigInteger cannot be reverted.\n";

        return false;
    }
    */
}
