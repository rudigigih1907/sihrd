<?php

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KehadiranDiInternalSistem */
/* @var $form kartik\form\ActiveForm */
?>

<div class="kehadiran-di-internal-sistem-form">

    <div class="card shadow">

        <?php $form = ActiveForm::begin([
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]); ?>

        <div class="card-body">
            <?= $form->field($model, 'jadwal_kerja_id')->widget(\kartik\select2\Select2::class,[
                    'data' => \app\models\JadwalKerja::mapIDToNama()
            ]) ?>
            <?= $form->field($model, 'jadwal_kerja_hari_id')->widget(\kartik\select2\Select2::class,[
                    'data' => \app\models\JadwalKerjaHari::mapIDToNamaOrderById()
            ]) ?>
            <?= $form->field($model, 'jam_kerja_id')->widget(\kartik\select2\Select2::class,[
                    'data' => \app\models\JamKerja::mapIDToNama()
            ]) ?>
            <?= $form->field($model, 'ketentuan_masuk')->widget(\kartik\datecontrol\DateControl::class, ['type' => kartik\datecontrol\DateControl::FORMAT_DATETIME,]) ?>
            <?= $form->field($model, 'ketentuan_pulang')->widget(\kartik\datecontrol\DateControl::class, ['type' => kartik\datecontrol\DateControl::FORMAT_DATETIME,]) ?>
            <?= $form->field($model, 'karyawan_id')->widget(\kartik\select2\Select2::class,[
                    'data' => \app\models\Karyawan::mapIDToKodeKaryawanDenganNama()
            ]) ?>
            <?= $form->field($model, 'aktual_masuk')->widget(\kartik\datecontrol\DateControl::class, ['type' => kartik\datecontrol\DateControl::FORMAT_DATETIME,]) ?>
            <?= $form->field($model, 'aktual_pulang')->widget(\kartik\datecontrol\DateControl::class, ['type' => kartik\datecontrol\DateControl::FORMAT_DATETIME,]) ?>
            <?= $form->field($model, 'jenis_izin_id')->widget(\kartik\select2\Select2::class,[
                    'data' => \app\models\JenisIzin::mapIDToNama(),
                'options' => [
                        'prompt' => "-"
                ]
            ]) ?>

            <?= $form->field($model, 'cuti_normatif_id')->widget(\kartik\select2\Select2::class,[
                'data' => \app\models\CutiNormatif::mapIDToNama(),
                'options' => [
                    'prompt' => "-"
                ]
            ]) ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['index'], ['class' => 'btn btn-secondary']) ?>
                <?= Html::submitButton(FAS::icon(FAS::_SAVE) . ' Simpan', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
