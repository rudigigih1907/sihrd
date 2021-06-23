<?php

use yii\db\Schema;
use yii\db\Migration;

class m210623_081306_kategori_izinDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->execute("set foreign_key_checks=0");
        $this->truncateTable('{{%kategori_izin}}');
        $this->batchInsert('{{%kategori_izin}}',
                           ["id", "nama"],
                            [
    [
        'id' => '1',
        'nama' => 'Izin tidak masuk (Keperluan pribadi)',
    ],
    [
        'id' => '2',
        'nama' => 'Izin pulang awal (Keperluan pribadi)',
    ],
    [
        'id' => '3',
        'nama' => 'Izin datang terlambat (Keperluan pribadi)',
    ],
    [
        'id' => '4',
        'nama' => 'Sakit dengan surat dokter',
    ],
    [
        'id' => '5',
        'nama' => 'Sakit tanpa surat dokter',
    ],
    [
        'id' => '9',
        'nama' => 'Izin tidak masuk (Keperluan kantor)',
    ],
    [
        'id' => '10',
        'nama' => 'Izin pulang awal (Keperluan kantor)',
    ],
    [
        'id' => '11',
        'nama' => 'Izin datang terlambat (Keperluan kantor)',
    ],
]
        );
        $this->execute("set foreign_key_checks=1");
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%kategori_izin}} CASCADE');
    }
}
