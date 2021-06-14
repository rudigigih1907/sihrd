<?php

use yii\db\Schema;
use yii\db\Migration;

class m210614_052854_userDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->execute("set foreign_key_checks=0");
        $this->truncateTable('{{%user}}');
        $this->batchInsert('{{%user}}',
                           ["id", "username", "auth_key", "password_hash", "password_reset_token", "email", "status", "created_at", "updated_at"],
                            [
    [
        'id' => '1',
        'username' => 'Raya',
        'auth_key' => 'qINsrgzNEpf3Irk1sHDiPWAnvyLJVpv5',
        'password_hash' => '$2y$13$lcOOGsMFVxIYrD/feoPFGeQtNL3l2wNqNDvr5fmDjMWPjFhVKFkOe',
        'password_reset_token' => null,
        'email' => 'ahmadfadlydziljalal@gmail.com',
        'status' => '10',
        'created_at' => '1622268015',
        'updated_at' => '1622268015',
    ],
    [
        'id' => '2',
        'username' => 'Hery',
        'auth_key' => 'ctKurI47eMAILv6-W7pCqYvHcvPlKV1X',
        'password_hash' => '$2y$13$.fcSX.82NhfGKvALX3.oTugVXID.m9G7tNEP.uNQV/LYbINd4Ql1G',
        'password_reset_token' => null,
        'email' => 'hery@tresnamuda.co.id',
        'status' => '10',
        'created_at' => '1622751043',
        'updated_at' => '1622751043',
    ],
    [
        'id' => '3',
        'username' => 'Vanny',
        'auth_key' => 'y-6-0n81VLCAie0w29wrEPcM-ineZC6p',
        'password_hash' => '$2y$13$GatrCT76GKzti.tte3TLF.iVFD5xA4jj.iK8VlpNYjwIrLkp05IOC',
        'password_reset_token' => null,
        'email' => 'hrdjkt@tresnamuda.co.id',
        'status' => '10',
        'created_at' => '1622778137',
        'updated_at' => '1622785013',
    ],
]
        );

        $this->execute("set foreign_key_checks=1");
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%user}} CASCADE');
    }
}
