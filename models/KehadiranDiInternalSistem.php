<?php

namespace app\models;

use app\models\base\KehadiranDiInternalSistem as BaseKehadiranDiInternalSistem;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "kehadiran_di_internal_sistem".
 */
class KehadiranDiInternalSistem extends BaseKehadiranDiInternalSistem {


    const SCENARIO_INPUT_KEHADIRAN_MASUK = 'input-kehadiran-masuk';

    public $readonlyJadwalKerja;
    public $readonlyJadwalKerjaHari;
    public $readonlyJamKerja;
    public $readonlyKetentuanMasuk;
    public $readonlyKetentuanPulang;
    public $readonlyKaryawan;

    /**
     * @param $tanggal
     * @return array
     * @throws InvalidConfigException
     * @throws Exception
     */
    public static function findUntukImportKehadiranMasuk($tanggal) {

        $sql = <<<SQL
SELECT

       g_jadwal.jadwal_kerja_id                                                    AS jadwal_kerja_id,
       g_jadwal.nama_jadwal_kerja                                                  AS nama_jadwal_kerja,
       g_jadwal.kode_jadwal_kerja                                                  AS kode_jadwal_kerja,

       g_jadwal.jadwal_kerja_hari_id                                               AS jadwal_kerja_hari_id,
       g_jadwal.nama_hari_kerja                                                    AS nama_hari_kerja,

       g_jadwal.jam_kerja_id                                                       AS jam_kerja_id,
       g_jadwal.nama_jam_kerja                                                     AS nama_jam_kerja,
       g_jadwal.kode_jam_kerja                                                     AS kode_jam_kerja,
       
       CONCAT(:tanggal, ' ',g_jadwal.masuk_jam_kerja) AS unformated_ketentuan_masuk,
       CONCAT(:tanggal, ' ',g_jadwal.pulang_jam_kerja) AS unformated_ketentuan_pulang,
       DATE_FORMAT((CONCAT(:tanggal, ' ',TIME_FORMAT(g_jadwal.masuk_jam_kerja ,'%H:%i'))),'%d-%m-%Y %H:%i')  AS ketentuan_masuk,
       DATE_FORMAT((CONCAT(:tanggal, ' ',TIME_FORMAT(g_jadwal.pulang_jam_kerja ,'%H:%i'))),'%d-%m-%Y %H:%i') AS ketentuan_pulang,
       
       g_karyawan.id                                                               AS karyawan_id,
       g_karyawan.nama                                                             AS nama_karyawan,
       g_karyawan.nik                                                              AS nik,
       DATE_FORMAT(g_karyawan.masuk, '%d-%m-%Y %H:%i')                             AS aktual_masuk,
       g_karyawan.pulang                                                           AS aktual_pulang

FROM (
         SELECT k.jadwal_kerja_id                AS jadwal_kerja_karyawan,
                k.id,
                k.nama,
                k.nomor_induk_karyawan           AS nik,
                GROUP_CONCAT(DISTINCT so.nama)   AS jabatan,
                MIN(absensi_harian.tanggal_scan) AS masuk,
                MAX(absensi_harian.tanggal_scan) AS pulang,
                TIMESTAMPDIFF(MINUTE,
                              MIN(absensi_harian.tanggal_scan),
                              MAX(absensi_harian.tanggal_scan)
                    )                            AS kerja_in_menit,
                TIMESTAMPDIFF(HOUR,
                              MIN(absensi_harian.tanggal_scan),
                              MAX(absensi_harian.tanggal_scan)
                    )                            AS kerja_in_jam

         FROM karyawan AS k
                  LEFT JOIN (SELECT a.karyawan_id, a.tanggal_scan
                             FROM kehadiran_di_mesin_absensi a
                             WHERE DATE(a.tanggal_scan) = :tanggal)
             AS absensi_harian
                            ON k.id = absensi_harian.karyawan_id

                  LEFT JOIN karyawan_struktur_organisasi kso on k.id = kso.karyawan_id
                  LEFT JOIN struktur_organisasi so on kso.struktur_organisasi_id = so.id

         GROUP BY k.id
         ORDER BY k.id
     ) g_karyawan

         LEFT JOIN (
    SELECT jdk.id                  AS jadwal_kerja_id,
           jdk.nama                AS nama_jadwal_kerja,
           jdk.kode                AS kode_jadwal_kerja,

           jkh.id                  AS jadwal_kerja_hari_id,
           jkh.nama                AS nama_hari_kerja,
           jkh.default_libur       AS default_libur,

           jk.id                   AS jam_kerja_id,
           jk.kode                 AS kode_jam_kerja,
           jk.nama                 AS nama_jam_kerja,
           jk.jam_masuk            AS masuk_jam_kerja,
           jk.jam_mulai_istrahat   AS mulai_istirahat,
           jk.jam_selesai_istrahat AS selesai_istirahat,
           jk.jam_pulang           AS pulang_jam_kerja,
           jk.toleransi_terlambat  AS tol_telat


    FROM jadwal_kerja jdk
             LEFT JOIN jadwal_kerja_detail jkd
                       on jdk.id = jkd.jadwal_kerja_id
             LEFT JOIN jadwal_kerja_detail_detail jkdd
                       on jkd.id = jkdd.jadwal_kerja_detail_id

             LEFT JOIN jadwal_kerja_hari jkh on jkd.jadwal_kerja_hari_id = jkh.id
             LEFT JOIN jam_kerja jk on jkdd.jam_kerja_id = jk.id
    WHERE jkh.weekday = (
        SELECT weekday
        FROM jadwal_kerja_hari jkh
        WHERE jkh.weekday = WEEKDAY(:tanggal)
    )
    ORDER BY jdk.id
) AS g_jadwal ON g_jadwal.jadwal_kerja_id = g_karyawan.jadwal_kerja_karyawan

ORDER BY jadwal_kerja_id, nama_karyawan
;
SQL;

        return self::getDb()->createCommand($sql, [
                ':tanggal' => Yii::$app->formatter->asDate($tanggal, "php:Y-m-d")]
        )->queryAll();
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
                [['readonlyJadwalKerja',
                    'readonlyJadwalKerjaHari',
                    'readonlyJamKerja',
                    'readonlyKetentuanMasuk',
                    'readonlyKetentuanPulang',
                    'readonlyKaryawan',
                ], 'safe'],
                ['aktual_masuk', 'required', 'on' => self::SCENARIO_INPUT_KEHADIRAN_MASUK]

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

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_INPUT_KEHADIRAN_MASUK] = [
            'jadwal_kerja_id',
            'jadwal_kerja_hari_id',
            'jam_kerja_id',
            'ketentuan_masuk',
            'ketentuan_pulang',
            'karyawan_id',
            'aktual_masuk',
            'readonlyJadwalKerja',
            'readonlyJadwalKerjaHari',
            'readonlyJamKerja',
            'readonlyKetentuanMasuk',
            'readonlyKetentuanPulang',
            'readonlyKaryawan',
        ];
        return $scenarios;
    }
}
