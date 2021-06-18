<?php

use yii\db\Migration;

/**
 * Class m210617_105725_AlterJadwalKerjaDetailTable
 */
class m210617_105725_AlterJadwalKerjaDetailTable extends Migration
{

    private $table = '{{%jadwal_kerja_detail}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('fk_jam_kerja_jadwal_kerja_detail', $this->table);
        $this->dropIndex('idx_jam_kerja_jadwal_kerja_detail', $this->table);
        $this->dropColumn($this->table,'jam_kerja_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn($this->table,'jam_kerja_id', $this->integer()->notNull());
        $this->createIndex('idx_jam_kerja_jadwal_kerja_detail', $this->table, 'jam_kerja_id');
        $this->addForeignKey('fk_jam_kerja_jadwal_kerja_detail', $this->table, 'jam_kerja_id', 'jam_kerja', 'id','RESTRICT', 'CASCADE');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210617_105725_AlterJadwalKerjaDetailTable cannot be reverted.\n";

        return false;
    }
    */
}
