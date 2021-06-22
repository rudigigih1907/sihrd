<?php

use yii\db\Schema;
use yii\db\Migration;

class m210622_055136_liburDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%libur}}',
                           ["id", "tanggal", "keterangan", "status", "created_at", "updated_at", "created_by", "updated_by"],
                            [
    [
        'id' => '1',
        'tanggal' => '2021-01-01',
        'keterangan' => 'Tahun Baru Masehi',
        'status' => 'Hari Libur',
        'created_at' => '1624339469',
        'updated_at' => '1624339469',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '2',
        'tanggal' => '2021-02-12',
        'keterangan' => 'Tahun Baru Imlek',
        'status' => 'Hari Libur',
        'created_at' => '1624339524',
        'updated_at' => '1624339524',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '3',
        'tanggal' => '2021-03-11',
        'keterangan' => 'Isra Mi\'raj',
        'status' => 'Hari Libur',
        'created_at' => '1624339643',
        'updated_at' => '1624339643',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '4',
        'tanggal' => '2021-03-14',
        'keterangan' => 'Hari Suci Nyepi',
        'status' => 'Hari Libur',
        'created_at' => '1624339685',
        'updated_at' => '1624339685',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '5',
        'tanggal' => '2021-04-02',
        'keterangan' => 'Jumat Agung',
        'status' => 'Hari Libur',
        'created_at' => '1624339729',
        'updated_at' => '1624339729',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '6',
        'tanggal' => '2021-05-01',
        'keterangan' => 'Hari Buruh',
        'status' => 'Hari Libur',
        'created_at' => '1624339746',
        'updated_at' => '1624339746',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '7',
        'tanggal' => '2021-05-12',
        'keterangan' => 'Cuti Bersama Lebaran',
        'status' => 'Cuti Bersama',
        'created_at' => '1624339771',
        'updated_at' => '1624339856',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '8',
        'tanggal' => '2021-05-13',
        'keterangan' => 'Kenaikan Isa Almasih',
        'status' => 'Hari Libur',
        'created_at' => '1624339804',
        'updated_at' => '1624339804',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '9',
        'tanggal' => '2021-05-13',
        'keterangan' => 'Hari Raya Idul Fitri',
        'status' => 'Hari Libur',
        'created_at' => '1624339850',
        'updated_at' => '1624339850',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '10',
        'tanggal' => '2021-05-14',
        'keterangan' => 'Hari Raya Idul Fitri',
        'status' => 'Hari Libur',
        'created_at' => '1624339889',
        'updated_at' => '1624339889',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '11',
        'tanggal' => '2021-05-26',
        'keterangan' => 'Hari Waisak',
        'status' => 'Hari Libur',
        'created_at' => '1624339927',
        'updated_at' => '1624339927',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '12',
        'tanggal' => '2021-06-01',
        'keterangan' => 'Hari Lahir Pancasila',
        'status' => 'Hari Libur',
        'created_at' => '1624339946',
        'updated_at' => '1624339946',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '13',
        'tanggal' => '2021-07-20',
        'keterangan' => 'Hari Raya Idul Adha 1442 Hijriah',
        'status' => 'Hari Libur',
        'created_at' => '1624340052',
        'updated_at' => '1624340181',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '14',
        'tanggal' => '2021-08-10',
        'keterangan' => 'Tahun Baru Islam 1443 Hijriah',
        'status' => 'Hari Libur',
        'created_at' => '1624340224',
        'updated_at' => '1624340224',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '15',
        'tanggal' => '2021-08-17',
        'keterangan' => 'Hari Kemerdekaan Republik Indonesia',
        'status' => 'Hari Libur',
        'created_at' => '1624340283',
        'updated_at' => '1624340283',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '16',
        'tanggal' => '2021-10-19',
        'keterangan' => 'Maulid Nabi Muhammad SAW',
        'status' => 'Hari Libur',
        'created_at' => '1624340319',
        'updated_at' => '1624340319',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '17',
        'tanggal' => '2021-12-24',
        'keterangan' => 'Cutu Bersama Hari Raya Natal',
        'status' => 'Cuti Bersama',
        'created_at' => '1624340353',
        'updated_at' => '1624340442',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '18',
        'tanggal' => '2021-12-25',
        'keterangan' => 'Hari Raya Natal',
        'status' => 'Hari Libur',
        'created_at' => '1624340377',
        'updated_at' => '1624340377',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '19',
        'tanggal' => '2021-12-27',
        'keterangan' => 'Cuti Bersama Hari Natal',
        'status' => 'Cuti Bersama',
        'created_at' => '1624340425',
        'updated_at' => '1624340425',
        'created_by' => '1',
        'updated_by' => '1',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%libur}} CASCADE');
    }
}
