<?php

namespace app\models;

use app\models\base\JamKerja as BaseJamKerja;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jam_kerja".
 */
class JamKerja extends BaseJamKerja {


    public static function mapIDToNama() {
        return ArrayHelper::map(self::find()
            ->select("id, kode, jam_masuk, jam_pulang")
            ->orderBy('kode')
            ->all(), 'id', function ($el) {
            return $el['kode'] . ', ' . $el['jam_masuk'] . ' => ' . $el['jam_pulang'];
        });

    }

    public static function mapIDToNamaTanpaInformasiTambahan() {
        return ArrayHelper::map(self::find()
            ->select("id, kode")
            ->orderBy('kode')
            ->all(), 'id', 'kode');
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

    public function attributeLabels() {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => 'ID',
            'nama' => 'Nama',
            'kode' => 'Kode',
            'jam_masuk' => 'Masuk',
            'jam_mulai_istrahat' => 'Mulai Istrahat',
            'jam_selesai_istrahat' => 'Selesai Istrahat',
            'jam_pulang' => 'Pulang',
            'durasi' => 'Durasi',
            'dihitung' => 'Dihitung',
            'toleransi_terlambat' => 'Toleransi Terlambat',
        ]);
    }
}
