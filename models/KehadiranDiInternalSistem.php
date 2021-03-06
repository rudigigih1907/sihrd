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

    const STATUS_MASUK_KERJA = 'Sesuai';
    const STATUS_TIDAK_MASUK_KERJA = 'Tidak Masuk Kerja';
    const STATUS_TERLAMBAT= 'Terlambat';
    const STATUS_BELUM_ADA_KABAR= 'Belum Ada Kabar';
    const STATUS_CUTI= 'Cuti';
    const STATUS_IZIN_TIDAK_MASUK =  'Izin Tidak Masuk';

    const STATUS_KEHADIRAN_MASUK_KERJA = 'Hadir';
    const STATUS_TIDAK_HADIR_KERJA = 'Tidak Hadir';
    const STATUS_MASUK_KERJA_TAPI_TIDAK_ABSEN_PULANG = 'Tidak Hadir, Tidak Ada Absen Pulang';
    const LAPORAN_PAGI_NOT_GROUPING = "PAGI_NOT_GROUPING";
    const LAPORAN_PAGI_GROUPING_BY_JADWAL_KERJA = "PAGI_GROUPING_BY_JADWAL_KERJA";
    const LAPORAN_PER_HARI_NOT_GROUPING = "HARIAN_NOT_GROUPING";
    const LAPORAN_HARIAN_GROUPING_BY_JADWAL_KERJA = 'HARIAN_GROUPING_BY_JADWAL_KERJA' ;


    public $readonlyJadwalKerja;
    public $readonlyJadwalKerjaHari;
    public $readonlyJamKerja;
    public $readonlyKetentuanMasuk;
    public $readonlyKetentuanPulang;
    public $readonlyKaryawan;
    public $readonlyAktualMasuk;

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

       g_jadwal.jadwal_kerja_id                                                                                                  AS jadwal_kerja_id,
       g_jadwal.nama_jadwal_kerja                                                                                                AS nama_jadwal_kerja,
       g_jadwal.kode_jadwal_kerja                                                                                                AS kode_jadwal_kerja,

       g_jadwal.jadwal_kerja_hari_id                                                                                             AS jadwal_kerja_hari_id,
       g_jadwal.nama_hari_kerja                                                                                                  AS nama_hari_kerja,

       g_jadwal.jam_kerja_id                                                                                                     AS jam_kerja_id,
       g_jadwal.nama_jam_kerja                                                                                                   AS nama_jam_kerja,
       g_jadwal.kode_jam_kerja                                                                                                   AS kode_jam_kerja,
       (SELECT(:tanggal))                                                                                                        AS tanggal,
       
       CONCAT(:tanggal, ' ',g_jadwal.masuk_jam_kerja)                                                                            AS unformated_ketentuan_masuk,
       IF(g_jadwal.pindah_hari > 0,
          DATE_ADD(CONCAT(:tanggal, ' ', g_jadwal.pulang_jam_kerja), INTERVAL 1 DAY),
          CONCAT(:tanggal, ' ', g_jadwal.pulang_jam_kerja)
       )                                                                                                                         AS unformated_ketentuan_pulang,
       
       DATE_FORMAT((CONCAT(:tanggal, ' ',TIME_FORMAT(g_jadwal.masuk_jam_kerja ,'%H:%i'))),'%d-%m-%Y %H:%i')  AS ketentuan_masuk,
       IF(g_jadwal.pindah_hari > 0,
          DATE_FORMAT(DATE_ADD((CONCAT(:tanggal, ' ', TIME_FORMAT(g_jadwal.pulang_jam_kerja, '%H:%i'))), INTERVAL 1
                               DAY), '%d-%m-%Y %H:%i'),
          DATE_FORMAT((CONCAT(:tanggal, ' ', TIME_FORMAT(g_jadwal.pulang_jam_kerja, '%H:%i'))),
                      '%d-%m-%Y %H:%i')
           )                                                                                                                     AS ketentuan_pulang,
       
       g_karyawan.id                                                                                                             AS karyawan_id,
       g_karyawan.nama                                                                                                           AS nama_karyawan,
       g_karyawan.nik                                                                                                            AS nik,
       g_karyawan.masuk                                                                                                          AS unformated_aktual_masuk,
       DATE_FORMAT(g_karyawan.masuk, '%d-%m-%Y %H:%i')                                                                           AS aktual_masuk,
       g_karyawan.pulang                                                                                                         AS aktual_pulang,
       g_karyawan.pengecualian_terlambat_karena_lembur_pada_hari_sebelumnya                                                      AS pengecualian_terlambat_karena_lembur_pada_hari_sebelumnya

