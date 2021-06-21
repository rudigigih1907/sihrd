<?php

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Absensi */
/* @var $form kartik\form\ActiveForm */
?>

<div class="absensi-form">

    <div class="card shadow">

        <?php $form = ActiveForm::begin([
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]); ?>

        <div class="card-body">
            <?= $form->field($model, 'tanggal_scan')->widget(\kartik\datecontrol\DateControl::class, [
                'type' => kartik\datecontrol\DateControl::FORMAT_DATETIME,
                'options' => [
                    'autofocus' => 'autofocus'
                ]
            ]) ?>
            <?= $form->field($model, 'tanggal')->widget(\kartik\datecontrol\DateControl::class, ['type' => kartik\datecontrol\DateControl::FORMAT_DATE,]) ?>
            <?= $form->field($model, 'jam')->textInput() ?>
            <?= $form->field($model, 'pin')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'departemen')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'kantor')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'verifikasi')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'io')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'workcode')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'sn')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'mesin')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'karyawan_id')->widget(\kartik\select2\Select2::class,[
                    'data' => \app\models\Karyawan::mapIDToKodeKaryawanDenganNama()
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
