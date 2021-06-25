<?php

use yii\db\Schema;
use yii\db\Migration;

class m210625_082226_cuti_normatifDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->execute("set foreign_key_checks=0");
        $this->truncateTable('{{%cuti_normatif}}');
        $this->batchInsert('{{%cuti_normatif}}',
                           ["id", "nama", "lama", "dibayar", "created_at", "updated_at", "created_by", "updated_by"],
                            [
    [
        'id' => '1',
        'nama' => 'Cuti Hamil',
        'lama' => '45',
        'dibayar' => 'Ya',
        'created_at' => '1624609233',
        'updated_at' => '1624609233',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '2',
        'nama' => 'Cuti Menikah',
        'lama' => '3',
        'dibayar' => 'Ya',
        'created_at' => '1624609249',
        'updated_at' => '1624609249',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '3',
        'nama' => 'Cuti Khitan Anak',
        'lama' => '2',
        'dibayar' => 'Ya',
        'created_at' => '1624609261',
        'updated_at' => '1624609261',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '4',
        'nama' => 'Cuti Menikahkan Anak',
        'lama' => '2',
        'dibayar' => 'Ya',
        'created_at' => '1624609276',
        'updated_at' => '1624609276',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '5',
        'nama' => 'Cuti Keluarga Meninggal',
        'lama' => '2',
        'dibayar' => 'Ya',
        'created_at' => '1624609293',
        'updated_at' => '1624609293',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '6',
        'nama' => 'Cuti Pindah Rumah',
        'lama' => '3',
        'dibayar' => 'Ya',
        'created_at' => '1624609307',
        'updated_at' => '1624609307',
        'created_by' => '1',
        'updated_by' => '1',
    ],
    [
        'id' => '7',
        'nama' => 'Cuti Membaptiskan Anak',
        'lama' => '2',
        'dibayar' => 'Ya',
        'created_at' => '1624609317',
        'updated_at' => '1624609317',
        'created_by' => '1',
        'updated_by' => '1',
    ],
]
        );
        $this->execute("set foreign_key_checks=1");
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%cuti_normatif}} CASCADE');
    }
}
