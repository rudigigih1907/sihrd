<?php

namespace app\models;

use app\models\base\JadwalKerjaDetail as BaseJadwalKerjaDetail;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jadwal_kerja_detail".
 */
class JadwalKerjaDetail extends BaseJadwalKerjaDetail {

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

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => 'ID',
            'jadwal_kerja_id' => 'Jadwal Kerja',
            'jadwal_kerja_hari_id' => 'Hari',
            'libur' => 'Libur',
            'jam_kerja_id' => 'Jam Kerja',
        ]);
    }

    public function getJamKerjaAsAList() {

        $data = array_map(function ($detail) {
            return isset($detail->jamKerja)
                ? $detail->jamKerja->nama . ", " . $detail->jamKerja->jam_masuk . " => " . $detail->jamKerja->jam_pulang
                : null;

        }, $this->jadwalKerjaDetailDetails);

        return array_filter($data);
    }
}
