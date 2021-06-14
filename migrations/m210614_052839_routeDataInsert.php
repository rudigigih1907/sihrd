<?php

use yii\db\Schema;
use yii\db\Migration;

class m210614_052839_routeDataInsert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->execute("set foreign_key_checks=0");
        $this->truncateTable('{{%route}}');
        $this->batchInsert('{{%route}}',
                           ["name", "alias", "type", "status"],
                            [
    [
        'name' => '/*',
        'alias' => '*',
        'type' => '',
        'status' => '1',
    ],
    [
        'name' => '/admin/*',
        'alias' => '*',
        'type' => 'admin',
        'status' => '1',
    ],
    [
        'name' => '/admin/assignment/*',
        'alias' => '*',
        'type' => 'admin/assignment',
        'status' => '1',
    ],
    [
        'name' => '/admin/assignment/assign',
        'alias' => 'assign',
        'type' => 'admin/assignment',
        'status' => '1',
    ],
    [
        'name' => '/admin/assignment/index',
        'alias' => 'index',
        'type' => 'admin/assignment',
        'status' => '1',
    ],
    [
        'name' => '/admin/assignment/revoke',
        'alias' => 'revoke',
        'type' => 'admin/assignment',
        'status' => '1',
    ],
    [
        'name' => '/admin/assignment/view',
        'alias' => 'view',
        'type' => 'admin/assignment',
        'status' => '1',
    ],
    [
        'name' => '/admin/default/*',
        'alias' => '*',
        'type' => 'admin/default',
        'status' => '1',
    ],
    [
        'name' => '/admin/default/index',
        'alias' => 'index',
        'type' => 'admin/default',
        'status' => '1',
    ],
    [
        'name' => '/admin/menu/*',
        'alias' => '*',
        'type' => 'admin/menu',
        'status' => '1',
    ],
    [
        'name' => '/admin/menu/create',
        'alias' => 'create',
        'type' => 'admin/menu',
        'status' => '1',
    ],
    [
        'name' => '/admin/menu/delete',
        'alias' => 'delete',
        'type' => 'admin/menu',
        'status' => '1',
    ],
    [
        'name' => '/admin/menu/index',
        'alias' => 'index',
        'type' => 'admin/menu',
        'status' => '1',
    ],
    [
        'name' => '/admin/menu/update',
        'alias' => 'update',
        'type' => 'admin/menu',
        'status' => '1',
    ],
    [
        'name' => '/admin/menu/view',
        'alias' => 'view',
        'type' => 'admin/menu',
        'status' => '1',
    ],
    [
        'name' => '/admin/permission/*',
        'alias' => '*',
        'type' => 'admin/permission',
        'status' => '1',
    ],
    [
        'name' => '/admin/permission/assign',
        'alias' => 'assign',
        'type' => 'admin/permission',
        'status' => '1',
    ],
    [
        'name' => '/admin/permission/create',
        'alias' => 'create',
        'type' => 'admin/permission',
        'status' => '1',
    ],
    [
        'name' => '/admin/permission/delete',
        'alias' => 'delete',
        'type' => 'admin/permission',
        'status' => '1',
    ],
    [
        'name' => '/admin/permission/get-users',
        'alias' => 'get-users',
        'type' => 'admin/permission',
        'status' => '1',
    ],
    [
        'name' => '/admin/permission/index',
        'alias' => 'index',
        'type' => 'admin/permission',
        'status' => '1',
    ],
    [
        'name' => '/admin/permission/remove',
        'alias' => 'remove',
        'type' => 'admin/permission',
        'status' => '1',
    ],
    [
        'name' => '/admin/permission/update',
        'alias' => 'update',
        'type' => 'admin/permission',
        'status' => '1',
    ],
    [
        'name' => '/admin/permission/view',
        'alias' => 'view',
        'type' => 'admin/permission',
        'status' => '1',
    ],
    [
        'name' => '/admin/role/*',
        'alias' => '*',
        'type' => 'admin/role',
        'status' => '1',
    ],
    [
        'name' => '/admin/role/assign',
        'alias' => 'assign',
        'type' => 'admin/role',
        'status' => '1',
    ],
    [
        'name' => '/admin/role/create',
        'alias' => 'create',
        'type' => 'admin/role',
        'status' => '1',
    ],
    [
        'name' => '/admin/role/delete',
        'alias' => 'delete',
        'type' => 'admin/role',
        'status' => '1',
    ],
    [
        'name' => '/admin/role/get-users',
        'alias' => 'get-users',
        'type' => 'admin/role',
        'status' => '1',
    ],
    [
        'name' => '/admin/role/index',
        'alias' => 'index',
        'type' => 'admin/role',
        'status' => '1',
    ],
    [
        'name' => '/admin/role/remove',
        'alias' => 'remove',
        'type' => 'admin/role',
        'status' => '1',
    ],
    [
        'name' => '/admin/role/update',
        'alias' => 'update',
        'type' => 'admin/role',
        'status' => '1',
    ],
    [
        'name' => '/admin/role/view',
        'alias' => 'view',
        'type' => 'admin/role',
        'status' => '1',
    ],
    [
        'name' => '/admin/route/*',
        'alias' => '*',
        'type' => 'admin/route',
        'status' => '1',
    ],
    [
        'name' => '/admin/route/assign',
        'alias' => 'assign',
        'type' => 'admin/route',
        'status' => '1',
    ],
    [
        'name' => '/admin/route/create',
        'alias' => 'create',
        'type' => 'admin/route',
        'status' => '1',
    ],
    [
        'name' => '/admin/route/index',
        'alias' => 'index',
        'type' => 'admin/route',
        'status' => '1',
    ],
    [
        'name' => '/admin/route/refresh',
        'alias' => 'refresh',
        'type' => 'admin/route',
        'status' => '1',
    ],
    [
        'name' => '/admin/route/remove',
        'alias' => 'remove',
        'type' => 'admin/route',
        'status' => '1',
    ],
    [
        'name' => '/admin/rule/*',
        'alias' => '*',
        'type' => 'admin/rule',
        'status' => '1',
    ],
    [
        'name' => '/admin/rule/create',
        'alias' => 'create',
        'type' => 'admin/rule',
        'status' => '1',
    ],
    [
        'name' => '/admin/rule/delete',
        'alias' => 'delete',
        'type' => 'admin/rule',
        'status' => '1',
    ],
    [
        'name' => '/admin/rule/index',
        'alias' => 'index',
        'type' => 'admin/rule',
        'status' => '1',
    ],
    [
        'name' => '/admin/rule/update',
        'alias' => 'update',
        'type' => 'admin/rule',
        'status' => '1',
    ],
    [
        'name' => '/admin/rule/view',
        'alias' => 'view',
        'type' => 'admin/rule',
        'status' => '1',
    ],
    [
        'name' => '/admin/user/*',
        'alias' => '*',
        'type' => 'admin/user',
        'status' => '1',
    ],
    [
        'name' => '/admin/user/activate',
        'alias' => 'activate',
        'type' => 'admin/user',
        'status' => '1',
    ],
    [
        'name' => '/admin/user/change-password',
        'alias' => 'change-password',
        'type' => 'admin/user',
        'status' => '1',
    ],
    [
        'name' => '/admin/user/delete',
        'alias' => 'delete',
        'type' => 'admin/user',
        'status' => '1',
    ],
    [
        'name' => '/admin/user/index',
        'alias' => 'index',
        'type' => 'admin/user',
        'status' => '1',
    ],
    [
        'name' => '/admin/user/login',
        'alias' => 'login',
        'type' => 'admin/user',
        'status' => '1',
    ],
    [
        'name' => '/admin/user/logout',
        'alias' => 'logout',
        'type' => 'admin/user',
        'status' => '1',
    ],
    [
        'name' => '/admin/user/request-password-reset',
        'alias' => 'request-password-reset',
        'type' => 'admin/user',
        'status' => '1',
    ],
    [
        'name' => '/admin/user/reset-password',
        'alias' => 'reset-password',
        'type' => 'admin/user',
        'status' => '1',
    ],
    [
        'name' => '/admin/user/signup',
        'alias' => 'signup',
        'type' => 'admin/user',
        'status' => '1',
    ],
    [
        'name' => '/admin/user/view',
        'alias' => 'view',
        'type' => 'admin/user',
        'status' => '1',
    ],
    [
        'name' => '/agama/*',
        'alias' => '*',
        'type' => 'agama',
        'status' => '1',
    ],
    [
        'name' => '/agama/create',
        'alias' => 'create',
        'type' => 'agama',
        'status' => '1',
    ],
    [
        'name' => '/agama/delete',
        'alias' => 'delete',
        'type' => 'agama',
        'status' => '1',
    ],
    [
        'name' => '/agama/index',
        'alias' => 'index',
        'type' => 'agama',
        'status' => '1',
    ],
    [
        'name' => '/agama/update',
        'alias' => 'update',
        'type' => 'agama',
        'status' => '1',
    ],
    [
        'name' => '/agama/view',
        'alias' => 'view',
        'type' => 'agama',
        'status' => '1',
    ],
    [
        'name' => '/card/*',
        'alias' => '*',
        'type' => 'card',
        'status' => '1',
    ],
    [
        'name' => '/card/create',
        'alias' => 'create',
        'type' => 'card',
        'status' => '1',
    ],
    [
        'name' => '/card/delete',
        'alias' => 'delete',
        'type' => 'card',
        'status' => '1',
    ],
    [
        'name' => '/card/index',
        'alias' => 'index',
        'type' => 'card',
        'status' => '1',
    ],
    [
        'name' => '/card/update',
        'alias' => 'update',
        'type' => 'card',
        'status' => '1',
    ],
    [
        'name' => '/card/view',
        'alias' => 'view',
        'type' => 'card',
        'status' => '1',
    ],
    [
        'name' => '/datecontrol/*',
        'alias' => '*',
        'type' => 'datecontrol',
        'status' => '1',
    ],
    [
        'name' => '/datecontrol/parse/*',
        'alias' => '*',
        'type' => 'datecontrol/parse',
        'status' => '1',
    ],
    [
        'name' => '/datecontrol/parse/convert',
        'alias' => 'convert',
        'type' => 'datecontrol/parse',
        'status' => '1',
    ],
    [
        'name' => '/debug/*',
        'alias' => '*',
        'type' => 'debug',
        'status' => '1',
    ],
    [
        'name' => '/debug/default/*',
        'alias' => '*',
        'type' => 'debug/default',
        'status' => '1',
    ],
    [
        'name' => '/debug/default/db-explain',
        'alias' => 'db-explain',
        'type' => 'debug/default',
        'status' => '1',
    ],
    [
        'name' => '/debug/default/download-mail',
        'alias' => 'download-mail',
        'type' => 'debug/default',
        'status' => '1',
    ],
    [
        'name' => '/debug/default/index',
        'alias' => 'index',
        'type' => 'debug/default',
        'status' => '1',
    ],
    [
        'name' => '/debug/default/toolbar',
        'alias' => 'toolbar',
        'type' => 'debug/default',
        'status' => '1',
    ],
    [
        'name' => '/debug/default/view',
        'alias' => 'view',
        'type' => 'debug/default',
        'status' => '1',
    ],
    [
        'name' => '/debug/user/*',
        'alias' => '*',
        'type' => 'debug/user',
        'status' => '1',
    ],
    [
        'name' => '/debug/user/reset-identity',
        'alias' => 'reset-identity',
        'type' => 'debug/user',
        'status' => '1',
    ],
    [
        'name' => '/debug/user/set-identity',
        'alias' => 'set-identity',
        'type' => 'debug/user',
        'status' => '1',
    ],
    [
        'name' => '/gii/*',
        'alias' => '*',
        'type' => 'gii',
        'status' => '1',
    ],
    [
        'name' => '/gii/default/*',
        'alias' => '*',
        'type' => 'gii/default',
        'status' => '1',
    ],
    [
        'name' => '/gii/default/action',
        'alias' => 'action',
        'type' => 'gii/default',
        'status' => '1',
    ],
    [
        'name' => '/gii/default/diff',
        'alias' => 'diff',
        'type' => 'gii/default',
        'status' => '1',
    ],
    [
        'name' => '/gii/default/index',
        'alias' => 'index',
        'type' => 'gii/default',
        'status' => '1',
    ],
    [
        'name' => '/gii/default/preview',
        'alias' => 'preview',
        'type' => 'gii/default',
        'status' => '1',
    ],
    [
        'name' => '/gii/default/view',
        'alias' => 'view',
        'type' => 'gii/default',
        'status' => '1',
    ],
    [
        'name' => '/gridview/*',
        'alias' => '*',
        'type' => 'gridview',
        'status' => '1',
    ],
    [
        'name' => '/gridview/export/*',
        'alias' => '*',
        'type' => 'gridview/export',
        'status' => '1',
    ],
    [
        'name' => '/gridview/export/download',
        'alias' => 'download',
        'type' => 'gridview/export',
        'status' => '1',
    ],
    [
        'name' => '/karyawan/*',
        'alias' => '*',
        'type' => 'karyawan',
        'status' => '1',
    ],
    [
        'name' => '/karyawan/create',
        'alias' => 'create',
        'type' => 'karyawan',
        'status' => '1',
    ],
    [
        'name' => '/karyawan/delete',
        'alias' => 'delete',
        'type' => 'karyawan',
        'status' => '1',
    ],
    [
        'name' => '/karyawan/index',
        'alias' => 'index',
        'type' => 'karyawan',
        'status' => '1',
    ],
    [
        'name' => '/karyawan/update',
        'alias' => 'update',
        'type' => 'karyawan',
        'status' => '1',
    ],
    [
        'name' => '/karyawan/view',
        'alias' => 'view',
        'type' => 'karyawan',
        'status' => '1',
    ],
    [
        'name' => '/mimin/*',
        'alias' => '*',
        'type' => 'mimin',
        'status' => '1',
    ],
    [
        'name' => '/mimin/role/*',
        'alias' => '*',
        'type' => 'mimin/role',
        'status' => '1',
    ],
    [
        'name' => '/mimin/role/create',
        'alias' => 'create',
        'type' => 'mimin/role',
        'status' => '1',
    ],
    [
        'name' => '/mimin/role/delete',
        'alias' => 'delete',
        'type' => 'mimin/role',
        'status' => '1',
    ],
    [
        'name' => '/mimin/role/index',
        'alias' => 'index',
        'type' => 'mimin/role',
        'status' => '1',
    ],
    [
        'name' => '/mimin/role/permission',
        'alias' => 'permission',
        'type' => 'mimin/role',
        'status' => '1',
    ],
    [
        'name' => '/mimin/role/update',
        'alias' => 'update',
        'type' => 'mimin/role',
        'status' => '1',
    ],
    [
        'name' => '/mimin/role/view',
        'alias' => 'view',
        'type' => 'mimin/role',
        'status' => '1',
    ],
    [
        'name' => '/mimin/route/*',
        'alias' => '*',
        'type' => 'mimin/route',
        'status' => '1',
    ],
    [
        'name' => '/mimin/route/create',
        'alias' => 'create',
        'type' => 'mimin/route',
        'status' => '1',
    ],
    [
        'name' => '/mimin/route/delete',
        'alias' => 'delete',
        'type' => 'mimin/route',
        'status' => '1',
    ],
    [
        'name' => '/mimin/route/generate',
        'alias' => 'generate',
        'type' => 'mimin/route',
        'status' => '1',
    ],
    [
        'name' => '/mimin/route/index',
        'alias' => 'index',
        'type' => 'mimin/route',
        'status' => '1',
    ],
    [
        'name' => '/mimin/route/update',
        'alias' => 'update',
        'type' => 'mimin/route',
        'status' => '1',
    ],
    [
        'name' => '/mimin/route/view',
        'alias' => 'view',
        'type' => 'mimin/route',
        'status' => '1',
    ],
    [
        'name' => '/mimin/user/*',
        'alias' => '*',
        'type' => 'mimin/user',
        'status' => '1',
    ],
    [
        'name' => '/mimin/user/create',
        'alias' => 'create',
        'type' => 'mimin/user',
        'status' => '1',
    ],
    [
        'name' => '/mimin/user/delete',
        'alias' => 'delete',
        'type' => 'mimin/user',
        'status' => '1',
    ],
    [
        'name' => '/mimin/user/index',
        'alias' => 'index',
        'type' => 'mimin/user',
        'status' => '1',
    ],
    [
        'name' => '/mimin/user/update',
        'alias' => 'update',
        'type' => 'mimin/user',
        'status' => '1',
    ],
    [
        'name' => '/mimin/user/view',
        'alias' => 'view',
        'type' => 'mimin/user',
        'status' => '1',
    ],
    [
        'name' => '/quotation/*',
        'alias' => '*',
        'type' => 'quotation',
        'status' => '1',
    ],
    [
        'name' => '/quotation/create',
        'alias' => 'create',
        'type' => 'quotation',
        'status' => '1',
    ],
    [
        'name' => '/quotation/delete',
        'alias' => 'delete',
        'type' => 'quotation',
        'status' => '1',
    ],
    [
        'name' => '/quotation/index',
        'alias' => 'index',
        'type' => 'quotation',
        'status' => '1',
    ],
    [
        'name' => '/quotation/update',
        'alias' => 'update',
        'type' => 'quotation',
        'status' => '1',
    ],
    [
        'name' => '/quotation/view',
        'alias' => 'view',
        'type' => 'quotation',
        'status' => '1',
    ],
    [
        'name' => '/site/*',
        'alias' => '*',
        'type' => 'site',
        'status' => '1',
    ],
    [
        'name' => '/site/about',
        'alias' => 'about',
        'type' => 'site',
        'status' => '1',
    ],
    [
        'name' => '/site/captcha',
        'alias' => 'captcha',
        'type' => 'site',
        'status' => '1',
    ],
    [
        'name' => '/site/contact',
        'alias' => 'contact',
        'type' => 'site',
        'status' => '1',
    ],
    [
        'name' => '/site/error',
        'alias' => 'error',
        'type' => 'site',
        'status' => '1',
    ],
    [
        'name' => '/site/index',
        'alias' => 'index',
        'type' => 'site',
        'status' => '1',
    ],
    [
        'name' => '/site/login',
        'alias' => 'login',
        'type' => 'site',
        'status' => '1',
    ],
    [
        'name' => '/site/logout',
        'alias' => 'logout',
        'type' => 'site',
        'status' => '1',
    ],
    [
        'name' => '/status-perkawinan/*',
        'alias' => '*',
        'type' => 'status-perkawinan',
        'status' => '1',
    ],
    [
        'name' => '/status-perkawinan/create',
        'alias' => 'create',
        'type' => 'status-perkawinan',
        'status' => '1',
    ],
    [
        'name' => '/status-perkawinan/delete',
        'alias' => 'delete',
        'type' => 'status-perkawinan',
        'status' => '1',
    ],
    [
        'name' => '/status-perkawinan/index',
        'alias' => 'index',
        'type' => 'status-perkawinan',
        'status' => '1',
    ],
    [
        'name' => '/status-perkawinan/update',
        'alias' => 'update',
        'type' => 'status-perkawinan',
        'status' => '1',
    ],
    [
        'name' => '/status-perkawinan/view',
        'alias' => 'view',
        'type' => 'status-perkawinan',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/*',
        'alias' => '*',
        'type' => 'superadmin',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/default/*',
        'alias' => '*',
        'type' => 'superadmin/default',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/default/index',
        'alias' => 'index',
        'type' => 'superadmin/default',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-role/*',
        'alias' => '*',
        'type' => 'superadmin/mini-role',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-role/create',
        'alias' => 'create',
        'type' => 'superadmin/mini-role',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-role/delete',
        'alias' => 'delete',
        'type' => 'superadmin/mini-role',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-role/index',
        'alias' => 'index',
        'type' => 'superadmin/mini-role',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-role/permission',
        'alias' => 'permission',
        'type' => 'superadmin/mini-role',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-role/update',
        'alias' => 'update',
        'type' => 'superadmin/mini-role',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-role/view',
        'alias' => 'view',
        'type' => 'superadmin/mini-role',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-route/*',
        'alias' => '*',
        'type' => 'superadmin/mini-route',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-route/create',
        'alias' => 'create',
        'type' => 'superadmin/mini-route',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-route/delete',
        'alias' => 'delete',
        'type' => 'superadmin/mini-route',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-route/generate',
        'alias' => 'generate',
        'type' => 'superadmin/mini-route',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-route/index',
        'alias' => 'index',
        'type' => 'superadmin/mini-route',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-route/update',
        'alias' => 'update',
        'type' => 'superadmin/mini-route',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-route/view',
        'alias' => 'view',
        'type' => 'superadmin/mini-route',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-user/*',
        'alias' => '*',
        'type' => 'superadmin/mini-user',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-user/create',
        'alias' => 'create',
        'type' => 'superadmin/mini-user',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-user/delete',
        'alias' => 'delete',
        'type' => 'superadmin/mini-user',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-user/index',
        'alias' => 'index',
        'type' => 'superadmin/mini-user',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-user/update',
        'alias' => 'update',
        'type' => 'superadmin/mini-user',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/mini-user/view',
        'alias' => 'view',
        'type' => 'superadmin/mini-user',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/session/*',
        'alias' => '*',
        'type' => 'superadmin/session',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/session/bulkdelete',
        'alias' => 'bulkdelete',
        'type' => 'superadmin/session',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/session/delete',
        'alias' => 'delete',
        'type' => 'superadmin/session',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/session/delete-at-least24-hours-ago',
        'alias' => 'delete-at-least24-hours-ago',
        'type' => 'superadmin/session',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/session/index',
        'alias' => 'index',
        'type' => 'superadmin/session',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/session/view',
        'alias' => 'view',
        'type' => 'superadmin/session',
        'status' => '1',
    ],
    [
        'name' => '/superadmin/session/view-online-today',
        'alias' => 'view-online-today',
        'type' => 'superadmin/session',
        'status' => '1',
    ],
]
        );

        $this->execute("set foreign_key_checks=1");
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%route}} CASCADE');
    }
}
