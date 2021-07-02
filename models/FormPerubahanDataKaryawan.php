<?php

namespace app\models;

use Yii;
use \app\models\base\FormPerubahanDataKaryawan as BaseFormPerubahanDataKaryawan;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "form_perubahan_data_karyawan".
 */
class FormPerubahanDataKaryawan extends BaseFormPerubahanDataKaryawan
{

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
                [
                    'class' => 'mdm\autonumber\Behavior',
                    'attribute' => 'nomor_referensi', // required
                    'value' => 'AJU.'.date('d-m-Y').'.?' , // format auto number. '?' will be replaced with generated number
                    'digit' => 4 // optional, default to null.
                ],
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
