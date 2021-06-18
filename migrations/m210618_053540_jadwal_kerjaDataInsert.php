<?php

use yii\db\Schema;
use yii\db\Migration;

class m210618_053540_jadwal_kerjaDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->execute("set foreign_key_checks=0");
        $this->truncateTable('{{%jadwal_kerja}}');
        $this->batchInsert('{{%jadwal_kerja}}',
                           ["id", "nama", "kode", "keterangan", "mulai_tanggal", "status", "created_at", "updated_at", "created_by", "updated_by"],
                            [
    [
        'id' => '29',
        'nama' => 'PT. Pelayaran Tresnamuda Sejati',
        'kode' => 'TMS',
        'keterangan' => '',
        'mulai_tanggal' => '2021-06-17',
        'status' => 'Aktif',
        'created_at' => '1623946473',
        'updated_at' => '1623946473',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '32',
        'nama' => 'PT. Jameson Freight Semesta',
        'kode' => 'JFS',
        'keterangan' => 'Clone',
        'mulai_tanggal' => '2021-06-17',
        'status' => 'Aktif',
        'created_at' => '1623990945',
        'updated_at' => '1623991260',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '33',
        'nama' => 'PT. Nicholas Anwar Konsultan',
        'kode' => 'NAK',
        'keterangan' => 'Clone',
        'mulai_tanggal' => '2021-06-17',
        'status' => 'Aktif',
        'created_at' => '1623991023',
        'updated_at' => '1623991269',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '34',
        'nama' => 'PT. Samudera Daka Lines',
        'kode' => 'SDL',
        'keterangan' => 'Clone',
        'mulai_tanggal' => '2021-06-17',
        'status' => 'Aktif',
        'created_at' => '1623991052',
        'updated_at' => '1623991279',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '35',
        'nama' => 'PT. Tresna Portal Agencies',
        'kode' => 'TPA',
        'keterangan' => 'Clone',
        'mulai_tanggal' => '2021-06-17',
        'status' => 'Aktif',
        'created_at' => '1623991069',
        'updated_at' => '1623991289',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '36',
        'nama' => 'PT. Tsurumaru Logistics Indonesia - Kantor',
        'kode' => 'TLIKANTOR',
        'keterangan' => 'Clone',
        'mulai_tanggal' => '2021-06-17',
        'status' => 'Aktif',
        'created_at' => '1623991116',
        'updated_at' => '1623991298',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '37',
        'nama' => 'PT. Tsurumaru Logistics Indonesia - Gudang',
        'kode' => 'TLIGUDANG',
        'keterangan' => 'Clone',
        'mulai_tanggal' => '2021-06-17',
        'status' => 'Aktif',
        'created_at' => '1623991183',
        'updated_at' => '1623991308',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '38',
        'nama' => 'PT. Indoformosa Trading - Kantor',
        'kode' => 'IFTKANTOR',
        'keterangan' => 'Clone',
        'mulai_tanggal' => '2021-06-17',
        'status' => 'Aktif',
        'created_at' => '1623991375',
        'updated_at' => '1623991375',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '39',
        'nama' => 'PT. Indoformosa Trading - Gudang Shift 1',
        'kode' => 'IFTGUDANGSHIFT1',
        'keterangan' => 'Clone',
        'mulai_tanggal' => '2021-06-17',
        'status' => 'Aktif',
        'created_at' => '1623991472',
        'updated_at' => '1623991472',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '40',
        'nama' => 'PT. Indoformosa Trading - Gudang Shift 2',
        'kode' => 'IFTGUDANGSHIFT2',
        'keterangan' => 'Clone',
        'mulai_tanggal' => '2021-06-17',
        'status' => 'Aktif',
        'created_at' => '1623991505',
        'updated_at' => '1623991505',
        'created_by' => '1',
        'updated_by' => '1',
    ],
]
        );

        $this->execute("set foreign_key_checks=1");
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%jadwal_kerja}} CASCADE');
    }
}
