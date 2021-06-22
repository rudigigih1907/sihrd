<?php

use yii\db\Migration;

/**
 * Class m210622_063129_AlterJadwalKerjaHariTable
 */
class m210622_063129_AlterJadwalKerjaHariTable extends Migration
{
    private $table = '{{%jadwal_kerja_hari}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'weekday', $this->smallInteger()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->table, 'weekday');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210622_063129_AlterJadwalKerjaHariTable cannot be reverted.\n";

        return false;
    }
    */
}
