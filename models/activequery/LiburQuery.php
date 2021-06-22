<?php

namespace app\models\activequery;

/**
 * This is the ActiveQuery class for [[\app\models\Libur]].
 *
 * @see \app\models\Libur
 */
class LiburQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Libur[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Libur|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
