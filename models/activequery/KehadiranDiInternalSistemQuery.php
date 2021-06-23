<?php

namespace app\models\activequery;

/**
 * This is the ActiveQuery class for [[\app\models\KehadiranDiInternalSistem]].
 *
 * @see \app\models\KehadiranDiInternalSistem
 */
class KehadiranDiInternalSistemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\KehadiranDiInternalSistem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\KehadiranDiInternalSistem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
