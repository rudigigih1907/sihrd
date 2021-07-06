<?php

namespace app\models\activequery;

/**
 * This is the ActiveQuery class for [[\app\models\AturanUangKehadiran]].
 *
 * @see \app\models\AturanUangKehadiran
 */
class AturanUangKehadiranQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\AturanUangKehadiran[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\AturanUangKehadiran|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
