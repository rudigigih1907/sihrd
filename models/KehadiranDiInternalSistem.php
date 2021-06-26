<?php

namespace app\models;

use app\models\base\KehadiranDiInternalSistem as BaseKehadiranDiInternalSistem;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\db\Expression;
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
     * Mencari data dari table kehadiran_di_mesin_absensi untuk jam masuk
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
       (SELECT(:tanggal))                                                            AS tanggal,
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
                MIN(absensi_harian.tanggal_scan) AS masuk,
                MAX(absensi_harian.tanggal_scan) AS pulang
                # TIMESTAMPDIFF(MINUTE, MIN(absensi_harian.tanggal_scan), MAX(absensi_harian.tanggal_scan) )                            AS kerja_in_menit,
                # TIMESTAMPDIFF(HOUR, MIN(absensi_harian.tanggal_scan), MAX(absensi_harian.tanggal_scan) )                            AS kerja_in_jam

         FROM karyawan AS k
                  LEFT JOIN (SELECT a.karyawan_id, a.tanggal_scan
                             FROM kehadiran_di_mesin_absensi a
                             WHERE DATE(a.tanggal_scan) = :tanggal)
             AS absensi_harian
                            ON k.id = absensi_harian.karyawan_id


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

    /**
     * @param $tanggal
     * @return array
     * @throws Exception
     * @throws InvalidConfigException
     */
    public static function findUntukImportKehadiranPulang($tanggal) {

        $sql =<<<SQL
            SELECT
                   k.id AS karyawan_id,
                   MIN(DATE(tanggal_scan))          AS tanggal_scan,
                   k.nama,
                   k.nomor_induk_karyawan           as nik,
                   MIN(absensi_harian.tanggal_scan) AS aktual_masuk,
                   MAX(absensi_harian.tanggal_scan) AS aktual_pulang
            
            FROM karyawan AS k
                     LEFT JOIN (SELECT a.karyawan_id, a.tanggal_scan
                                FROM kehadiran_di_mesin_absensi a
                                WHERE DATE(a.tanggal_scan) = :tanggal)
                AS absensi_harian
                               ON k.id = absensi_harian.karyawan_id
            GROUP BY k.id
            ORDER BY k.id
SQL;

        return self::getDb()->createCommand($sql, [
                ':tanggal' => Yii::$app->formatter->asDate($tanggal, "php:Y-m-d")]
        )->queryAll();

    }

    /**
     * Mencari data untuk laporan harian menggunakan Raw SQL
     * @param $tanggal
     * @return array
     * @throws Exception
     */
    public static function findUntukLaporanHarianRawSql($tanggal) {

        $sql = <<<SQL
        SELECT karyawan.nama                                               AS nama,
               karyawan.nomor_induk_karyawan                               AS nik,
               GROUP_CONCAT(struktur_organisasi.path)                      AS menjabat,
               GROUP_CONCAT(struktur_organisasi.kode_path)                 AS kode_menjabat,
               ketentuan_masuk,
               ketentuan_pulang,
               aktual_masuk,
               aktual_pulang,
               TIME_FORMAT(TIMEDIFF(aktual_pulang, aktual_masuk), '%H:%i') AS lama_waktu_bekerja,
               CASE
                   WHEN aktual_masuk IS NULL THEN 'Belum Ada Kabar'
                   WHEN (aktual_masuk > ketentuan_masuk) THEN 'Terlambat'
                   ELSE 'Sesuai' END                                       AS status_masuk_kerja,
               jenis_izin.nama                                             AS jenis_izin,
               cuti_normatif.nama                                          AS cuti_normatif,
               CASE
                   WHEN aktual_pulang IS NULL THEN 'Tidak hadir karena tidak ada absen pulang'
                   ELSE 'Hadir, Sesuai Aturan' END                         AS status_kehadiran,
               keterangan
        FROM kehadiran_di_internal_sistem
                 LEFT JOIN karyawan ON kehadiran_di_internal_sistem.karyawan_id = karyawan.id
                 LEFT JOIN karyawan_struktur_organisasi ON karyawan.id = karyawan_struktur_organisasi.karyawan_id
                 # LEFT JOIN struktur_organisasi ON karyawan_struktur_organisasi.struktur_organisasi_id = struktur_organisasi.id
                 
                LEFT JOIN (
                     
                    WITH RECURSIVE reporting_chain(id, nama, path, kode_path) AS (
                        SELECT id, nama, nama, CAST(kode AS CHAR(100000))
                        FROM struktur_organisasi
                        WHERE parent_id IS NULL
                        UNION ALL
                        SELECT oc.id, oc.nama, CONCAT(rc.path, '->', oc.nama), CONCAT(rc.kode_path, '->', oc.kode)
                        FROM reporting_chain rc
                                 JOIN struktur_organisasi oc ON rc.id = oc.parent_id)
                    SELECT *
                    FROM reporting_chain
                     
                 ) AS struktur_organisasi
                           ON karyawan_struktur_organisasi.struktur_organisasi_id = struktur_organisasi.id
                 LEFT JOIN jenis_izin ON kehadiran_di_internal_sistem.jenis_izin_id = jenis_izin.id
                 LEFT JOIN cuti_normatif ON kehadiran_di_internal_sistem.cuti_normatif_id = cuti_normatif.id
        WHERE DATE(ketentuan_masuk) = :tanggal
        GROUP BY kehadiran_di_internal_sistem.id
SQL;
        return self::getDb()->createCommand($sql, [':tanggal' => $tanggal])->queryAll();

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
                'cuti_normatif_id' => 'Cuti Normatif',
            ]

        );
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_INPUT_KEHADIRAN_MASUK] = [
            'jadwal_kerja_id',
            'jadwal_kerja_hari_id',
            'jam_kerja_id',
            'tanggal',
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

    /**
     * @return yii\db\ActiveQuery
     */
    public function getKaryawanStrukturOrganisasis() {
        return $this->hasMany(\app\models\KaryawanStrukturOrganisasi::className(), ['karyawan_id' => 'id'])->via(
            'karyawan'
        );
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getStrukturOrganisasi() {
        return $this->hasOne(\app\models\StrukturOrganisasi::className(), ['id' => 'struktur_organisasi_id'])
            ->via('karyawanStrukturOrganisasis');
    }

}
