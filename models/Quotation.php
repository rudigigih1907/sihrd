<?php

namespace app\models;

use Yii;
use \app\models\base\Quotation as BaseQuotation;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "quotation".
 */
class Quotation extends BaseQuotation
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
