<?php


namespace app\components\helpers;


class KeputusanUangKehadiran {

    /**
     * @var array
     */
    private $optionalAturanKehadiran;
    /**
     * @var string
     */
    private $ketentuanMasuk;
    /**
     * @var string
     */
    private $pengecualianTerlambatKarenaLemburPadaHariSebelumnya;
    /**
     * @var string
     */
    private $jenisIzinDinasDalamKota;
    /**
     * @var string
     */
    private $jenisIzinDinasLuarKota;
    /**
     * @var string
     */
    private $aktualMasuk;

    /**
     * @param array $optionalAturanKehadiran
     */
    public function setOptionalAturanKehadiran($optionalAturanKehadiran) {
        $this->optionalAturanKehadiran = $optionalAturanKehadiran;
    }
    /**
     * @param mixed $ketentuanMasuk
     */
    public function setKetentuanMasuk($ketentuanMasuk) {
        $this->ketentuanMasuk = $ketentuanMasuk;
    }
    /**
     * @param mixed $pengecualianTerlambatKarenaLemburPadaHariSebelumnya
     */
    public function setPengecualianTerlambatKarenaLemburPadaHariSebelumnya($pengecualianTerlambatKarenaLemburPadaHariSebelumnya) {
        $this->pengecualianTerlambatKarenaLemburPadaHariSebelumnya = $pengecualianTerlambatKarenaLemburPadaHariSebelumnya;
    }
    /**
     * @param mixed $jenisIzinDinasDalamKota
     */
    public function setJenisIzinDinasDalamKota($jenisIzinDinasDalamKota) {
        $this->jenisIzinDinasDalamKota = $jenisIzinDinasDalamKota;
    }
    /**
     * @param string $jenisIzinDinasLuarKota
     */
    public function setJenisIzinDinasLuarKota($jenisIzinDinasLuarKota) {
        $this->jenisIzinDinasLuarKota = $jenisIzinDinasLuarKota;
    }
    /**
     * @param mixed $aktualMasuk
     */
    public function setAktualMasuk($aktualMasuk) {
        $this->aktualMasuk = $aktualMasuk;
    }

    /**
     * @return int
     */
    public function getNilaiAkhir() {

        // Metode forward chaining disini:
        /*
         * Orang dapat uang kehadiran kalau :
         * 1. Tidak terlambat; atau
         * 2. Telat karena kemari lembur; atau
         * 3. Izin tugas dinas luar kota; atau
         * 4. Izin tugas dinas dalam kota; atau
         * 5. Yang penting ada jam masuk kerjanya
         * */

        return 1;
    }

}