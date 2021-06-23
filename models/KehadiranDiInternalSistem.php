<?php

namespace app\models;

use app\models\base\KehadiranDiInternalSistem as BaseKehadiranDiInternalSistem;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "kehadiran_di_internal_sistem".
 */
class KehadiranDiInternalSistem extends BaseKehadiranDiInternalSistem {

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

    public function attributeLabels() {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                'id' => 'ID',
                'jadwal_kerja_id' => 'Jadwal Kerja',
                'jadwal_kerja_hari_id' => 'Hari',
                'jam_kerja_id' => 'Jam Kerja',
                'ketentuan_masuk' => 'Ketentuan Masuk',
                'ketentuan_pulang' => 'Ketentuan Pulang',
                'karyawan_id' => 'Karyawan',
                'aktual_masuk' => 'Aktual Masuk',
                'aktual_pulang' => 'Aktual Pulang',
                'jenis_izin_id' => 'Jenis Izin',
            ]

        );
    }
}
