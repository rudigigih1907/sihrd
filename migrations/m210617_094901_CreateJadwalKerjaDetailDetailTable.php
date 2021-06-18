<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jadwal_kerja_detail_detail}}`.
 */
class m210617_094901_CreateJadwalKerjaDetailDetailTable extends Migration
{

    private $table = '{{%jadwal_kerja_detail_detail}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%jadwal_kerja_detail_detail}}', [
            'id' => $this->primaryKey(),
            'jadwal_kerja_detail_id' => $this->integer(),
            'jam_kerja_id' => $this->integer()->notNull()
        ]);

        $this->createIndex('idx_jadwal_kerja_detail_detail_detail', $this->table, 'jadwal_kerja_detail_id');
        $this->createIndex('idx_jadwal_kerja_jam_kerja_detail_detail', $this->table, 'jam_kerja_id');

        $this->addForeignKey('fk_jadwal_kerja_detail_detail_detail', $this->table,
            'jadwal_kerja_detail_id',
            'jadwal_kerja_detail',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey('fk_jadwal_kerja_jam_kerja_detail_detail', $this->table,
            'jam_kerja_id',
            'jam_kerja',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey('fk_jadwal_kerja_jam_kerja_detail_detail', $this->table);
        $this->dropForeignKey('fk_jadwal_kerja_detail_detail_detail', $this->table);

        $this->dropIndex('idx_jadwal_kerja_jam_kerja_detail_detail', $this->table);
        $this->dropIndex('idx_jadwal_kerja_detail_detail_detail', $this->table);

        $this->dropTable('{{%jadwal_kerja_detail_detail}}');

    }
}
