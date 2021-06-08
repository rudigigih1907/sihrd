<?php

namespace app\models\activequery;

/**
 * This is the ActiveQuery class for [[\app\models\QuotationJobDetail]].
 *
 * @see \app\models\QuotationJobDetail
 */
class QuotationJobDetailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\QuotationJobDetail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\QuotationJobDetail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
