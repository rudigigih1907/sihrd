<?php


/* @var $this \yii\web\View */

/* @var $data array */

$formatter = Yii::$app->formatter;
?>

<div class="Karyawan-index">

    <h2>Data Karyawan</h2>
    <p>Update Terakhir :
        <b><?= Yii::$app->formatter->asDatetime(date('Y-m-d H:i')) ?></b>
    </p>

    <?php $no = 1 ?>
    <?php foreach ($data as $key => $karyawan) : ?>
        <div>
            <p style="font-weight: bold"><?= $no ?>. <?= $karyawan['nama'] ?></p>
            <table class="table-bordered-outside">
                <thead>
                    <tr>
                        <th colspan="6" style="text-align: left">Biodata</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>NIK</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['nomor_induk_karyawan'] ?></td>

                    <td>Nama Panggilan</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['nama_panggilan'] ?></td>
                </tr>

                <tr>
                    <td>Tempat & Tgl Lahir</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['tempat_lahir'] ?>, <?= $karyawan['tanggal_lahir'] ?></td>

                    <td>Status Kewarganegaraan</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['status_kewarganegaraan'] ?></td>
                </tr>

                <tr>
                    <td>Nomor KTP.</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['nomor_kartu_tanda_penduduk'] ?></td>

                    <td>NPWP</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['nomor_pokok_wajib_pajak'] ?></td>
                </tr>

                <tr>
                    <td>Nomor Kitas</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['nomor_kitas_atau_sejenisnya'] ?></td>

                    <td>Jenis Kelamin</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['jenis_kelamin'] ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['agama'] ?></td>

                    <td>Nama Ayah</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['nama_ayah'] ?></td>
                </tr>
                <tr>
                    <td>Nama Ibu</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['nama_ibu'] ?></td>

                    <td>Pendidikan Terakhir</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['pendidikan_terakhir'] ?></td>
                </tr>
                <tr>
                    <td>Tanggal Mulai Bekerja</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['tanggal_mulai_bekerja'] ?></td>

                    <td>Jadwal Bekerja</td>
                    <td class="divider">:</td>
                    <td><?= $karyawan['jadwal_bekerja'] ?></td>
                </tr>
                </tbody>

            </table>

        </div>

        <?php $no++; ?>
    <?php endforeach; ?>
</div>

