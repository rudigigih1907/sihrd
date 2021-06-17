<?php

namespace app\models;

use app\traits\TraitMapIDToNama;
use Yii;
use \app\models\base\JadwalKerjaHari as BaseJadwalKerjaHari;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jadwal_kerja_hari".
 */
class JadwalKerjaHari extends BaseJadwalKerjaHari
{

    use TraitMapIDToNama;

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
