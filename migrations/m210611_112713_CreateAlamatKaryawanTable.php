<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%alamat_karyawan}}`.
 */
class m210611_112713_CreateAlamatKaryawanTable extends Migration {

    private $table = '{{%alamat_karyawan}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%alamat_karyawan}}', [
            'id' => $this->primaryKey(),
            'karyawan_id' => $this->integer(),
            'type' => 'ENUM("Sesuai KTP", "Domisili Sekarang", "Pelaporan Pajak", "Kerabat Yang Bisa Dihubungi", "Lainnya") NOT NULL',
            'atas_nama' => $this->string()->notNull(),
            'jalan' => $this->text()->notNull(),
            'block' => $this->string(),
            'nomor' => $this->string(),
            'rt' => $this->char(50),
            'rw' => $this->char(50),
            'kecamatan' => $this->string(),
            'kelurahan' => $this->string(),
            'kabupaten' => $this->string(),
            'propinsi' => $this->string(),
            'kode_pos' => $this->string(),
            'nomor_telepon' => $this->string(),
            'email' => $this->string(),
            'keterangan' => $this->text()
        ]);

        $this->createIndex('idx_alamat_karyawan', $this->table, 'karyawan_id');
        $this->addForeignKey('fk_alamat_karyawan', $this->table, 'karyawan_id',
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

        $this->dropForeignKey('fk_alamat_karyawan', $this->table);
        $this->dropIndex('idx_alamat_karyawan', $this->table);
        $this->dropTable('{{%alamat_karyawan}}');
    }
}
