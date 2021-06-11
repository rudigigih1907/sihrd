<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%karyawan}}`.
 */
class m210610_090727_CreateKaryawanTable extends Migration {

    private $table = '{{%karyawan}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%karyawan}}', [

            'id' => $this->primaryKey(),
            'nomor_induk_karyawan' => $this->string()->comment("NIK / NIP"),
            'nama' => $this->string()->notNull(),
            'nama_panggilan' => $this->string(),
            'tempat_lahir' => $this->string(),
            'tanggal_lahir' => $this->date(),

            'status_kewarganegaraan' => "ENUM('WNI', 'WNA') DEFAULT 'WNI'",
            'nomor_kartu_tanda_penduduk' => $this->string()->comment("Nomor KTP"),
            'nomor_kartu_keluarga' => $this->string()->comment("Nomor KK"),

            'nomor_pokok_wajib_pajak' => $this->string()->comment("Nomor NPWP"),
            'nomor_kitas_atau_sejenisnya' => $this->string()->comment("Khusus WNA"),

            'jenis_kelamin' => "ENUM('Laki - Laki', 'Perempuan') NOT NULL",
            'agama_id' => $this->integer()->notNull(),
            'status_perkawinan_id' => $this->integer()->notNull(),
            'nama_ayah' => $this->string(),
            'nama_ibu' => $this->string(),

            'pendidikan_terakhir' => "ENUM('SD', 'SMP', 'SMA', 'S1', 'S2', 'S3') NOT NULL",
            'tanggal_mulai_bekerja' => $this->date(),
            'tanggal_berhenti_bekerja' => $this->date(),
            'alasan_berhenti_bekerja' => $this->integer(),

            'created_at'=> $this->integer(11)->null()->defaultValue(null),
            'updated_at'=> $this->integer(11)->null()->defaultValue(null),
            'created_by'=> $this->string(10)->null()->defaultValue(null),
            'updated_by'=> $this->string(10)->null()->defaultValue(null),
        ]);

        $this->createIndex('idx_agama_karyawan' , $this->table, 'agama_id');
        $this->createIndex('idx_status_perkawinan_karyawan' , $this->table, 'status_perkawinan_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('{{%karyawan}}');
    }
}
