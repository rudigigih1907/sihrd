<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kehadiran_di_internal_sistem}}`.
 */
class m210623_034949_CreateKehadiranDiInternalSistemTable extends Migration {

    private $table = '{{%kehadiran_di_internal_sistem}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {

        $this->createTable('{{%kehadiran_di_internal_sistem}}', [
            'id' => $this->primaryKey(),
            'jadwal_kerja_id' => $this->integer()->notNull(), // Foreign Key
            'jadwal_kerja_hari_id' => $this->integer()->notNull(), // Foreign Key
            'jam_kerja_id' => $this->integer()->notNull(), // Foreign Key
            'ketentuan_masuk' => $this->dateTime()->notNull(),
            'ketentuan_pulang' => $this->dateTime()->notNull(),
            'karyawan_id' => $this->integer()->notNull(), // Foreign Key
            'aktual_masuk' => $this->dateTime(),
            'aktual_pulang' => $this->dateTime(),
        ]);

        $this->createIndex("idx_jadwal_kerja_di_kehadiran_internal_sistem", $this->table, 'jadwal_kerja_id');
        $this->createIndex("idx_jadwal_kerja_hari_di_kehadiran_internal_sistem", $this->table, 'jadwal_kerja_hari_id');
        $this->createIndex("idx_jam_kerja_di_kehadiran_internal_sistem", $this->table, 'jam_kerja_id');
        $this->createIndex("idx_karyawan_di_kehadiran_internal_sistem", $this->table, 'karyawan_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {

        $this->dropIndex("idx_jadwal_kerja_di_kehadiran_internal_sistem", $this->table);
        $this->dropIndex("idx_jadwal_kerja_hari_di_kehadiran_internal_sistem", $this->table);
        $this->dropIndex("idx_jam_kerja_di_kehadiran_internal_sistem", $this->table);
        $this->dropIndex("idx_karyawan_di_kehadiran_internal_sistem", $this->table);

        $this->dropTable('{{%kehadiran_di_internal_sistem}}');

    }
}
