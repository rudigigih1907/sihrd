<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model app\models\JadwalKerjaHari */
/* @var $form kartik\form\ActiveForm */
?>

<div class="jadwal-kerja-hari-form">

    <div class="card shadow">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

        <div class="card-body">
                <?= $form->field($model, 'nama')->textInput([
                    'maxlength' => true,
                    'autofocus'=> 'autofocus'
                ]) ?>
    <?= $form->field($model, 'asli')->dropDownList([ 'Ya' => 'Ya', 'Tidak' => 'Tidak', ]) ?>
    <?= $form->field($model, 'default_libur')->dropDownList([ 'Ya' => 'Ya', 'Tidak' => 'Tidak', ]) ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE). ' Tutup', ['index'], ['class' => 'btn btn-secondary']) ?>
                <?= Html::submitButton( FAS::icon(FAS::_SAVE). ' Simpan', ['class' =>'btn btn-primary' ]) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    </div>

</div>
