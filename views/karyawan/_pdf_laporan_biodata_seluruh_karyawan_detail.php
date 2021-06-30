<?php


/* @var $this \yii\web\View */

/* @var $data array */

$formatter = Yii::$app->formatter;
?>

<div class="Karyawan-index">

    <h2>Data Karyawan</h2>
    <p>Update Terakhir : <b><?= Yii::$app->formatter->asDatetime(date('Y-m-d H:i')) ?></b></p>


    <table class="table table-gridview">

        <thead>
        <tr>
            <th class="text-right">#</th>
            <th class="text-right">N.I.K</th>
            <th>Nama</th>
            <th>Sapaan</th>
            <th>T.T.L</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($data as $key => $karyawan) : ?>
            <tr>
                <td class="text-right" rowspan="2"><?= ($key + 1) ?></td>
                <td class="text-right" rowspan="2"><?= $karyawan['nomor_induk_karyawan'] ?></td>
                <td class="text-nowrap"><?= $karyawan['nama'] ?></td>
                <td><?= $karyawan['nama_panggilan'] ?></td>
                <td class="text-right text-nowrap"><?= $karyawan['tempat_lahir'] . ", " . $formatter->asDate($karyawan['tanggal_lahir']) ?></td>
            </tr>
            <tr>
                <td colspan="3">
                   <h3>Detail Karyawan : TODO</h3>
                   <h3>Keorganisasi-an : TODO</h3>
                   <h3>Alamat          : TODO</h3>
                   <h3>Data Kerabat    : TODO</h3>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


</div>

