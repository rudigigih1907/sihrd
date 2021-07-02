<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%form_perubahan_data_karyawan}}`.
 */
class m210701_111022_CreateFormPerubahanDataKaryawanTable extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {

        $this->createTable('{{%form_perubahan_data_karyawan}}', [
            'id' => $this->primaryKey(),
            'judul' => $this->string()->notNull(),
            'deskripsi_umum' => $this->text()->notNull(),
            'status' => "ENUM('PENDING', 'SEDANG DIKERJAKAN', 'SELESAI') DEFAULT 'PENDING'",
            'aksi_yang_dilakukan' => $this->text(),
            'created_at' => $this->integer(11)->null()->defaultValue(null),
            'updated_at' => $this->integer(11)->null()->defaultValue(null),
            'created_by' => $this->string(10)->null()->defaultValue(null),
            'updated_by' => $this->string(10)->null()->defaultValue(null),
        ]);

        $this->createTable('{{%form_perubahan_data_karyawan_detail}}', [
            'id' => $this->primaryKey(),
            'form_perubahan_data_karyawan_id' => $this->integer(),
            'nama_data' => $this->string()->notNull(),
            'nilai_lama' => $this->string()->notNull(),
            'nilai_baru' => $this->string()->notNull(),
            'aksi' => "ENUM('Tambah', 'Perbarui', 'Hapus') DEFAULT NULL",
            'keterangan' => $this->text(),
        ]);

        $this->createIndex("idx_form_perubahan_detail",
            "{{%form_perubahan_data_karyawan_detail}}",
            "form_perubahan_data_karyawan_id"
        );

        $this->addForeignKey(
            "fk_form_perubahan_detail",
            "{{%form_perubahan_data_karyawan_detail}}",
            "form_perubahan_data_karyawan_id",
            '{{%form_perubahan_data_karyawan}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropForeignKey("fk_form_perubahan_detail", "{{%form_perubahan_data_karyawan_detail}}");
        $this->dropIndex("idx_form_perubahan_detail", "{{%form_perubahan_data_karyawan_detail}}");
        $this->dropTable('{{%form_perubahan_data_karyawan_detail}}');
        $this->dropTable('{{%form_perubahan_data_karyawan}}');
    }
}
