<?php

namespace app\models\activequery;

/**
 * This is the ActiveQuery class for [[\app\models\CutiNormatif]].
 *
 * @see \app\models\CutiNormatif
 */
class CutiNormatifQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\CutiNormatif[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\CutiNormatif|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
