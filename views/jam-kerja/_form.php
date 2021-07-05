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

        <?php $form = ActiveForm::begin([]); ?>

        <div class="card-body">

            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <?= $form->field($model, 'nama')->textInput([
                        'maxlength' => true,
                        'autofocus' => 'autofocus'
                    ]) ?>
                </div>
                <div class="col-md-3 col-sm-12">
                    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3 col-sm-12">
                    <?= $form->field($model, 'jam_masuk')->textInput() ?>

                </div>

                <div class="col-md-3 col-sm-12">
                    <?= $form->field($model, 'jam_mulai_istrahat')->textInput() ?>

                </div>
            </div>

            <div class="row">


                <div class="col-md-3 col-sm-12">
                    <?= $form->field($model, 'jam_selesai_istrahat')->textInput() ?>

                </div>

                <div class="col-md-3 col-sm-12">
                    <?= $form->field($model, 'jam_pulang')->textInput() ?>

                </div>
                <div class="col-md-3 col-sm-12">
                    <?php // $form->field($model, 'durasi')->dropDownList(['durasi_efektif' => 'Durasi efektif', 'durasi_aktual' => 'Durasi aktual',]) ?>

                    <?= $form->field($model, 'dihitung')->textInput() ?>

                </div>
                <div class="col-md-3 col-sm-12">
                    <?= $form->field($model, 'toleransi_terlambat')->textInput() ?>

                </div>

            </div>

            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <?= $form->field($model, 'pindah_hari')->textInput([
                        'type' => 'number'
                    ]) ?>
                </div>
            </div>

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
