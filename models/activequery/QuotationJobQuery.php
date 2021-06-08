<?php

namespace app\models\activequery;

/**
 * This is the ActiveQuery class for [[\app\models\QuotationJob]].
 *
 * @see \app\models\QuotationJob
 */
class QuotationJobQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\QuotationJob[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\QuotationJob|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
