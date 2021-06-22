<?php

namespace app\models;

use app\traits\TraitMapIDToNama;
use Yii;
use \app\models\base\BatalPtkp as BaseBatalPtkp;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "batal_ptkp".
 */
class BatalPtkp extends BaseBatalPtkp
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
