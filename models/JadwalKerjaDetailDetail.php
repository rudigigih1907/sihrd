<?php

namespace app\models;

use Yii;
use \app\models\base\JadwalKerjaDetailDetail as BaseJadwalKerjaDetailDetail;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jadwal_kerja_detail_detail".
 */
class JadwalKerjaDetailDetail extends BaseJadwalKerjaDetailDetail
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
