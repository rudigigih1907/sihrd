<?php

use yii\db\Schema;
use yii\db\Migration;

class m210618_053656_jadwal_kerja_detailDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->execute("set foreign_key_checks=0");
        $this->truncateTable('{{%jadwal_kerja_detail}}');
        $this->batchInsert('{{%jadwal_kerja_detail}}',
                           ["id", "jadwal_kerja_id", "jadwal_kerja_hari_id", "libur"],
                            [
    [
        'id' => '153',
        'jadwal_kerja_id' => '29',
        'jadwal_kerja_hari_id' => '1',
        'libur' => 'Tidak',
    ],
    [
        'id' => '154',
        'jadwal_kerja_id' => '29',
        'jadwal_kerja_hari_id' => '2',
        'libur' => 'Tidak',
    ],
    [
        'id' => '155',
        'jadwal_kerja_id' => '29',
        'jadwal_kerja_hari_id' => '3',
        'libur' => 'Tidak',
    ],
    [
        'id' => '156',
        'jadwal_kerja_id' => '29',
        'jadwal_kerja_hari_id' => '4',
        'libur' => 'Tidak',
    ],
    [
        'id' => '157',
        'jadwal_kerja_id' => '29',
        'jadwal_kerja_hari_id' => '5',
        'libur' => 'Tidak',
    ],
    [
        'id' => '161',
        'jadwal_kerja_id' => '29',
        'jadwal_kerja_hari_id' => '6',
        'libur' => 'Ya',
    ],
    [
        'id' => '162',
        'jadwal_kerja_id' => '29',
        'jadwal_kerja_hari_id' => '7',
        'libur' => 'Ya',
    ],
    [
        'id' => '163',
        'jadwal_kerja_id' => '29',
        'jadwal_kerja_hari_id' => '8',
        'libur' => 'Ya',
    ],
    [
        'id' => '180',
        'jadwal_kerja_id' => '32',
        'jadwal_kerja_hari_id' => '1',
        'libur' => 'Tidak',
    ],
    [
        'id' => '181',
        'jadwal_kerja_id' => '32',
        'jadwal_kerja_hari_id' => '2',
        'libur' => 'Tidak',
    ],
    [
        'id' => '182',
        'jadwal_kerja_id' => '32',
        'jadwal_kerja_hari_id' => '3',
        'libur' => 'Tidak',
    ],
    [
        'id' => '183',
        'jadwal_kerja_id' => '32',
        'jadwal_kerja_hari_id' => '4',
        'libur' => 'Tidak',
    ],
    [
        'id' => '184',
        'jadwal_kerja_id' => '32',
        'jadwal_kerja_hari_id' => '5',
        'libur' => 'Tidak',
    ],
    [
        'id' => '185',
        'jadwal_kerja_id' => '32',
        'jadwal_kerja_hari_id' => '6',
        'libur' => 'Ya',
    ],
    [
        'id' => '186',
        'jadwal_kerja_id' => '32',
        'jadwal_kerja_hari_id' => '7',
        'libur' => 'Ya',
    ],
    [
        'id' => '187',
        'jadwal_kerja_id' => '32',
        'jadwal_kerja_hari_id' => '8',
        'libur' => 'Ya',
    ],
    [
        'id' => '188',
        'jadwal_kerja_id' => '33',
        'jadwal_kerja_hari_id' => '1',
        'libur' => 'Tidak',
    ],
    [
        'id' => '189',
        'jadwal_kerja_id' => '33',
        'jadwal_kerja_hari_id' => '2',
        'libur' => 'Tidak',
    ],
    [
        'id' => '190',
        'jadwal_kerja_id' => '33',
        'jadwal_kerja_hari_id' => '3',
        'libur' => 'Tidak',
    ],
    [
        'id' => '191',
        'jadwal_kerja_id' => '33',
        'jadwal_kerja_hari_id' => '4',
        'libur' => 'Tidak',
    ],
    [
        'id' => '192',
        'jadwal_kerja_id' => '33',
        'jadwal_kerja_hari_id' => '5',
        'libur' => 'Tidak',
    ],
    [
        'id' => '193',
        'jadwal_kerja_id' => '33',
        'jadwal_kerja_hari_id' => '6',
        'libur' => 'Ya',
    ],
    [
        'id' => '194',
        'jadwal_kerja_id' => '33',
        'jadwal_kerja_hari_id' => '7',
        'libur' => 'Ya',
    ],
    [
        'id' => '195',
        'jadwal_kerja_id' => '33',
        'jadwal_kerja_hari_id' => '8',
        'libur' => 'Ya',
    ],
    [
        'id' => '196',
        'jadwal_kerja_id' => '34',
        'jadwal_kerja_hari_id' => '1',
        'libur' => 'Tidak',
    ],
    [
        'id' => '197',
        'jadwal_kerja_id' => '34',
        'jadwal_kerja_hari_id' => '2',
        'libur' => 'Tidak',
    ],
    [
        'id' => '198',
        'jadwal_kerja_id' => '34',
        'jadwal_kerja_hari_id' => '3',
        'libur' => 'Tidak',
    ],
    [
        'id' => '199',
        'jadwal_kerja_id' => '34',
        'jadwal_kerja_hari_id' => '4',
        'libur' => 'Tidak',
    ],
    [
        'id' => '200',
        'jadwal_kerja_id' => '34',
        'jadwal_kerja_hari_id' => '5',
        'libur' => 'Tidak',
    ],
    [
        'id' => '201',
        'jadwal_kerja_id' => '34',
        'jadwal_kerja_hari_id' => '6',
        'libur' => 'Ya',
    ],
    [
        'id' => '202',
        'jadwal_kerja_id' => '34',
        'jadwal_kerja_hari_id' => '7',
        'libur' => 'Ya',
    ],
    [
        'id' => '203',
        'jadwal_kerja_id' => '34',
        'jadwal_kerja_hari_id' => '8',
        'libur' => 'Ya',
    ],
    [
        'id' => '204',
        'jadwal_kerja_id' => '35',
        'jadwal_kerja_hari_id' => '1',
        'libur' => 'Tidak',
    ],
    [
        'id' => '205',
        'jadwal_kerja_id' => '35',
        'jadwal_kerja_hari_id' => '2',
        'libur' => 'Tidak',
    ],
    [
        'id' => '206',
        'jadwal_kerja_id' => '35',
        'jadwal_kerja_hari_id' => '3',
        'libur' => 'Tidak',
    ],
    [
        'id' => '207',
        'jadwal_kerja_id' => '35',
        'jadwal_kerja_hari_id' => '4',
        'libur' => 'Tidak',
    ],
    [
        'id' => '208',
        'jadwal_kerja_id' => '35',
        'jadwal_kerja_hari_id' => '5',
        'libur' => 'Tidak',
    ],
    [
        'id' => '209',
        'jadwal_kerja_id' => '35',
        'jadwal_kerja_hari_id' => '6',
        'libur' => 'Ya',
    ],
    [
        'id' => '210',
        'jadwal_kerja_id' => '35',
        'jadwal_kerja_hari_id' => '7',
        'libur' => 'Ya',
    ],
    [
        'id' => '211',
        'jadwal_kerja_id' => '35',
        'jadwal_kerja_hari_id' => '8',
        'libur' => 'Ya',
    ],
    [
        'id' => '212',
        'jadwal_kerja_id' => '36',
        'jadwal_kerja_hari_id' => '1',
        'libur' => 'Tidak',
    ],
    [
        'id' => '213',
        'jadwal_kerja_id' => '36',
        'jadwal_kerja_hari_id' => '2',
        'libur' => 'Tidak',
    ],
    [
        'id' => '214',
        'jadwal_kerja_id' => '36',
        'jadwal_kerja_hari_id' => '3',
        'libur' => 'Tidak',
    ],
    [
        'id' => '215',
        'jadwal_kerja_id' => '36',
        'jadwal_kerja_hari_id' => '4',
        'libur' => 'Tidak',
    ],
    [
        'id' => '216',
        'jadwal_kerja_id' => '36',
        'jadwal_kerja_hari_id' => '5',
        'libur' => 'Tidak',
    ],
    [
        'id' => '217',
        'jadwal_kerja_id' => '36',
        'jadwal_kerja_hari_id' => '6',
        'libur' => 'Ya',
    ],
    [
        'id' => '218',
        'jadwal_kerja_id' => '36',
        'jadwal_kerja_hari_id' => '7',
        'libur' => 'Ya',
    ],
    [
        'id' => '219',
        'jadwal_kerja_id' => '36',
        'jadwal_kerja_hari_id' => '8',
        'libur' => 'Ya',
    ],
    [
        'id' => '220',
        'jadwal_kerja_id' => '37',
        'jadwal_kerja_hari_id' => '1',
        'libur' => 'Tidak',
    ],
    [
        'id' => '221',
        'jadwal_kerja_id' => '37',
        'jadwal_kerja_hari_id' => '2',
        'libur' => 'Tidak',
    ],
    [
        'id' => '222',
        'jadwal_kerja_id' => '37',
        'jadwal_kerja_hari_id' => '3',
        'libur' => 'Tidak',
    ],
    [
        'id' => '223',
        'jadwal_kerja_id' => '37',
        'jadwal_kerja_hari_id' => '4',
        'libur' => 'Tidak',
    ],
    [
        'id' => '224',
        'jadwal_kerja_id' => '37',
        'jadwal_kerja_hari_id' => '5',
        'libur' => 'Tidak',
    ],
    [
        'id' => '225',
        'jadwal_kerja_id' => '37',
        'jadwal_kerja_hari_id' => '6',
        'libur' => 'Tidak',
    ],
    [
        'id' => '226',
        'jadwal_kerja_id' => '37',
        'jadwal_kerja_hari_id' => '7',
        'libur' => 'Ya',
    ],
    [
        'id' => '227',
        'jadwal_kerja_id' => '37',
        'jadwal_kerja_hari_id' => '8',
        'libur' => 'Ya',
    ],
    [
        'id' => '228',
        'jadwal_kerja_id' => '38',
        'jadwal_kerja_hari_id' => '1',
        'libur' => 'Tidak',
    ],
    [
        'id' => '229',
        'jadwal_kerja_id' => '38',
        'jadwal_kerja_hari_id' => '2',
        'libur' => 'Tidak',
    ],
    [
        'id' => '230',
        'jadwal_kerja_id' => '38',
        'jadwal_kerja_hari_id' => '3',
        'libur' => 'Tidak',
    ],
    [
        'id' => '231',
        'jadwal_kerja_id' => '38',
        'jadwal_kerja_hari_id' => '4',
        'libur' => 'Tidak',
    ],
    [
        'id' => '232',
        'jadwal_kerja_id' => '38',
        'jadwal_kerja_hari_id' => '5',
        'libur' => 'Tidak',
    ],
    [
        'id' => '233',
        'jadwal_kerja_id' => '38',
        'jadwal_kerja_hari_id' => '6',
        'libur' => 'Ya',
    ],
    [
        'id' => '234',
        'jadwal_kerja_id' => '38',
        'jadwal_kerja_hari_id' => '7',
        'libur' => 'Ya',
    ],
    [
        'id' => '235',
        'jadwal_kerja_id' => '38',
        'jadwal_kerja_hari_id' => '8',
        'libur' => 'Ya',
    ],
    [
        'id' => '236',
        'jadwal_kerja_id' => '39',
        'jadwal_kerja_hari_id' => '1',
        'libur' => 'Tidak',
    ],
    [
        'id' => '237',
        'jadwal_kerja_id' => '39',
        'jadwal_kerja_hari_id' => '2',
        'libur' => 'Tidak',
    ],
    [
        'id' => '238',
        'jadwal_kerja_id' => '39',
        'jadwal_kerja_hari_id' => '3',
        'libur' => 'Tidak',
    ],
    [
        'id' => '239',
        'jadwal_kerja_id' => '39',
        'jadwal_kerja_hari_id' => '4',
        'libur' => 'Tidak',
    ],
    [
        'id' => '240',
        'jadwal_kerja_id' => '39',
        'jadwal_kerja_hari_id' => '5',
        'libur' => 'Tidak',
    ],
    [
        'id' => '241',
        'jadwal_kerja_id' => '39',
        'jadwal_kerja_hari_id' => '6',
        'libur' => 'Tidak',
    ],
    [
        'id' => '242',
        'jadwal_kerja_id' => '39',
        'jadwal_kerja_hari_id' => '7',
        'libur' => 'Ya',
    ],
    [
        'id' => '243',
        'jadwal_kerja_id' => '39',
        'jadwal_kerja_hari_id' => '8',
        'libur' => 'Ya',
    ],
    [
        'id' => '244',
        'jadwal_kerja_id' => '40',
        'jadwal_kerja_hari_id' => '1',
        'libur' => 'Tidak',
    ],
    [
        'id' => '245',
        'jadwal_kerja_id' => '40',
        'jadwal_kerja_hari_id' => '2',
        'libur' => 'Tidak',
    ],
    [
        'id' => '246',
        'jadwal_kerja_id' => '40',
        'jadwal_kerja_hari_id' => '3',
        'libur' => 'Tidak',
    ],
    [
        'id' => '247',
        'jadwal_kerja_id' => '40',
        'jadwal_kerja_hari_id' => '4',
        'libur' => 'Tidak',
    ],
    [
        'id' => '248',
        'jadwal_kerja_id' => '40',
        'jadwal_kerja_hari_id' => '5',
        'libur' => 'Tidak',
    ],
    [
        'id' => '249',
        'jadwal_kerja_id' => '40',
        'jadwal_kerja_hari_id' => '6',
        'libur' => 'Tidak',
    ],
    [
        'id' => '250',
        'jadwal_kerja_id' => '40',
        'jadwal_kerja_hari_id' => '7',
        'libur' => 'Ya',
    ],
    [
        'id' => '251',
        'jadwal_kerja_id' => '40',
        'jadwal_kerja_hari_id' => '8',
        'libur' => 'Ya',
    ],
]
        );
        $this->execute("set foreign_key_checks=1");
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%jadwal_kerja_detail}} CASCADE');
    }
}
