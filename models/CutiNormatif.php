<?php

namespace app\models;

use app\traits\TraitMapIDToNama;
use Yii;
use \app\models\base\CutiNormatif as BaseCutiNormatif;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cuti_normatif".
 */
class CutiNormatif extends BaseCutiNormatif
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
