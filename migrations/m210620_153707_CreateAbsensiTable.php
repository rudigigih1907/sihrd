<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kehadiran-di-mesin-absensi}}`.
 */
class m210620_153707_CreateAbsensiTable extends Migration {

    private $table = '{{%kehadiran-di-mesin-absensi}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {

        $this->createTable('{{%kehadiran-di-mesin-absensi}}', [
            'id' => $this->primaryKey(),
            'tanggal_scan' => $this->dateTime()->notNull(),
            'tanggal' => $this->date()->notNull(),
            'jam' => $this->time(),
            'pin' => $this->string(50),
            'nip' => $this->string(50),
            'nama' => $this->string(),
            'jabatan' => $this->string(50),
            'departemen' => $this->string(50),
            'kantor' => $this->string(50),
            'verifikasi' => $this->string(50),
            'io' => $this->string(50),
            'workcode' => $this->string(50),
            'sn' => $this->string(50),
            'mesin' => $this->string(50),
            'karyawan_id' => $this->integer()->notNull()
        ]);

        $this->createIndex("idx_absensi_karyawan", $this->table, 'karyawan_id');
        $this->addForeignKey("idx_absensi_karyawan", $this->table,
            'karyawan_id',
            'karyawan',
            'id',
            'CASCADE',
            'CASCADE'
        );

    }


    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey("idx_absensi_karyawan", $this->table);
        $this->dropIndex("idx_absensi_karyawan", $this->table);
        $this->dropTable('{{%kehadiran-di-mesin-absensi}}');
    }
}
