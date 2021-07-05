<?php


/* @var $this \yii\web\View */

/* @var $models array */

/* @var $karyawan array */
/* @var $tanggal string */

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;

$this->title = 'Preview Masuk Kerja : ' . Yii::$app->formatter->asDate($tanggal);
$this->params['breadcrumbs'][] = ['label' => 'Kehadiran Di Internal Sistem', 'url' => ['index', 'page' => Yii::$app->request->getQueryParam('page', null)]];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss(".readonly { cursor: not-allowed; } ");
$template = ['template' => '{input}{error}'];

$this->registerCss('.table-responsive{ max-height: 488px }')
?>


    <div class="kehadiran-di-internal-sistem-index">
        <div class="card shadow">
            <?php
            $form = ActiveForm::begin([
                'id' => 'dynamic-form',

            ]);
            ?>
            <div class="table-responsive">

                <?php
                DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper',
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 999, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $models[0],
                    'formId' => 'dynamic-form',
                    'formFields' => ['jadwal_kerja_id', 'jadwal_kerja_hari_id', 'jam_kerja_id', 'tanggal', 'ketentuan_masuk', 'ketentuan_pulang', 'karyawan_id', 'aktual_masuk',
                        'readonlyJadwalKerja',
                        'readonlyJadwalKerjaHari',
                        'readonlyJamKerja',
                        'readonlyKetentuanMasuk',
                        'readonlyKetentuanPulang',
                        'readonlyKaryawan',
                    ],
                ]); ?>
                <table class="card-table table table-bordered small">
                    <thead>
                    <tr class="text-nowrap">
                        <th scope="col">#</th>
                        <th scope="col">Jadwal</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Jam Kerja</th>
                        <th scope="col">Ketentuan Masuk</th>
                        <th scope="col">Ketentuan Pulang</th>
                        <th scope="col">Karyawan</th>
                        <th scope="col">Aktual Masuk</th>
                        <th scope="col" style="width: 2px">Aksi</th>
                    </tr>
                    </thead>

                    <tbody class="container-items container-items-horizontal">

                    <?php foreach ($models as $i => $modelDetail): ?>


                        <tr class="item text-nowrap">

                            <?php echo Html::activeHiddenInput($modelDetail, "[{$i}]jadwal_kerja_id"); ?>
                            <?php echo Html::activeHiddenInput($modelDetail, "[{$i}]jadwal_kerja_hari_id"); ?>
                            <?php echo Html::activeHiddenInput($modelDetail, "[{$i}]jam_kerja_id"); ?>
                            <?php echo Html::activeHiddenInput($modelDetail, "[{$i}]tanggal"); ?>
                            <?php echo Html::activeHiddenInput($modelDetail, "[{$i}]ketentuan_masuk"); ?>
                            <?php echo Html::activeHiddenInput($modelDetail, "[{$i}]ketentuan_pulang"); ?>
                            <?php echo Html::activeHiddenInput($modelDetail, "[{$i}]karyawan_id"); ?>
                            <?php echo Html::activeHiddenInput($modelDetail, "[{$i}]aktual_masuk"); ?>
                            <?php echo Html::activeHiddenInput($modelDetail, "[{$i}]readonlyJadwalKerja"); ?>
                            <?php echo Html::activeHiddenInput($modelDetail, "[{$i}]readonlyJadwalKerjaHari"); ?>
                            <?php echo Html::activeHiddenInput($modelDetail, "[{$i}]readonlyJamKerja",[
                                'class' => 'jam-kerja'
                            ]); ?>
                            <?php echo Html::activeHiddenInput($modelDetail, "[{$i}]readonlyKetentuanMasuk",[
                                    'class' => 'ketentuan-masuk'
                            ]); ?>
                            <?php echo Html::activeHiddenInput($modelDetail, "[{$i}]readonlyKetentuanPulang",[
                                'class' => 'ketentuan-pulang'
                            ]); ?>
                            <?php echo Html::activeHiddenInput($modelDetail, "[{$i}]readonlyKaryawan", [
                                'class' => 'karyawan'
                            ]); ?>
                            <?php echo Html::activeHiddenInput($modelDetail, "[{$i}]readonlyAktualMasuk"); ?>

                            <td style="width: 2px;"><?= ($i + 1) ?></td>
                            <td><?= $modelDetail->readonlyJadwalKerja ?></td>
                            <td><?= $modelDetail->readonlyJadwalKerjaHari ?></td>
                            <td><?= $modelDetail->readonlyJamKerja ?></td>
                            <td><?= $modelDetail->readonlyKetentuanMasuk ?></td>
                            <td><?= $modelDetail->readonlyKetentuanPulang ?></td>
                            <td><?= $modelDetail->readonlyKaryawan ?></td>
                            <td><?= $modelDetail->readonlyAktualMasuk ?></td>

                            <td class="p-0">
                                <button type="button" class="remove-item btn btn-link btn-xs text-danger">
                                    <i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php DynamicFormWidget::end(); ?>

            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <?php echo Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['index'], ['class' => 'btn btn-secondary']) ?>
                    <?php echo Html::submitButton(FAS::icon(FAS::_SAVE) . ' Simpan', [
                        'class' => 'btn btn-primary',
                        'data' => [
                            'confirm' => 'Yakin untuk memasukkan data-data ini?'
                        ]
                    ]) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

<?php $js = <<<JS
jQuery(".dynamicform_wrapper").on("beforeDelete", function(e, row) {
    
   let nama = jQuery(row).find('.karyawan').val();
   let jamKerja  = jQuery(row).find('.jam-kerja').val();
   let ketentuanMasuk  = jQuery(row).find('.ketentuan-masuk').val();
   let ketentuanPulang  = jQuery(row).find('.ketentuan-pulang').val();

   if (! confirm("Hapus " + nama + ", " + jamKerja  +" : "  + ketentuanMasuk + " ke " + ketentuanPulang  + " ?") ) {
       return false;
   }
   
   return true;
});
JS;

$this->registerJs($js);
