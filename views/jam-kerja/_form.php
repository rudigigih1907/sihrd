<?php

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JamKerja */
/* @var $form kartik\form\ActiveForm */
?>

<div class="jam-kerja-form">

    <div class="card shadow">

        <?php $form = ActiveForm::begin([
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]); ?>

        <div class="card-body">
            <?= $form->field($model, 'nama')->textInput([
                'maxlength' => true,
                'autofocus' => 'autofocus'
            ]) ?>
            <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'jam_masuk')->textInput() ?>
            <?= $form->field($model, 'jam_mulai_istrahat')->textInput() ?>
            <?= $form->field($model, 'jam_selesai_istrahat')->textInput() ?>
            <?= $form->field($model, 'jam_pulang')->textInput() ?>
            <?php // $form->field($model, 'durasi')->dropDownList(['durasi_efektif' => 'Durasi efektif', 'durasi_aktual' => 'Durasi aktual',]) ?>
            <?= $form->field($model, 'dihitung')->textInput() ?>
            <?= $form->field($model, 'toleransi_terlambat')->textInput() ?>
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