FROM (
         SELECT k.jadwal_kerja_id                AS jadwal_kerja_karyawan,
                k.id,
                k.nama,
                k.nomor_induk_karyawan           AS nik,
                MIN(absensi_harian.tanggal_scan) AS masuk,
                MAX(absensi_harian.tanggal_scan) AS pulang,
                
                pengecualian_terlambat_karena_lembur_pada_hari_sebelumnya
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
           jk.pindah_hari          AS pindah_hari,
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

ORDER BY kode_jadwal_kerja, nama_karyawan, unformated_ketentuan_pulang
;
SQL;

        return self::getDb()->createCommand($sql, [
                ':tanggal' => Yii::$app->formatter->asDate($tanggal, "php:Y-m-d")]
        )->queryAll();
    }

    /**
     * @param $tanggal
     * @param int $pindahHari
     * @return array
     * @throws Exception
     * @throws InvalidConfigException
     * @throws \Exception
     */
    public static function findUntukImportKehadiranPulang($tanggal, $pindahHari) {

        switch ($pindahHari):
            case 0 :
                $sql = <<<SQL
            SELECT k.id                                                     AS karyawan_id,
                   MIN(kehadiran_internal.pindah_hari)                      AS pindah_hari,
                   MIN(DATE(tanggal_scan))                                  AS tanggal_scan,
                   GROUP_CONCAT(DISTINCT k.nama)                            as nama_karyawan,
                   k.nomor_induk_karyawan                                   as nik,
                   jk.kode                                                  AS kode_jadwal_kerja,
                   MIN(kehadiran_mesin.tanggal_scan)                        AS aktual_masuk,
                   MAX(kehadiran_mesin.tanggal_scan)                        AS aktual_pulang,
                   MIN(kehadiran_internal.aktual_masuk)                     AS internal_aktual_masuk,
                   GROUP_CONCAT(DISTINCT kehadiran_internal.nama_jam_kerja) AS nama_jam_kerja,
                   MIN(kehadiran_internal.jam_kerja_id)                     AS jam_kerja
            
            FROM karyawan AS k
            
                     LEFT JOIN jadwal_kerja jk ON k.jadwal_kerja_id = jk.id
                     LEFT JOIN (SELECT a.karyawan_id, a.tanggal_scan
                                FROM kehadiran_di_mesin_absensi a
                                WHERE DATE(a.tanggal_scan) = :tanggal) AS kehadiran_mesin
                               ON k.id = kehadiran_mesin.karyawan_id
                     LEFT JOIN (SELECT kdis.karyawan_id,
                                       kdis.tanggal,
                                       kdis.aktual_masuk,
                                       kdis.aktual_pulang,
                                       kdis.jam_kerja_id,
                                       j.nama as nama_jam_kerja,
                                       j.pindah_hari
                                FROM kehadiran_di_internal_sistem kdis
                                         INNER JOIN jam_kerja j on kdis.jam_kerja_id = j.id
                                WHERE DATE(kdis.tanggal) = :tanggal
            
                               ) AS kehadiran_internal
                               ON k.id = kehadiran_internal.karyawan_id
            
            WHERE kehadiran_internal.pindah_hari = :pindahHari
            
            GROUP BY k.id
            ORDER BY tanggal_scan DESC, nama_karyawan;
SQL;
                break;
            case 1:
                $sql = <<<SQL
                    SELECT k.id                                                                          AS karyawan_id,
                           MIN(kehadiran_internal.pindah_hari)                                           AS pindah_hari,
                           MIN(DATE(tanggal_scan))                                                       AS tanggal_scan,
                           GROUP_CONCAT(DISTINCT k.nama)                                                 as nama_karyawan,
                           k.nomor_induk_karyawan                                                        as nik,
                           jk.kode                                                                       AS kode_jadwal_kerja,
                           MIN(kehadiran_mesin.tanggal_scan)                                             AS aktual_masuk,
                           MIN(kehadiran_mesin_pada_hari_selanjutnya.tanggal_scan_pada_hari_selanjutnya) AS aktual_pulang,
                           MIN(kehadiran_internal.aktual_masuk)                                          AS internal_aktual_masuk,
                           GROUP_CONCAT(DISTINCT kehadiran_internal.nama_jam_kerja)                      AS nama_jam_kerja,
                           MIN(kehadiran_internal.jam_kerja_id)                                          AS jam_kerja
                    
                    FROM karyawan AS k
                    
                             LEFT JOIN jadwal_kerja jk ON k.jadwal_kerja_id = jk.id
                             LEFT JOIN (SELECT a.karyawan_id, a.tanggal_scan
                                        FROM kehadiran_di_mesin_absensi a
                                        WHERE DATE(a.tanggal_scan) = :tanggal) AS kehadiran_mesin
                                       ON k.id = kehadiran_mesin.karyawan_id
                             LEFT JOIN (SELECT a.karyawan_id, a.tanggal_scan AS tanggal_scan_pada_hari_selanjutnya
                                        FROM kehadiran_di_mesin_absensi a
                                        WHERE DATE(a.tanggal_scan) = DATE_ADD(:tanggal, INTERVAL 1 DAY) ) AS kehadiran_mesin_pada_hari_selanjutnya
                                       ON k.id = kehadiran_mesin_pada_hari_selanjutnya.karyawan_id
                             LEFT JOIN (SELECT kdis.karyawan_id,
                                               kdis.tanggal,
                                               kdis.aktual_masuk,
                                               kdis.aktual_pulang,
                                               kdis.jam_kerja_id,
                                               j.nama as nama_jam_kerja,
                                               j.pindah_hari
                                        FROM kehadiran_di_internal_sistem kdis
                                                 INNER JOIN jam_kerja j on kdis.jam_kerja_id = j.id
                                        WHERE DATE(kdis.tanggal) = :tanggal
                    ) AS kehadiran_internal
                                       ON k.id = kehadiran_internal.karyawan_id
                    
                    WHERE kehadiran_internal.pindah_hari = 1
                    
                    GROUP BY k.id
                    ORDER BY tanggal_scan DESC, nama_karyawan
SQL;
                break;
            default:
                throw new \Exception('Selisih hari tidak didukung');
                break;
            endswitch;

        return self::getDb()->createCommand($sql, [
                ':tanggal' => Yii::$app->formatter->asDate($tanggal, "php:Y-m-d"),
                ':pindahHari' => $pindahHari
            ]
        )->queryAll();

    }



    public static function findUntukLaporanHarianHanyaJabatanUtamaSajaRawSql($tanggal) {

        $sql = <<<SQL
SELECT 
       base_karyawan.nama,
       base_karyawan.dept,
       base_karyawan.nik,
       base_karyawan.jadwal_kerja_karyawan,
       kehadiran.nama_jam_kerja,
       kehadiran.ketentuan_masuk,
       kehadiran.ketentuan_pulang,
       kehadiran.aktual_masuk,
       kehadiran.aktual_pulang,
       kehadiran.lama_waktu_bekerja,
       kehadiran.status_masuk_kerja_pada_pagi_hari,
       kehadiran.status_masuk_kerja,
       kehadiran.jenis_izin,
       kehadiran.cuti_normatif,
       kehadiran.status_kehadiran
FROM (
         SELECT k.id                   AS id,
                k.nama                 AS nama,
                rc.path                AS dept,
                k.nomor_induk_karyawan AS nik,
                jk2.nama               AS jadwal_kerja_karyawan  
         FROM karyawan k
                  LEFT JOIN (SELECT *
                             FROM karyawan_struktur_organisasi kso
                             WHERE kso.jenis_jabatan = :jenisJabatan) AS filter_kso_utama
                            ON filter_kso_utama.karyawan_id = k.id
             
                  LEFT JOIN jadwal_kerja jk2 ON k.jadwal_kerja_id = jk2.id
                  LEFT JOIN (
                     WITH RECURSIVE reporting_chain(id, parent_id, nama, tipe, root, path, level) AS (
                         SELECT id,                                   #id
                                parent_id,
                                nama,                                 #nama
                                tipe,                                 #tipe
                                CAST((CONCAT('{ "tipe":"', tipe, '","kode":"', kode, '","nama":"', nama,
                                             '"}')) AS CHAR(100000)), #root
                                CAST((CONCAT('"0" : { "tipe":"', lower(tipe),
                                    '","kode":"', kode,
                                    '","nama":"', nama,
                                    '","singkatan":"', singkatan,
                                    '","level":"', 0,
                                             '"}')) AS CHAR(100000)), #path
                                1
                         FROM struktur_organisasi so
                         WHERE parent_id IS NULL
                         UNION ALL
                         SELECT so.id,                                         #id
                                so.parent_id,
                                so.nama,                                       #nama
                                so.tipe,                                       #tipe
                                rc.root,                                       #root
                                CONCAT(rc.path, ',',
                                       (CONCAT('"', (rc.level), '": {',
                                           '"tipe":"', lower(so.tipe),
                                           '","kode":"', so.kode,
                                           '","nama":"', so.nama,
                                           '","singkatan":"', so.singkatan,
                                           '","level":"', rc.level + 1,
                                           '"}'
                                       ))), #path
                                rc.level + 1
                         FROM reporting_chain rc
                                  JOIN struktur_organisasi so ON rc.id = so.parent_id)
                     SELECT id,
                            parent_id,
                            nama,
                            tipe,
                            (root)                   AS root,
                            (CONCAT('{', path, '}')) AS path,
                            level
                     FROM reporting_chain
                  ) AS rc ON rc.id = filter_kso_utama.struktur_organisasi_id
         WHERE k.tanggal_berhenti_bekerja IS NULL
     ) AS base_karyawan


         LEFT JOIN (
    SELECT kdis.id                                                     AS id,
           k.id                                                        as karyawan_id,  
       jk.nama                                                         AS nama_jam_kerja,
           IF(toleransi_terlambat > 0, 
                DATE_ADD(ketentuan_masuk, INTERVAL toleransi_terlambat MINUTE),
                ketentuan_masuk) AS ketentuan_masuk,
           ketentuan_pulang,
           aktual_masuk,
           aktual_pulang,
           TIME_FORMAT(TIMEDIFF(aktual_pulang, aktual_masuk), '%H:%i') AS lama_waktu_bekerja,
           CASE
               WHEN (aktual_masuk IS NULL) AND (jenis_izin_id IS NOT NULL)    THEN 'Izin Tidak Masuk'
               WHEN (aktual_masuk IS NULL) AND (cuti_normatif_id IS NOT NULL) THEN 'Cuti'
               WHEN (aktual_masuk IS NULL) THEN 'Belum Ada Kabar'
               WHEN (aktual_masuk >
                     IF(toleransi_terlambat > 0,
                        DATE_ADD(ketentuan_masuk, INTERVAL toleransi_terlambat MINUTE),
                        ketentuan_masuk
                         )
                   ) THEN 'Terlambat'
               ELSE 'Sesuai' END                                       AS status_masuk_kerja_pada_pagi_hari,
           CASE
               WHEN (aktual_masuk IS NULL) AND (jenis_izin_id IS NOT NULL)    THEN 'Izin Tidak Masuk'
               WHEN (aktual_masuk IS NULL) AND (cuti_normatif_id IS NOT NULL) THEN 'Cuti'
               WHEN (aktual_masuk IS NULL) AND (aktual_pulang IS NULL) THEN 'Tidak Masuk Kerja'
               WHEN (aktual_masuk >
                     IF(toleransi_terlambat > 0,
                        DATE_ADD(ketentuan_masuk, INTERVAL toleransi_terlambat MINUTE),
                        ketentuan_masuk
                         )
                   ) THEN 'Terlambat'
               ELSE 'Sesuai' END                                       AS status_masuk_kerja,
           ji.nama                                                     AS jenis_izin,
           CASE
               WHEN (aktual_masuk IS NULL) AND (jenis_izin_id IS NOT NULL)    THEN 'Izin Tidak Masuk'
               WHEN (aktual_masuk IS NULL) AND (cuti_normatif_id IS NOT NULL) THEN 'Cuti'
               WHEN (aktual_masuk IS NOT NULL) AND (aktual_pulang IS NULL) THEN 'Tidak Hadir, Tidak Ada Absen Pulang'
               WHEN (aktual_masuk IS NULL)     AND (aktual_pulang IS NULL) THEN 'Tidak Hadir'
               ELSE 'Hadir' END                         AS status_kehadiran,
           cn.nama                                                     as cuti_normatif,
           keterangan
    FROM kehadiran_di_internal_sistem kdis

             LEFT JOIN karyawan k on kdis.karyawan_id = k.id
             LEFT JOIN jenis_izin ji on kdis.jenis_izin_id = ji.id
             LEFT JOIN cuti_normatif cn on kdis.cuti_normatif_id = cn.id
             LEFT JOIN jam_kerja jk on kdis.jam_kerja_id = jk.id

    WHERE DATE(ketentuan_masuk) = :tanggal
) AS kehadiran ON kehadiran.karyawan_id = base_karyawan.id
ORDER BY base_karyawan.nama
;
SQL;
        return self::getDb()->createCommand($sql, [
            ':tanggal' => $tanggal,
            'jenisJabatan' => KaryawanStrukturOrganisasi::JENIS_JABATAN_UTAMA
        ])->queryAll();

    }

    public static function findUntukBatalkanData($tanggal) {
        return KehadiranDiInternalSistem::find()
            ->select([
                'jadwal' => 'jadwal_kerja.nama',
                'hari' => 'jadwal_kerja_hari.nama',
                'jamKerja' => 'jam_kerja.kode',
                'ketentuan_masuk' => new Expression("DATE_FORMAT( ketentuan_masuk ,'%d-%m-%Y %H:%i')"),
                'ketentuan_pulang' => new Expression("DATE_FORMAT( ketentuan_pulang ,'%d-%m-%Y %H:%i')"),
                'karyawan' => 'karyawan.nama',
                'aktual_masuk' => new Expression("DATE_FORMAT( aktual_masuk ,'%d-%m-%Y %H:%i')"),
                'aktual_pulang' => new Expression("DATE_FORMAT( aktual_pulang ,'%d-%m-%Y %H:%i')"),
                'jenis_izin' => 'jenis_izin.nama',
                'keterangan' => 'kehadiran_di_internal_sistem.keterangan',
                'cuti_normatif' => 'cuti_normatif.nama'
            ])
            ->joinWith('jadwalKerja', false)
            ->joinWith('jadwalKerjaHari', false)
            ->joinWith('jamKerja', false)
            ->joinWith('karyawan', false)
            ->joinWith('jenisIzin', false)
            ->joinWith('cutiNormatif', false)
            ->where([
                'tanggal' => $tanggal
            ])
            ->asArray()
            ->all();
    }


    /**
     * @param $tanggal
     * @return array
     * @throws Exception
     */
    public static function findUntukBatchUpdateUangKehadiran($tanggal) {

        $optsAturanKehadiran = ArrayHelper::map(
            AturanUangKehadiran::find()->all(), 'id', 'id'
        );

        $jenisIzinDalamKota = JenisIzin::find()->select('id')
            ->where([
                'nama' => 'Tugas Dalam Kota'
            ])
            ->one();

        $jenisIzinLuarKota = JenisIzin::find()->select('id')
            ->where([
                'nama' => 'Tugas Luar Kota'
            ])
            ->one();

        return self::getDb()->createCommand("
        
SELECT base.*, jenis_izin.nama AS nama_jenis_izin, auh.nama AS aturan_kehadiran
FROM (
         SELECT absensi_harian.id                                           AS id,
                absensi_harian.tanggal,
                k.nama                                                      AS nama_karyawan,
                jk.kode                                                     AS jadwal_kerja,

                absensi_harian.kode_jam_kerja                               AS kode_jam_kerja,
                absensi_harian.ketentuan_masuk                              AS ketentuan_masuk,
                absensi_harian.aktual_masuk                                 AS aktual_masuk,
                absensi_harian.ketentuan_pulang                             AS ketentuan_pulang,

                k.pengecualian_terlambat_karena_lembur_pada_hari_sebelumnya AS pengecualian_terlambat_karena_lembur_pada_hari_sebelumnya,
                absensi_kemarin.aktual_pulang                               AS aktual_pulang_kemarin,
                absensi_kemarin.ketentuan_pulang                            AS ketentuan_pulang_kemarin,

                absensi_harian.jenis_izin_id,
                k.aturan_umum_uang_kehadiran,

                IF(k.aturan_umum_uang_kehadiran = 'Ikut Aturan Umum',
                   CASE
                       # Kondisi masuk sebelum jam ketentuan masuk
                       WHEN (aktual_masuk < ketentuan_masuk)
                           THEN :KODE_DEFAULT_MENERIMA

                       # Kondisi Telat Kemarin Lembur
                       WHEN
                               (absensi_kemarin.aktual_pulang IS NOT NULL) AND (
                                   (TIME(absensi_kemarin.aktual_pulang) >=
                                    k.pengecualian_terlambat_karena_lembur_pada_hari_sebelumnya)
                                   AND absensi_harian.aktual_masuk <=
                                       k.batas_jam_terlambat_karena_lembur_pada_hari_berikutnya
                               )
                           THEN :KODE_TERLAMBAT_KEMARIN_LEMBUR


                       # Kondisi Izin Tugas Luar Kota
                       WHEN (absensi_harian.jenis_izin_id = :JENIS_IZIN_TUGAS_LUAR_KOTA)
                           THEN :KODE_IZIN_LUAR_KOTA

                       # Kondisi Izin Tugas Dalam Kota
                       WHEN (absensi_harian.jenis_izin_id = :JENIS_IZIN_TUGAS_DALAM_KOTA)
                           THEN :KODE_IZIN_DALAM_KOTA
                       ELSE :KODE_TIDAK_MENERIMA
                       END,
                   IF(absensi_harian.aktual_masuk IS NOT NULL,
                      :KODE_DEFAULT_MENERIMA_KEBIJAKAN_DIREKSI,
                      :KODE_TIDAK_MENERIMA
                       )
                    )                                                       AS aturan_uang_kehadiran_id

         FROM karyawan k
                  LEFT JOIN (SELECT MIN(a.id)                     AS id,
                                    a.karyawan_id,
                                    MAX(a.tanggal)                AS tanggal,
                                    MIN(a.aktual_masuk)           AS aktual_masuk,
                                    MIN(a.ketentuan_masuk)        AS ketentuan_masuk,
                                    MIN(a.ketentuan_pulang)       AS ketentuan_pulang,
                                    MAX(a.aktual_pulang)          AS aktual_pulang,
                                    MIN(ji.id)                    AS jenis_izin_id,
                                    MIN(jam_kerja_id),
                                    GROUP_CONCAT(DISTINCT j.kode) AS kode_jam_kerja

                             FROM kehadiran_di_internal_sistem a
                                      LEFT JOIN jenis_izin ji on a.jenis_izin_id = ji.id
                                      LEFT JOIN jam_kerja j on a.jam_kerja_id = j.id
                             WHERE DATE(a.tanggal) = :tanggal
                             GROUP BY (a.karyawan_id)
         )
             AS absensi_harian
                            ON k.id = absensi_harian.karyawan_id
                  LEFT JOIN (SELECT b.karyawan_id,
                                    MAX(b.tanggal)          as tanggal,
                                    MAX(b.aktual_pulang)    as aktual_pulang,
                                    MAX(b.ketentuan_pulang) AS ketentuan_pulang
                             FROM kehadiran_di_internal_sistem b
                             WHERE DATE(b.tanggal) = DATE_SUB(:tanggal, INTERVAL 1 DAY)
                             GROUP BY (b.karyawan_id))
             AS absensi_kemarin
                            ON k.id = absensi_kemarin.karyawan_id

                  LEFT JOIN
              jadwal_kerja jk on k.jadwal_kerja_id = jk.id

         ORDER BY k.nama
     ) base

         LEFT JOIN jenis_izin
                   ON base.jenis_izin_id = jenis_izin.id

        
         LEFT JOIN aturan_uang_kehadiran auh
                   ON auh.id = base.aturan_uang_kehadiran_id


ORDER BY base.nama_karyawan
        
        ", [
            ':KODE_DEFAULT_MENERIMA' => $optsAturanKehadiran[1],
            ':KODE_TERLAMBAT_KEMARIN_LEMBUR' => $optsAturanKehadiran[2],
            ':JENIS_IZIN_TUGAS_LUAR_KOTA' => $jenisIzinLuarKota->id,
            ':KODE_IZIN_LUAR_KOTA' => $optsAturanKehadiran[3],
            ':JENIS_IZIN_TUGAS_DALAM_KOTA' => $jenisIzinDalamKota->id,
            ':KODE_IZIN_DALAM_KOTA' => $optsAturanKehadiran[4],
            ':KODE_TIDAK_MENERIMA' => $optsAturanKehadiran[6],
            ':KODE_DEFAULT_MENERIMA_KEBIJAKAN_DIREKSI' => $optsAturanKehadiran[7],
            ':tanggal' => $tanggal
        ])->queryAll();
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
                    'readonlyAktualMasuk',
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
                'jadwal_kerja_id' => 'Jdw Kerja',
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
            'readonlyAktualMasuk',
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
