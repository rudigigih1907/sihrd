<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%karyawan_ptkp}}`.
 */
class m210622_065229_CreateKaryawanPtkpTable extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {

        $this->createTable('hubungan_ptkp', [
            'id' => $this->primaryKey(),
            'nama' => $this->string()->notNull(),
            'kode' => $this->char(50)->notNull()->unique()
        ]);

        $this->batchInsert('hubungan_ptkp', ['nama', 'kode'], [
            ['Istri', 'Istri'],
            ['Anak', 'Anak'],
            ['Ibu', 'Ibu'],
            ['Bapak', 'Bapak'],
            ['Lain-Lain', 'Lain-Lain'],
        ]);

        $this->createTable('batal_ptkp', [
            'id' => $this->primaryKey(),
            'nama' => $this->string()->notNull(),
            'kode' => $this->char(50)->notNull()->unique()
        ]);

        $this->batchInsert('batal_ptkp', ['nama', 'kode'], [
            ['Istri (Jika karyawan adalah laki-laki)', 'T1'],
            ['Meninggal', 'T2'],
            ['> 20 Tahun', 'T3'],
            ['Bekerja', 'T4'],
            ['Kawin', 'T5'],
        ]);


        $this->createTable('{{%karyawan_ptkp}}', [
            'id' => $this->primaryKey(),
            'karyawan_id' => $this->integer()->notNull(),  // foreign key
            'hubungan_ptkp_id' => $this->integer()->notNull(), // foreign key
            'nama_tanggungan' => $this->string()->notNull(),
            'tempat_lahir' => $this->string()->notNull(),
            'tanggal_lahir' => $this->date()->notNull(),
            'terhitung_sebagai_ptkp' => "ENUM('Ya','Tidak') DEFAULT 'Ya' NOT NULL",
            'batal_ptkp_id' => $this->integer()->notNull()->comment('Alasan Tidak Terhitung')// foreign key
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('hubungan_ptkp');
        $this->dropTable('batal_ptkp');
        $this->dropTable('{{%karyawan_ptkp}}');
    }
}
