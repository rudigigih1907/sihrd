<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%aturan_uang_kehadiran}}`.
 */
class m210705_112612_CreateAturanUangKehadiranTable extends Migration {

    public $table = '{{%aturan_uang_kehadiran}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {

        /*
         * Aturan main Uang kehadiran :
         *
         * 1. Datang Tepat Waktu.
         *      Tidak boleh lebih dari ketentuan_masuk, maka dapat uang kehadiran
         * 2. Terlambat Kemarin Lembur.
         *      Kalau kabag ke atas, Jam kerja kemarin lihat, apakah dia pulang lebih dari jam 20:00, maka dapat uang kehadiran
         *      Kalau staff, Jam kerja kemarin lihat, apakah dia pulang lebih dari jam 21:00, maka dapat uang kehadiran
         * 4. Tugas Luar Kota.
         *      Maka otomatis dapat.
         * 5. Tugas Dalam Kota.
         *      Maka otomatis dapat.
         * 6. Yang penting ada jam masuknya
         *      Maka otomatis dapat.
         *
         * Cek kemungkinan kolom:
         *
         * Parameter untuk mendapatkan uang kehadiran, berdasarkan kondisi diatas  :
         *  1. Ketentuan Masuk pada hari aktif (tambah kolom ketentuan_masuk)
         *      => Aturan ketentuan_masuk < aktual_masuk,
         *      => Aturan Yang penting ada jam masuknya,
         *  2. Jam Pulang sehari sebelum hari aktif (tambah kolom jam_pulang_pada_hari_sebelumnya)
         *      => Aturan pulang lebih dari jam 20:00,
         *      => Aturan pulang lebih dari jam 21:00,
         *  3. Dinas luar kota     (jenis_izin_id)
         *  4. Dinas Dalam Kota    (jenis_izin_id)
         *
         *
         * */

        $this->addColumn('karyawan',
            'pengecualian_terlambat_karena_lembur_pada_hari_sebelumnya',
            "ENUM('Tidak Ada',  '20:00', '21:00') DEFAULT '20:00'"
        );

        $this->createTable('{{%aturan_uang_kehadiran}}', [
            'id' => $this->primaryKey(),
            'nama' => $this->string()->notNull()->unique(),
            'keterangan' => $this->text(),
            'is_dapat_uang_kehadiran' => $this->boolean(),
            'is_aktif' => $this->boolean(),
        ]);

        $this->batchInsert($this->table,
            [ 'nama', 'keterangan', 'is_dapat_uang_kehadiran', 'is_aktif'],
            [
                ['Default Menerima', 'Aturan umum (Tidak terlambat sesuai ketentuan masuk jam kerja)', '1', '1'],
                ['Terlambat Karena Kemarin Lembur', 'Karyawan lembur pada hari sebelumnya', '1', '1'],
                ['Dinas Keluar Kota', 'Karyawan ditugaskan keluar kota', '1', '1'],
                ['Dinas Dalam Kota', 'Karyawan ditugaskan di dalam kota', '1', '1'],
                ['Yang penting jam masuk kerja ada', 'Karyawan yang penting masuk kerja, biasanya kebijakan direksi', '1', '1'],
                ['Tidak Menerima', 'Karyawan tidak menerima uang kehadiran', '1', '1'],
            ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('{{%aturan_uang_kehadiran}}');
        $this->dropColumn('karyawan', 'pengecualian_terlambat_karena_lembur_pada_hari_sebelumnya');
    }
}
