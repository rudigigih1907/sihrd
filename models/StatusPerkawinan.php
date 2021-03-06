<?php

namespace app\models;

use app\traits\TraitMapIDToNama;
use Yii;
use \app\models\base\StatusPerkawinan as BaseStatusPerkawinan;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "status_perkawinan".
 */
class StatusPerkawinan extends BaseStatusPerkawinan
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
