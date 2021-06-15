<?php

namespace app\models;

use app\models\base\StrukturOrganisasi as BaseStrukturOrganisasi;
use app\traits\TraitMapIDToNama;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "struktur_organisasi".
 */
class StrukturOrganisasi extends BaseStrukturOrganisasi {

    use TraitMapIDToNama;

    /**
     * Menggenerate tree
     * @param $id
     * @return array
     * @throws \yii\db\Exception
     */

    public static function generateTree($id = null) {

        return \Yii::$app->db->createCommand("
            WITH RECURSIVE diagram_struktur_organisasi(id, parent_id, tipe, nama, alias, kode, lvl) AS (
                SELECT id,
                       parent_id,
                       tipe,
                       nama,
                       alias,
                       kode,
                       0 lvl
                FROM struktur_organisasi so
                WHERE so.id = :id
                UNION ALL
                SELECT so2.id,
                       so2.parent_id,
                       so2.tipe,
                       so2.nama,
                       so2.alias,
                       so2.kode,
                       (dso.lvl + 1) AS lvl
                FROM diagram_struktur_organisasi AS dso
                         JOIN struktur_organisasi AS so2
                              ON dso.id = so2.parent_id
            )
            
            SELECT * FROM diagram_struktur_organisasi;
            
        ", [':id' => $id])->queryAll();
    }

    public static function mapIDToNamaKhususJabatanSaja() {
        return ArrayHelper::map(self::find()
            ->select([
                'id',
                'nama' => 'CONCAT(kode, " = ", nama)'
            ])
            ->where([
                'tipe' => self::TIPE_JABATAN
            ])
            ->asArray()->all(), 'id', 'nama');
    }

    public function behaviors() {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules() {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
}
