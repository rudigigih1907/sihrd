<?php

namespace app\models\activequery;

/**
 * This is the ActiveQuery class for [[\app\models\AlamatKaryawan]].
 *
 * @see \app\models\AlamatKaryawan
 */
class AlamatKaryawanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\AlamatKaryawan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\AlamatKaryawan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
