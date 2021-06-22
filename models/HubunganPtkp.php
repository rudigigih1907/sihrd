<?php

namespace app\models;

use app\traits\TraitMapIDToNama;
use Yii;
use \app\models\base\HubunganPtkp as BaseHubunganPtkp;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "hubungan_ptkp".
 */
class HubunganPtkp extends BaseHubunganPtkp
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
