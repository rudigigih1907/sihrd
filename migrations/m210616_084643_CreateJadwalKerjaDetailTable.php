<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jadwal_kerja_detail}}`.
 */
class m210616_084643_CreateJadwalKerjaDetailTable extends Migration {

    private $table = '{{%jadwal_kerja_detail}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%jadwal_kerja_hari}}', [
            'id' => $this->primaryKey(),
            'nama' => $this->string()->notNull(),
            'asli' => "ENUM('Ya', 'Tidak')",
            'default_libur' => "ENUM('Ya', 'Tidak')",
        ]);

        $this->batchInsert('{{%jadwal_kerja_hari}}', ['nama', 'asli', 'default_libur'], [
            ['Senin', 'Ya', 'Tidak'],
            ['Selasa', 'Ya', 'Tidak'],
            ['Rabu', 'Ya', 'Tidak'],
            ['Kamis', 'Ya', 'Tidak'],
            ['Jumat', 'Ya', 'Tidak'],
            ['Sabtu', 'Ya', 'Tidak'],
            ['Minggu', 'Ya', 'Ya'],
            ['Libur Umum', 'Tidak', 'Ya'],
        ]);

        $this->createTable('{{%jadwal_kerja_detail}}', [
            'id' => $this->primaryKey(),
            'jadwal_kerja_id' => $this->integer(),
            'jadwal_kerja_hari_id' => $this->integer()->notNull(),
            'libur' => "ENUM('Ya', 'Tidak')",
            'jam_kerja_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx_jadwal_kerja_detail', $this->table, 'jadwal_kerja_id');
        $this->createIndex('idx_jadwal_kerja_hari_jadwal_kerja_detail', $this->table, 'jadwal_kerja_hari_id');
        $this->createIndex('idx_jam_kerja_jadwal_kerja_detail', $this->table, 'jam_kerja_id');


        $this->addForeignKey('fk_jadwal_kerja_detail', $this->table, 'jadwal_kerja_id', 'jadwal_kerja', 'id', "CASCADE", "RESTRICT");
        $this->addForeignKey('fk_jadwal_kerja_hari_jadwal_kerja_detail', $this->table, 'jadwal_kerja_hari_id','jadwal_kerja_hari', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_jam_kerja_jadwal_kerja_detail', $this->table, 'jam_kerja_id', 'jam_kerja', 'id','RESTRICT', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {

        $this->dropForeignKey('fk_jadwal_kerja_detail', $this->table);
        $this->dropForeignKey('fk_jadwal_kerja_hari_jadwal_kerja_detail', $this->table);
        $this->dropForeignKey('fk_jam_kerja_jadwal_kerja_detail', $this->table);


        $this->dropIndex('idx_jadwal_kerja_detail', $this->table);
        $this->dropIndex('idx_jadwal_kerja_hari_jadwal_kerja_detail', $this->table);
        $this->dropIndex('idx_jam_kerja_jadwal_kerja_detail', $this->table);
        $this->dropTable('{{%jadwal_kerja_detail}}');

        $this->dropTable('{{%jadwal_kerja_hari}}');
    }
}
