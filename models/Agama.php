<?php

namespace app\models;

use app\traits\TraitMapIDToNama;
use Yii;
use \app\models\base\Agama as BaseAgama;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "agama".
 */
class Agama extends BaseAgama
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
