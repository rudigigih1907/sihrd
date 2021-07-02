<?php

namespace app\models;

use Yii;
use \app\models\base\FormPerubahanDataKaryawanDetail as BaseFormPerubahanDataKaryawanDetail;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "form_perubahan_data_karyawan_detail".
 */
class FormPerubahanDataKaryawanDetail extends BaseFormPerubahanDataKaryawanDetail
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
