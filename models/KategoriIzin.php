<?php

namespace app\models;

use Yii;
use \app\models\base\KategoriIzin as BaseKategoriIzin;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "kategori_izin".
 */
class KategoriIzin extends BaseKategoriIzin
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
