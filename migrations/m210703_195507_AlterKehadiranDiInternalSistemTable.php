<?php

use yii\db\Migration;

/**
 * Class m210703_195507_AlterKehadiranDiInternalSistemTable
 */
class m210703_195507_AlterKehadiranDiInternalSistemTable extends Migration
{

    private $table = '{{%kehadiran_di_internal_sistem}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn($this->table,'jam_kerja_id', $this->integer()->null());
        $this->alterColumn($this->table,'ketentuan_masuk', $this->dateTime()->null());
        $this->alterColumn($this->table,'ketentuan_pulang', $this->dateTime()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn($this->table,'jam_kerja_id', $this->integer()->notNull());
        $this->alterColumn($this->table,'ketentuan_masuk', $this->dateTime()->notNull());
        $this->alterColumn($this->table,'ketentuan_pulang', $this->dateTime()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210703_195507_AlterKehadiranDiInternalSistemTable cannot be reverted.\n";

        return false;
    }
    */
}
