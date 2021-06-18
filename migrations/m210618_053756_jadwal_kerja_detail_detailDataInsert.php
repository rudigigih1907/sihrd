<?php

use yii\db\Schema;
use yii\db\Migration;

class m210618_053756_jadwal_kerja_detail_detailDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->execute("set foreign_key_checks=0");
        $this->truncateTable('{{%jadwal_kerja_detail_detail}}');
        $this->batchInsert('{{%jadwal_kerja_detail_detail}}',
                           ["id", "jadwal_kerja_detail_id", "jam_kerja_id"],
                            [
    [
        'id' => '35',
        'jadwal_kerja_detail_id' => '153',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '38',
        'jadwal_kerja_detail_id' => '154',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '41',
        'jadwal_kerja_detail_id' => '155',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '42',
        'jadwal_kerja_detail_id' => '156',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '43',
        'jadwal_kerja_detail_id' => '157',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '47',
        'jadwal_kerja_detail_id' => '161',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '48',
        'jadwal_kerja_detail_id' => '162',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '49',
        'jadwal_kerja_detail_id' => '163',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '71',
        'jadwal_kerja_detail_id' => '180',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '72',
        'jadwal_kerja_detail_id' => '181',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '73',
        'jadwal_kerja_detail_id' => '182',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '74',
        'jadwal_kerja_detail_id' => '183',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '75',
        'jadwal_kerja_detail_id' => '184',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '76',
        'jadwal_kerja_detail_id' => '185',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '77',
        'jadwal_kerja_detail_id' => '186',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '78',
        'jadwal_kerja_detail_id' => '187',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '79',
        'jadwal_kerja_detail_id' => '188',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '80',
        'jadwal_kerja_detail_id' => '189',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '81',
        'jadwal_kerja_detail_id' => '190',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '82',
        'jadwal_kerja_detail_id' => '191',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '83',
        'jadwal_kerja_detail_id' => '192',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '84',
        'jadwal_kerja_detail_id' => '193',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '85',
        'jadwal_kerja_detail_id' => '194',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '86',
        'jadwal_kerja_detail_id' => '195',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '87',
        'jadwal_kerja_detail_id' => '196',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '88',
        'jadwal_kerja_detail_id' => '197',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '89',
        'jadwal_kerja_detail_id' => '198',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '90',
        'jadwal_kerja_detail_id' => '199',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '91',
        'jadwal_kerja_detail_id' => '200',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '92',
        'jadwal_kerja_detail_id' => '201',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '93',
        'jadwal_kerja_detail_id' => '202',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '94',
        'jadwal_kerja_detail_id' => '203',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '95',
        'jadwal_kerja_detail_id' => '204',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '96',
        'jadwal_kerja_detail_id' => '205',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '97',
        'jadwal_kerja_detail_id' => '206',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '98',
        'jadwal_kerja_detail_id' => '207',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '99',
        'jadwal_kerja_detail_id' => '208',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '100',
        'jadwal_kerja_detail_id' => '209',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '101',
        'jadwal_kerja_detail_id' => '210',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '102',
        'jadwal_kerja_detail_id' => '211',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '103',
        'jadwal_kerja_detail_id' => '212',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '104',
        'jadwal_kerja_detail_id' => '213',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '105',
        'jadwal_kerja_detail_id' => '214',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '106',
        'jadwal_kerja_detail_id' => '215',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '107',
        'jadwal_kerja_detail_id' => '216',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '108',
        'jadwal_kerja_detail_id' => '217',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '109',
        'jadwal_kerja_detail_id' => '218',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '110',
        'jadwal_kerja_detail_id' => '219',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '111',
        'jadwal_kerja_detail_id' => '220',
        'jam_kerja_id' => '15',
    ],
    [
        'id' => '112',
        'jadwal_kerja_detail_id' => '221',
        'jam_kerja_id' => '15',
    ],
    [
        'id' => '113',
        'jadwal_kerja_detail_id' => '222',
        'jam_kerja_id' => '15',
    ],
    [
        'id' => '114',
        'jadwal_kerja_detail_id' => '223',
        'jam_kerja_id' => '15',
    ],
    [
        'id' => '115',
        'jadwal_kerja_detail_id' => '224',
        'jam_kerja_id' => '15',
    ],
    [
        'id' => '116',
        'jadwal_kerja_detail_id' => '225',
        'jam_kerja_id' => '16',
    ],
    [
        'id' => '117',
        'jadwal_kerja_detail_id' => '226',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '118',
        'jadwal_kerja_detail_id' => '227',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '119',
        'jadwal_kerja_detail_id' => '228',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '120',
        'jadwal_kerja_detail_id' => '229',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '121',
        'jadwal_kerja_detail_id' => '230',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '122',
        'jadwal_kerja_detail_id' => '231',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '123',
        'jadwal_kerja_detail_id' => '232',
        'jam_kerja_id' => '3',
    ],
    [
        'id' => '124',
        'jadwal_kerja_detail_id' => '233',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '125',
        'jadwal_kerja_detail_id' => '234',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '126',
        'jadwal_kerja_detail_id' => '235',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '127',
        'jadwal_kerja_detail_id' => '236',
        'jam_kerja_id' => '17',
    ],
    [
        'id' => '128',
        'jadwal_kerja_detail_id' => '236',
        'jam_kerja_id' => '18',
    ],
    [
        'id' => '129',
        'jadwal_kerja_detail_id' => '237',
        'jam_kerja_id' => '17',
    ],
    [
        'id' => '130',
        'jadwal_kerja_detail_id' => '237',
        'jam_kerja_id' => '18',
    ],
    [
        'id' => '131',
        'jadwal_kerja_detail_id' => '238',
        'jam_kerja_id' => '17',
    ],
    [
        'id' => '132',
        'jadwal_kerja_detail_id' => '238',
        'jam_kerja_id' => '18',
    ],
    [
        'id' => '133',
        'jadwal_kerja_detail_id' => '239',
        'jam_kerja_id' => '17',
    ],
    [
        'id' => '134',
        'jadwal_kerja_detail_id' => '239',
        'jam_kerja_id' => '18',
    ],
    [
        'id' => '135',
        'jadwal_kerja_detail_id' => '240',
        'jam_kerja_id' => '17',
    ],
    [
        'id' => '136',
        'jadwal_kerja_detail_id' => '240',
        'jam_kerja_id' => '18',
    ],
    [
        'id' => '137',
        'jadwal_kerja_detail_id' => '241',
        'jam_kerja_id' => '19',
    ],
    [
        'id' => '138',
        'jadwal_kerja_detail_id' => '242',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '139',
        'jadwal_kerja_detail_id' => '243',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '140',
        'jadwal_kerja_detail_id' => '244',
        'jam_kerja_id' => '17',
    ],
    [
        'id' => '141',
        'jadwal_kerja_detail_id' => '244',
        'jam_kerja_id' => '18',
    ],
    [
        'id' => '142',
        'jadwal_kerja_detail_id' => '245',
        'jam_kerja_id' => '17',
    ],
    [
        'id' => '143',
        'jadwal_kerja_detail_id' => '245',
        'jam_kerja_id' => '18',
    ],
    [
        'id' => '144',
        'jadwal_kerja_detail_id' => '246',
        'jam_kerja_id' => '17',
    ],
    [
        'id' => '145',
        'jadwal_kerja_detail_id' => '246',
        'jam_kerja_id' => '18',
    ],
    [
        'id' => '146',
        'jadwal_kerja_detail_id' => '247',
        'jam_kerja_id' => '17',
    ],
    [
        'id' => '147',
        'jadwal_kerja_detail_id' => '247',
        'jam_kerja_id' => '18',
    ],
    [
        'id' => '148',
        'jadwal_kerja_detail_id' => '248',
        'jam_kerja_id' => '17',
    ],
    [
        'id' => '149',
        'jadwal_kerja_detail_id' => '248',
        'jam_kerja_id' => '18',
    ],
    [
        'id' => '150',
        'jadwal_kerja_detail_id' => '249',
        'jam_kerja_id' => '19',
    ],
    [
        'id' => '151',
        'jadwal_kerja_detail_id' => '250',
        'jam_kerja_id' => null,
    ],
    [
        'id' => '152',
        'jadwal_kerja_detail_id' => '251',
        'jam_kerja_id' => null,
    ],
]
        );
        $this->execute("set foreign_key_checks=1");
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%jadwal_kerja_detail_detail}} CASCADE');
    }
}
