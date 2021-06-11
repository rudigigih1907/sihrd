<?php

namespace app\models\activequery;

/**
 * This is the ActiveQuery class for [[\app\models\StatusPerkawinan]].
 *
 * @see \app\models\StatusPerkawinan
 */
class StatusPerkawinanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\StatusPerkawinan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\StatusPerkawinan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
