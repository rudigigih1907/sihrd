<?php

namespace app\models;

use Yii;
use \app\models\base\QuotationJobDetail as BaseQuotationJobDetail;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "quotation_job_detail".
 */
class QuotationJobDetail extends BaseQuotationJobDetail
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
