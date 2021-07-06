<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model app\models\AturanUangKehadiran */
/* @var $form kartik\form\ActiveForm */
?>

<div class="aturan-uang-kehadiran-form">

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
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'is_dapat_uang_kehadiran')->textInput() ?>
    <?= $form->field($model, 'is_aktif')->textInput() ?>
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
