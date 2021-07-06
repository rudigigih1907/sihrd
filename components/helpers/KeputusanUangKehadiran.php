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
     * @var string
     */
    private $aktualPulangKemarin;

    /**
     * @param string $aktualPulangKemarin
     */
    public function setAktualPulangKemarin($aktualPulangKemarin) {
        $this->aktualPulangKemarin = $aktualPulangKemarin;
    }

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


        /*die(
            Html::tag('pre', VarDumper::dumpAsString(
                $this->optionalAturanKehadiran
            )) .
            Html::tag('pre', VarDumper::dumpAsString(
                $this->ketentuanMasuk
            )) .
            Html::tag('pre', VarDumper::dumpAsString(
                $this->pengecualianTerlambatKarenaLemburPadaHariSebelumnya
            )) .
            Html::tag('pre', VarDumper::dumpAsString(
                $this->jenisIzinDinasDalamKota
            )) .
            Html::tag('pre', VarDumper::dumpAsString(
                $this->jenisIzinDinasLuarKota
            )) .
            Html::tag('pre', VarDumper::dumpAsString(
                $this->aktualMasuk
            )) .
            Html::tag('pre', VarDumper::dumpAsString(
                $this->aktualPulangKemarin
            ))
        );*/


        // Terlambat aturan umum
        if ($this->ketentuanMasuk < $this->aktualMasuk) {
            return $this->optionalAturanKehadiran[1];
        }

        // Kemarin pulang lembur,
        if (!empty($this->aktualPulangKemarin)) {
            if ($this->aktualPulangKemarin > $this->pengecualianTerlambatKarenaLemburPadaHariSebelumnya) {
                return $this->optionalAturanKehadiran[2];
            }
        }

        // Jenis Izin Tugas Dalam Kota
        // Jenis Izin Tugas Luar Kota

        // Yang Penting Ada Jam Masuk nya
        if(!empty($this->aktualMasuk)){
            return $this->optionalAturanKehadiran[5];
        }

        return $this->optionalAturanKehadiran[6];

    }

}