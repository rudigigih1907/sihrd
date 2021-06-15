<?php

namespace app\models\activequery;

/**
 * This is the ActiveQuery class for [[\app\models\KaryawanStrukturOrganisasi]].
 *
 * @see \app\models\KaryawanStrukturOrganisasi
 */
class KaryawanStrukturOrganisasiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\KaryawanStrukturOrganisasi[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\KaryawanStrukturOrganisasi|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
