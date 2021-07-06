<?php
/**
 * Created by PhpStorm.
 * User: dzil
 * Date: 10/05/17
 * Time: 13:44
 */

namespace app\events;

use app\models\User;
use rmrevin\yii\fontawesome\FAR;
use Yii;
use yii\helpers\Html;

class AfterLoginEvent {
    public static function handlePasswordForFirstTime($event) {
        $user = new User();
        $app = Yii::$app;
        $session = $app->session;

        if ($user->validatePasswordWithHashUser("123456", $app->user->identity->password_hash)) {

            $session['_defaultPassword'] = true;

            $session->setFlash('danger',
                FAR::icon(FAR::_ANGRY) . "
                            Password Anda Masih Default Dari Sistem." .
                Html::a(' Klik link berikut untuk mengganti password',
                    ['site/change-password'],
                    ['class' => 'btn btn-link']
                )
            );
        }else{
            $session['_defaultPassword'] = false;
        }
    }
}