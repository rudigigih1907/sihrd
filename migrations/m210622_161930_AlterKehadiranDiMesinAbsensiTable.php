<?php

use yii\db\Migration;

/**
 * Class m210622_161930_AlterKehadiranDiMesinAbsensiTable
 */
class m210622_161930_AlterKehadiranDiMesinAbsensiTable extends Migration
{

    private $table = "{{kehadiran_di_mesin_absensi}}";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn($this->table, 'file', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn($this->table, 'file', $this->string()->null());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210622_161930_AlterKehadiranDiMesinAbsensiTable cannot be reverted.\n";

        return false;
    }
    */
}
