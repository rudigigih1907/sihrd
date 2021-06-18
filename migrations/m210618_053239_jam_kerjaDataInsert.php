<?php

use yii\db\Schema;
use yii\db\Migration;

class m210618_053239_jam_kerjaDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->execute("set foreign_key_checks=0");
        $this->truncateTable('{{%jam_kerja}}');
        $this->batchInsert('{{%jam_kerja}}',
                           ["id", "nama", "kode", "jam_masuk", "jam_mulai_istrahat", "jam_selesai_istrahat", "jam_pulang", "durasi", "dihitung", "toleransi_terlambat", "created_at", "updated_at", "created_by", "updated_by"],
                            [
    [
        'id' => '3',
        'nama' => 'Jam Kerja Office',
        'kode' => 'Office',
        'jam_masuk' => '08:00:00',
        'jam_mulai_istrahat' => null,
        'jam_selesai_istrahat' => null,
        'jam_pulang' => '17:00:00',
        'durasi' => 'durasi_efektif',
        'dihitung' => '1',
        'toleransi_terlambat' => '5',
        'created_at' => '1623848498',
        'updated_at' => '1623915843',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '15',
        'nama' => 'Jam Kerja TLI Gudang',
        'kode' => 'TLIGUDANG',
        'jam_masuk' => '08:30:00',
        'jam_mulai_istrahat' => null,
        'jam_selesai_istrahat' => null,
        'jam_pulang' => '17:00:00',
        'durasi' => 'durasi_efektif',
        'dihitung' => '1',
        'toleransi_terlambat' => '5',
        'created_at' => '1623913185',
        'updated_at' => '1623914974',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '16',
        'nama' => 'Jam Kerja TLI Gudang Sabtu',
        'kode' => 'TLIGUDANGSABTU',
        'jam_masuk' => '08:30:00',
        'jam_mulai_istrahat' => null,
        'jam_selesai_istrahat' => null,
        'jam_pulang' => '12:00:00',
        'durasi' => 'durasi_efektif',
        'dihitung' => '1',
        'toleransi_terlambat' => '5',
        'created_at' => '1623913241',
        'updated_at' => '1623914943',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '17',
        'nama' => 'Jam Kerja IFT Gudang Shift 1',
        'kode' => 'IFTGUDANGSHIFT1',
        'jam_masuk' => '07:00:00',
        'jam_mulai_istrahat' => null,
        'jam_selesai_istrahat' => null,
        'jam_pulang' => '15:00:00',
        'durasi' => 'durasi_efektif',
        'dihitung' => '1',
        'toleransi_terlambat' => '5',
        'created_at' => '1623915568',
        'updated_at' => '1623915568',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '18',
        'nama' => 'Jam Kerja IFT Gudang Shift 2',
        'kode' => 'IFTGUDANGSHIFT2',
        'jam_masuk' => '09:00:00',
        'jam_mulai_istrahat' => null,
        'jam_selesai_istrahat' => null,
        'jam_pulang' => '17:00:00',
        'durasi' => 'durasi_efektif',
        'dihitung' => '1',
        'toleransi_terlambat' => '5',
        'created_at' => '1623915833',
        'updated_at' => '1623915833',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '19',
        'nama' => 'Jam Kerja IFT Gudang Sabtu',
        'kode' => 'IFTGUDANGSABTU',
        'jam_masuk' => '09:00:00',
        'jam_mulai_istrahat' => null,
        'jam_selesai_istrahat' => null,
        'jam_pulang' => '12:00:00',
        'durasi' => 'durasi_efektif',
        'dihitung' => '1',
        'toleransi_terlambat' => '5',
        'created_at' => '1623915903',
        'updated_at' => '1623921541',
        'created_by' => '1',
        'updated_by' => '1',
    ],
]
        );

        $this->execute("set foreign_key_checks=1");
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%jam_kerja}} CASCADE');
    }
}
