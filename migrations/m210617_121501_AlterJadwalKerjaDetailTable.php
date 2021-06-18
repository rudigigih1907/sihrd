<?php

use yii\db\Migration;

/**
 * Class m210617_121501_AlterJadwalKerjaDetailTable
 */
class m210617_121501_AlterJadwalKerjaDetailTable extends Migration
{

    private $table = '{{%jadwal_kerja_detail}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk_jadwal_kerja_detail', $this->table);
        $this->addForeignKey('fk_jadwal_kerja_detail', $this->table, 'jadwal_kerja_id', 'jadwal_kerja', 'id', "CASCADE", "CASCADE");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_jadwal_kerja_detail', $this->table);
        $this->addForeignKey('fk_jadwal_kerja_detail', $this->table, 'jadwal_kerja_id', 'jadwal_kerja', 'id', "CASCADE", "CASCADE");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210617_121501_AlterJadwalKerjaDetailTable cannot be reverted.\n";

        return false;
    }
    */
}
