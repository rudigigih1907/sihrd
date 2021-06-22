<?php

use yii\db\Schema;
use yii\db\Migration;

class m210622_064731_jadwal_kerja_hariDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->execute("set foreign_key_checks=0");
        $this->truncateTable('{{%jadwal_kerja_hari}}');
        $this->batchInsert('{{%jadwal_kerja_hari}}',
                           ["id", "nama", "asli", "default_libur", "weekday"],
                            [
    [
        'id' => '1',
        'nama' => 'Senin',
        'asli' => 'Ya',
        'default_libur' => 'Tidak',
        'weekday' => '0',
    ],
    [
        'id' => '2',
        'nama' => 'Selasa',
        'asli' => 'Ya',
        'default_libur' => 'Tidak',
        'weekday' => '1',
    ],
    [
        'id' => '3',
        'nama' => 'Rabu',
        'asli' => 'Ya',
        'default_libur' => 'Tidak',
        'weekday' => '2',
    ],
    [
        'id' => '4',
        'nama' => 'Kamis',
        'asli' => 'Ya',
        'default_libur' => 'Tidak',
        'weekday' => '3',
    ],
    [
        'id' => '5',
        'nama' => 'Jumat',
        'asli' => 'Ya',
        'default_libur' => 'Tidak',
        'weekday' => '4',
    ],
    [
        'id' => '6',
        'nama' => 'Sabtu',
        'asli' => 'Ya',
        'default_libur' => 'Ya',
        'weekday' => '5',
    ],
    [
        'id' => '7',
        'nama' => 'Minggu',
        'asli' => 'Ya',
        'default_libur' => 'Ya',
        'weekday' => '6',
    ],
    [
        'id' => '8',
        'nama' => 'Libur Umum',
        'asli' => 'Tidak',
        'default_libur' => 'Ya',
        'weekday' => '-1',
    ],
]
        );
        $this->execute("set foreign_key_checks=1");
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%jadwal_kerja_hari}} CASCADE');
    }
}
