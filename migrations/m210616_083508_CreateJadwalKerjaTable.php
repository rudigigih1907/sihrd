<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jadwal_kerja}}`.
 */
class m210616_083508_CreateJadwalKerjaTable extends Migration {

    private $table = '{{%jadwal_kerja}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('{{%jadwal_kerja}}', [
            'id' => $this->primaryKey(),
            'nama' => $this->string()->notNull()->unique(),
            'kode' => $this->string()->notNull()->unique(),
            'keterangan' => $this->text(),
            'mulai_tanggal' => $this->date()->notNull(),
            'status' => "ENUM('Aktif','Tidak Aktif') DEFAULT 'Aktif' NOT NULL",
            'created_at'=> $this->integer(11)->null()->defaultValue(null),
            'updated_at'=> $this->integer(11)->null()->defaultValue(null),
            'created_by'=> $this->string(10)->null()->defaultValue(null),
            'updated_by'=> $this->string(10)->null()->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('{{%jadwal_kerja}}');
    }
}
