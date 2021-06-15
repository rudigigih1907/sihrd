<?php

namespace app\models;

use app\models\base\Session as BaseSession;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "session".
 */
class Session extends BaseSession {

    public static function findActiveAtLeast24HoursAgo() {
        $db = Session::getDb();

        return $db->createCommand("
                SELECT
                    expire,
                       data,
                       user.username,
                    FROM_UNIXTIME(last_write,'%d-%m-%Y %h:%i:%s') AS last_write
                FROM session
                    LEFT JOIN user ON session.user_id = user.id
                WHERE last_write - 86400 < :now
            ", [':now' => time()])
            ->queryAll();
    }

    public function behaviors() {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules() {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
}
