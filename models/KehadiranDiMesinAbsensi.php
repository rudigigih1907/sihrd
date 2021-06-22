<?php

namespace app\models;

use Yii;
use \app\models\base\KehadiranDiMesinAbsensi as BaseAbsensi;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "kehadiran-di-mesin-absensi".
 */
class KehadiranDiMesinAbsensi extends BaseAbsensi
{

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
}
