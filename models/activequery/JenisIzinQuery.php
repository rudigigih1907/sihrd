<?php

namespace app\models\activequery;

/**
 * This is the ActiveQuery class for [[\app\models\JenisIzin]].
 *
 * @see \app\models\JenisIzin
 */
class JenisIzinQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\JenisIzin[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\JenisIzin|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
