<?php

use yii\db\Schema;
use yii\db\Migration;

class m210623_081319_jenis_izinDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->execute("set foreign_key_checks=0");
        $this->truncateTable('{{%jenis_izin}}');
        $this->batchInsert('{{%jenis_izin}}',
                           ["id", "kategori_izin_id", "nama"],
                            [
    [
        'id' => '1',
        'kategori_izin_id' => '1',
        'nama' => 'Kebanjiran',
    ],
    [
        'id' => '2',
        'kategori_izin_id' => '2',
        'nama' => 'Mengurus NPWP',
    ],
    [
        'id' => '3',
        'kategori_izin_id' => '3',
        'nama' => 'Sepeda Motor Mogok',
    ],
    [
        'id' => '4',
        'kategori_izin_id' => '4',
        'nama' => 'Sakit Rawat Jalan',
    ],
    [
        'id' => '5',
        'kategori_izin_id' => '5',
        'nama' => 'Disetujui Atasan',
    ],
    [
        'id' => '6',
        'kategori_izin_id' => '1',
        'nama' => 'Mengurus Sekolah Anak',
    ],
    [
        'id' => '7',
        'kategori_izin_id' => '1',
        'nama' => 'Istri Sakit',
    ],
    [
        'id' => '8',
        'kategori_izin_id' => '2',
        'nama' => 'Ada Kerabat / Keluarga yang meninggal',
    ],
    [
        'id' => '9',
        'kategori_izin_id' => '3',
        'nama' => 'Disuruh Direksi',
    ],
    [
        'id' => '16',
        'kategori_izin_id' => '9',
        'nama' => 'Approval MD untuk tidak masuk',
    ],
    [
        'id' => '17',
        'kategori_izin_id' => '10',
        'nama' => 'Approval MD untuk tidak masuk',
    ],
    [
        'id' => '18',
        'kategori_izin_id' => '10',
        'nama' => 'Mengikuti Jadwal Keberangkatan Pesawat',
    ],
    [
        'id' => '19',
        'kategori_izin_id' => '11',
        'nama' => 'Terlambat Kemarin Lembur',
    ],
    [
        'id' => '20',
        'kategori_izin_id' => '11',
        'nama' => 'Approval Direksi',
    ],
]
        );
        $this->execute("set foreign_key_checks=0");
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%jenis_izin}} CASCADE');
    }
}
