<?php

use yii\db\Schema;
use yii\db\Migration;

class m210614_052950_auth_item_childDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->execute("set foreign_key_checks=0");
        $this->truncateTable('{{%auth_item_child}}');
        $this->batchInsert('{{%auth_item_child}}',
                           ["parent", "child"],
                            [
    [
        'parent' => 'super-admin',
        'child' => '/*',
    ],
    [
        'parent' => 'manager',
        'child' => '/agama/create',
    ],
    [
        'parent' => 'manager',
        'child' => '/agama/delete',
    ],
    [
        'parent' => 'manager',
        'child' => '/agama/index',
    ],
    [
        'parent' => 'manager',
        'child' => '/agama/update',
    ],
    [
        'parent' => 'manager',
        'child' => '/agama/view',
    ],
    [
        'parent' => 'user-default',
        'child' => '/karyawan/create',
    ],
    [
        'parent' => 'user-default',
        'child' => '/karyawan/index',
    ],
    [
        'parent' => 'user-default',
        'child' => '/karyawan/update',
    ],
    [
        'parent' => 'user-default',
        'child' => '/karyawan/view',
    ],
    [
        'parent' => 'user-default',
        'child' => '/karyawan/view-update-delete',
    ],
    [
        'parent' => 'user-default',
        'child' => '/site/*',
    ],
    [
        'parent' => 'manager',
        'child' => '/status-perkawinan/create',
    ],
    [
        'parent' => 'manager',
        'child' => '/status-perkawinan/delete',
    ],
    [
        'parent' => 'manager',
        'child' => '/status-perkawinan/index',
    ],
    [
        'parent' => 'manager',
        'child' => '/status-perkawinan/update',
    ],
    [
        'parent' => 'manager',
        'child' => '/status-perkawinan/view',
    ],
]
        );

        $this->execute("set foreign_key_checks=1");
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%auth_item_child}} CASCADE');
    }
}
