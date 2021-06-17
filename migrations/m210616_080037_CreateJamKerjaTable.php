<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jam_kerja}}`.
 */
class m210616_080037_CreateJamKerjaTable extends Migration
{

    private $table = '{{%jam_kerja}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%jam_kerja}}', [
            'id' => $this->primaryKey(),
            'nama' => $this->string()->notNull()->unique(),
            'kode'=> $this->char(50)->notNull()->unique(),
            'jam_masuk' => $this->time()->comment('Masuk')->notNull(),
            'jam_mulai_istrahat' => $this->time()->comment("Ist. Keluar"),
            'jam_selesai_istrahat' => $this->time()->comment("Ist. Kembali"),
            'jam_pulang' => $this->time()->comment("Pulang")->notNull(),
            'durasi' => "ENUM('durasi_efektif', 'durasi_aktual') DEFAULT 'durasi_efektif'",
            'dihitung' => $this->integer()->defaultValue(1)->notNull()->comment("Satuan hari"),
            'toleransi_terlambat' => $this->integer()->defaultValue(0)->comment("Satuan Menit"),
            'created_at'=> $this->integer(11)->null()->defaultValue(null),
            'updated_at'=> $this->integer(11)->null()->defaultValue(null),
            'created_by'=> $this->string(10)->null()->defaultValue(null),
            'updated_by'=> $this->string(10)->null()->defaultValue(null),
        ]);

        $this->addCommentOnColumn($this->table,'durasi','Durasi Efektif adalah durasi kerja yang dihitung berdasarkan jam kerja pegawai, Durasi Aktual adalah durasi kerja yang dihitung berdasarkan scan kerja pegawai');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jam_kerja}}');
    }
}
