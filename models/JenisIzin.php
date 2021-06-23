<?php

namespace app\models;

use app\traits\TraitMapIDToNama;
use Yii;
use \app\models\base\JenisIzin as BaseJenisIzin;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jenis_izin".
 */
class JenisIzin extends BaseJenisIzin
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
