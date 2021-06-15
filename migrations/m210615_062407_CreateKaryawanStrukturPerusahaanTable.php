<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%karyawan_struktur_organisasi}}`.
 */
class m210615_062407_CreateKaryawanStrukturPerusahaanTable extends Migration
{

    private $table = '{{%karyawan_struktur_organisasi}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%karyawan_struktur_organisasi}}', [
            'id' => $this->primaryKey(),
            'karyawan_id' => $this->integer()->notNull(),
            'struktur_organisasi_id' => $this->integer()->notNull(),
            'nomor_surat_pengangkatan' => $this->string()->notNull(),
            'tanggal_aktif' => $this->date()->notNull(),
            'tanggal_berakhir' => $this->date(),
            'alasan_berakhir' => $this->string()
        ]);

        $this->createIndex("idx_karyawan",$this->table, 'karyawan_id');
        $this->createIndex("idx_struktur_organisasi",$this->table, 'struktur_organisasi_id');

        $this->addForeignKey("fk_karyawan",$this->table, 'karyawan_id', 'karyawan', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey("fk_struktur_organisasi",$this->table, 'struktur_organisasi_id', 'struktur_organisasi', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey("fk_karyawan",$this->table);
        $this->dropForeignKey("fk_struktur_organisasi",$this->table);

        $this->dropIndex("idx_karyawan",$this->table);
        $this->dropIndex("idx_struktur_organisasi",$this->table);


        $this->dropTable('{{%karyawan_struktur_organisasi}}');
    }
}
