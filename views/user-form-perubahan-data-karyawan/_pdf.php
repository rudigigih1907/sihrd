<?php



/* @var $this View */

use app\models\FormPerubahanDataKaryawan;
use app\widgets\PDFHeaderWidget;
use app\widgets\PDFSignatureWidget;
use yii\web\View;

/* @var $model FormPerubahanDataKaryawan */
?>


<div class="user-form-perubahan-data-karyawan-index">

    <?php echo PDFHeaderWidget::widget([
        'title' => 'Pengajuan Perubahan Data Karyawan<br/>'. $model->nomor_referensi,
        'qrCode' => $model->nomor_referensi
    ]) ?>

    <table class="table table-detail-view">
        <tbody>
        <tr>
            <td>Status</td>
            <td class="divider">:</td>
            <td colspan="4"><?= $model->status ?></td>
        </tr>

        <tr>
            <td>Deskripsi</td>
            <td class="divider">:</td>
            <td colspan="4" style="text-align: justify"><?= $model->deskripsi_umum ?></td>
        </tr>
        <tr>
            <td>Aksi yang dilakukan</td>
            <td class="divider">:</td>
            <td colspan="4" style="text-align: justify"><?= $model->aksi_yang_dilakukan ?></td>
        </tr>
        </tbody>
    </table>

    <br/>

    <table class="table-gridview">
        <thead>
        <tr>
            <th style="width: 2px; white-space: nowrap">No.</th>
            <th>Nama Data</th>
            <th>Nilai Lama</th>
            <th>Nilai Baru</th>
            <th>Aksi</th>
            <th>Keterangan</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($model->formPerubahanDataKaryawanDetails as $index => $detail): ?>
            <tr>
                <td class="text-right"><?= ($index + 1) ?></td>
                <td><?= $detail->nama_data ?></td>
                <td><?= $detail->nilai_lama ?></td>
                <td><?= $detail->nilai_baru ?></td>
                <td><?= $detail->aksi ?></td>
                <td><?= $detail->keterangan ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <br/>
    <div style="width: 80%; float: right">
        <?php echo PDFSignatureWidget::widget([
            'data' => [
                'Dicetak Oleh' =>
                    Yii::$app->user->identity->username . ' <br />' .
                    Yii::$app->formatter->asDatetime(date("Y-m-d H:i")),
                'Atasan' => null,
                'HRD Staff' => null,
            ]
        ]);
        ?>
    </div>

</div>

