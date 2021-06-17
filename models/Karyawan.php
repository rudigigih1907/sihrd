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

    /**
     * column Status Aktif Karyawan ENUM value labels
     * @return array
     */
    public static function optsStatusAktif()
    {
        return [
            self::AKTIF => 'Aktif',
            self::TIDAK_AKTIF => 'Tidak Aktif',
            self::SEMUA => 'Semua',
        ];
    }

    /**
     * @param $statusAktif
     * @return Karyawan[]|array
     */
    public static function findAllDenganStatusKeaktifannya($statusAktif) {
        $data =  self::find()
            ->select("
                id AS PIN,
                nama,
                nomor_induk_karyawan AS NIP
            ")
        ;

        switch ($statusAktif):
            case self::TIDAK_AKTIF:
                $data->where([
                    "IS NOT", 'tanggal_berhenti_bekerja', NULL
                ]);
                break;
            case self::AKTIF:
                $data->where([
                    "IS", 'tanggal_berhenti_bekerja', NULL
                ]);
                break;
            default:
                break;
        endswitch;

        return $data->asArray()->all();
    }

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
