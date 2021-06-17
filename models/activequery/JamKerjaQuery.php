<?php

namespace app\models\activequery;

/**
 * This is the ActiveQuery class for [[\app\models\JamKerja]].
 *
 * @see \app\models\JamKerja
 */
class JamKerjaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\JamKerja[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\JamKerja|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
