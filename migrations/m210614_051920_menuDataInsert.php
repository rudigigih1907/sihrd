<?php

use yii\db\Schema;
use yii\db\Migration;

class m210614_051920_menuDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {

        $this->execute("set foreign_key_checks=0");
        $this->truncateTable('{{%menu}}');
        $this->batchInsert('{{%menu}}',
                           ["id", "name", "parent", "route", "order", "data"],
                            [
    [
        'id' => '3',
        'name' => 'Super Admin',
        'parent' => null,
        'route' => null,
        'order' => null,
        'data' => null,
    ],
    [
        'id' => '4',
        'name' => 'Full Admin',
        'parent' => '3',
        'route' => null,
        'order' => null,
        'data' => null,
    ],
    [
        'id' => '5',
        'name' => 'Assignment',
        'parent' => '4',
        'route' => '/admin/assignment/index',
        'order' => null,
        'data' => 'return[\'controller\' => \'assignment\'];',
    ],
    [
        'id' => '6',
        'name' => 'Menu',
        'parent' => '4',
        'route' => '/admin/menu/index',
        'order' => null,
        'data' => 'return[\'controller\' => \'menu\',];',
    ],
    [
        'id' => '7',
        'name' => 'Route',
        'parent' => '4',
        'route' => '/admin/route/index',
        'order' => null,
        'data' => 'return[\'module\' => \'admin\', \'controller\' => \'route\'];',
    ],
    [
        'id' => '8',
        'name' => 'Permission',
        'parent' => '4',
        'route' => '/admin/permission/index',
        'order' => null,
        'data' => 'return[\'controller\' => \'permission\'];',
    ],
    [
        'id' => '9',
        'name' => 'Role',
        'parent' => '4',
        'route' => '/admin/role/index',
        'order' => null,
        'data' => 'return[\'module\' => \'admin\', \'controller\' => \'role\'];',
    ],
    [
        'id' => '10',
        'name' => 'Rule',
        'parent' => '4',
        'route' => '/admin/rule/index',
        'order' => null,
        'data' => 'return[\'controller\' => \'rule\'];',
    ],
    [
        'id' => '11',
        'name' => 'User',
        'parent' => '4',
        'route' => '/admin/user/index',
        'order' => null,
        'data' => 'return[\'module\' => \'admin\', \'controller\' => \'user\'];',
    ],
    [
        'id' => '28',
        'name' => 'Development',
        'parent' => '3',
        'route' => null,
        'order' => null,
        'data' => null,
    ],
    [
        'id' => '29',
        'name' => 'Gii',
        'parent' => '28',
        'route' => '/gii/default/index',
        'order' => null,
        'data' => null,
    ],
    [
        'id' => '30',
        'name' => 'Debug',
        'parent' => '28',
        'route' => '/debug/default/index',
        'order' => null,
        'data' => null,
    ],
    [
        'id' => '38',
        'name' => 'Mini Admin',
        'parent' => '3',
        'route' => null,
        'order' => null,
        'data' => null,
    ],
    [
        'id' => '39',
        'name' => 'Route',
        'parent' => '38',
        'route' => '/mimin/route/index',
        'order' => null,
        'data' => 'return[\'module\' => \'mimin\', \'controller\' => \'route\'];',
    ],
    [
        'id' => '40',
        'name' => 'Role',
        'parent' => '38',
        'route' => '/mimin/role/index',
        'order' => null,
        'data' => 'return[\'module\' => \'mimin\', \'controller\' => \'role\'];',
    ],
    [
        'id' => '41',
        'name' => 'User',
        'parent' => '38',
        'route' => '/mimin/user/index',
        'order' => null,
        'data' => 'return[\'module\' => \'mimin\', \'controller\' => \'user\'];',
    ],
    [
        'id' => '49',
        'name' => 'Karyawan',
        'parent' => null,
        'route' => '/karyawan/index',
        'order' => null,
        'data' => 'return[\'controller\' => \'karyawan\'];',
    ],
    [
        'id' => '50',
        'name' => 'Master Data',
        'parent' => null,
        'route' => null,
        'order' => null,
        'data' => null,
    ],
    [
        'id' => '51',
        'name' => 'Status Perkawinan',
        'parent' => '50',
        'route' => '/status-perkawinan/index',
        'order' => null,
        'data' => 'return[\'controller\' => \'status-perkawinan\'];',
    ],
    [
        'id' => '52',
        'name' => 'Agama',
        'parent' => '50',
        'route' => '/agama/index',
        'order' => null,
        'data' => 'return[\'controller\' => \'agama\'];',
    ],
]
        );

        $this->execute("set foreign_key_checks=1");
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%menu}} CASCADE');
    }
}
