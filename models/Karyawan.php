<?php

namespace app\models;

use Yii;
use \app\models\base\Karyawan as BaseKaryawan;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "karyawan".
 */
class Karyawan extends BaseKaryawan
{

    const AKTIF = 'AKTIF';
    const TIDAK_AKTIF = 'TIDAK AKTIF';
    const SEMUA = 'SEMUA';

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
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

                'nomor_induk_karyawan' => 'N.I.K',
                'nomor_kartu_tanda_penduduk' => 'Nomor KTP',
                'nomor_kartu_keluarga' => 'Nomor KK',
                'nomor_pokok_wajib_pajak' => 'NPWP',
                'nomor_kitas_atau_sejenisnya' => 'Nomor Kitas Atau Sejenisnya',
                'jenis_kelamin' => 'Jenis Kelamin',
                'agama_id' => 'Agama',
                'status_perkawinan_id' => 'Status Perkawinan',
            ]
        );
    }


    /**
     * @return int|string
     */
    public function getCountKaryawanStrukturOrganisasis()
    {
        return $this->hasMany(\app\models\KaryawanStrukturOrganisasi::className(), ['karyawan_id' => 'id'])
            ->count();
    }

}
