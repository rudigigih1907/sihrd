<?php

namespace app\models;

use Yii;
use \app\models\base\Card as BaseCard;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "card".
 */
class Card extends BaseCard
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
