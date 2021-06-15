<?php

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StrukturOrganisasi */
/* @var $form kartik\form\ActiveForm */
?>

<div class="struktur-organisasi-form">

    <div class="card shadow">

        <?php $form = ActiveForm::begin([
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]); ?>

        <div class="card-body">

            <?php if (!$model->isNewRecord) : ?>
                <?= $form->field($model, 'parent_id')
                    ->textInput([
                        'autofocus' => 'autofocus'
                    ])->widget(\kartik\select2\Select2::class, [
                        'data' => \app\models\StrukturOrganisasi::mapIDToNamaDenganKode()
                    ])
                ?>
            <?php endif ?>

            <?= $form->field($model, 'tipe')->dropDownList(\app\models\StrukturOrganisasi::optsTipe()) ?>
            <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

            <?php // $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'kode')->textInput(['maxlength' => true])
                ->hint("Ganti spasi dengan underscore")
            ?>
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
