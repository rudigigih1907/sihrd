<?php

namespace app\models;

use app\models\base\Karyawan as BaseKaryawan;
use app\traits\TraitMapIDToNama;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 *
 * @property string $statusAktifKaryawan
 * This is the model class for table "karyawan".
 */
class Karyawan extends BaseKaryawan {

    const AKTIF = 'AKTIF';
    const TIDAK_AKTIF = 'TIDAK AKTIF';
    const SEMUA = 'SEMUA';

    use TraitMapIDToNama;

    public static function mapIDToKodeKaryawanDenganNama() {
        return ArrayHelper::map(self::find()
            ->select("id, nama, nomor_induk_karyawan ")
            ->orderBy('nomor_induk_karyawan')
            ->all(), 'id', function($model){
            return $model['nomor_induk_karyawan'] . ' - ' . $model['nama'];
        });
    }

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

    public static function findDataUntukMesinAbsensi($statusAktif) {

        $pin = new Expression(" REGEXP_REPLACE(k.nomor_induk_karyawan, '[^0-9a-zA-Z ]', '') AS pin");
        $tanggalLahir = new Expression("DATE_FORMAT(k.tanggal_lahir, '%d-%m-%Y') AS tanggal_lahir");
        $tanggalMulaiBekerja = new Expression("DATE_FORMAT(k.tanggal_mulai_bekerja, '%d-%m-%Y') AS tanggal_mulai_bekerja");

        $pembagian1 = new Expression("NULL AS pembagian_1");
        $pembagian2 = new Expression("NULL AS pembagian_2");
        $pembagian3 = new Expression("NULL AS pembagian_3");

        $query = (new \yii\db\Query())
            ->select($pin)
            ->addSelect("
                k.nomor_induk_karyawan                           AS nip,
                UPPER(k.nama)                                    AS nama,
                k.nama_panggilan                                 AS alias,
                GROUP_CONCAT(DISTINCT ak.nomor_telepon)          AS nomor_telepon,
             "
            )
            ->addSelect("k.tempat_lahir AS tempat_lahir")
            ->addSelect($tanggalLahir)
            ->addSelect($pembagian1)
            ->addSelect($pembagian2)
            ->addSelect($pembagian3)
            ->addSelect("
                jk.nama                                         AS jadwal_kerja,
                mesin_absensi_password                          AS password,
                mesin_absensi_rfid                              AS rfid,
                mesin_absensi_previlege                         AS privilege,
            ")
            ->addSelect($tanggalMulaiBekerja)
            ->from('hrd.karyawan k')
            ->join("LEFT JOIN", "hrd.alamat_karyawan ak", "k.id = ak.karyawan_id")
            ->join("LEFT JOIN", "hrd.jadwal_kerja AS jk", "k.jadwal_kerja_id = jk.id")
            ;

        switch ($statusAktif):
            case self::AKTIF:
                $query->where([
                    'IS', 'tanggal_berhenti_bekerja', NULL
                ]);
                break;
            case self::TIDAK_AKTIF:
                $query->where([
                    'IS NOT', 'tanggal_berhenti_bekerja', NULL
                ]);
                break;
            default:
                break;

        endswitch;

        return $query
            ->orderBy('hrd.k.nama')
            ->groupBy('hrd.k.id')
            ->all();


    }

    public static function findDataUntukBiodataSeluruhKaryawan($statusAktif) {

        $query = (new \yii\db\Query())
            ->select("k.*, agama.nama as agama, jk.nama as jadwal_bekerja")
            ->leftJoin('hrd.agama', 'agama.id = k.agama_id',)
            ->leftJoin('hrd.jadwal_kerja jk', 'jk.id = k.jadwal_kerja_id',)
            ->from('hrd.karyawan k')
        ;

        switch ($statusAktif):
            case self::AKTIF:
                $query->where([
                    'IS', 'tanggal_berhenti_bekerja', NULL
                ]);
                break;
            case self::TIDAK_AKTIF:
                $query->where([
                    'IS NOT', 'tanggal_berhenti_bekerja', NULL
                ]);
                break;
            default:
                break;

        endswitch;

        return $query
            ->indexBy('id')
            ->orderBy('hrd.k.nama')
            ->groupBy('hrd.k.id')
            ->all();
    }

    public static function findDataUntukBiodataSeluruhKaryawanByActiveRecord($statusAktif) {

        $query = self::find()
            ->joinWith('agama')
            ->joinWith('alamatKaryawans')
            ->joinWith(['karyawanPtkps' => function($kp){
                $kp->joinWith('hubunganPtkp');
                $kp->joinWith('batalPtkp');
            }])
            ->joinWith(['karyawanStrukturOrganisasis' => function ($kso) {
                /** @var KaryawanStrukturOrganisasi $kso */
                $kso->joinWith('strukturOrganisasi');
            }])
            ->joinWith('jadwalKerja');

        switch ($statusAktif):
            case self::AKTIF:
                $query->where([
                    'IS', 'tanggal_berhenti_bekerja', NULL
                ]);
                break;
            case self::TIDAK_AKTIF:
                $query->where([
                    'IS NOT', 'tanggal_berhenti_bekerja', NULL
                ]);
                break;
            default:
                break;

        endswitch;

        return
            $query
                ->orderBy('nama')
                ->asArray()
                ->all();
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
                'jadwal_kerja_id' => 'Jdw Kerja',
                'tempat_lahir' => 'Tempat Lahir',
                'tanggal_lahir' => 'Tgl Lahir',
                'pengecualian_terlambat_karena_lembur_pada_hari_sebelumnya'
                    => 'Pengecualian Terlambat Karena Lembur'
            ]
        );
    }

    /**
     * @return int|string
     */
    public function getCountKaryawanStrukturOrganisasis() {
        return $this->hasMany(\app\models\KaryawanStrukturOrganisasi::className(), ['karyawan_id' => 'id'])
            ->count();
    }

    public function getStatusAktifKaryawan() {
        return !$this->tanggal_berhenti_bekerja ? self::AKTIF : self::TIDAK_AKTIF;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStrukturOrganisasi() {
        return $this->hasOne(\app\models\StrukturOrganisasi::className(), ['id' => 'struktur_organisasi_id'])
            ->via('karyawanStrukturOrganisasis');
    }

}
