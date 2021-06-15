<?php

namespace app\models\activequery;

/**
 * This is the ActiveQuery class for [[\app\models\StrukturOrganisasi]].
 *
 * @see \app\models\StrukturOrganisasi
 */
class StrukturOrganisasiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\StrukturOrganisasi[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\StrukturOrganisasi|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
