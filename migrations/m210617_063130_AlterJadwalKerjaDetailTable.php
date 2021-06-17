<?php

use yii\db\Migration;

/**
 * Class m210617_063130_AlterJadwalKerjaDetailTable
 */
class m210617_063130_AlterJadwalKerjaDetailTable extends Migration
{

    private $table = '{{%jadwal_kerja_detail}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn($this->table,'jam_kerja_id', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn($this->table,'jam_kerja_id', $this->integer()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210617_063130_AlterJadwalKerjaDetailTable cannot be reverted.\n";

        return false;
    }
    */
}
