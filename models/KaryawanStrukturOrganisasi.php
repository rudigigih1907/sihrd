<?php

namespace app\models;

use app\models\base\KaryawanStrukturOrganisasi as BaseKaryawanStrukturOrganisasi;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "karyawan_struktur_organisasi".
 */
class KaryawanStrukturOrganisasi extends BaseKaryawanStrukturOrganisasi {

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
        return ArrayHelper::merge(parent::attributes(),
            [
                'id' => 'ID',
                'karyawan_id' => 'Karyawan',
                'struktur_organisasi_id' => 'Struktur Organisasi',
                'nomor_surat_pengangkatan' => 'No. Surat Pengangkatan',
                'tanggal_aktif' => 'Tanggal Aktif',
                'tanggal_berakhir' => 'Tanggal Berakhir',
                'alasan_berakhir' => 'Alasan Berakhir',
            ]
        );
    }

    public function beforeSave($insert) {

        $this->tanggal_aktif = empty($this->tanggal_aktif) ? NULL :
            Yii::$app->formatter->asDate($this->tanggal_aktif, 'php:Y-m-d');
        $this->tanggal_berakhir = empty($this->tanggal_berakhir) ? NULL :
            Yii::$app->formatter->asDate($this->tanggal_berakhir, 'php:Y-m-d');

        return parent::beforeSave($insert);
    }

    public function afterFind() {
        $this->tanggal_aktif = empty($this->tanggal_aktif) ? NULL :
            Yii::$app->formatter->asDate($this->tanggal_aktif);
        $this->tanggal_berakhir = empty($this->tanggal_berakhir) ? NULL :
            Yii::$app->formatter->asDate($this->tanggal_berakhir);
    }
}
