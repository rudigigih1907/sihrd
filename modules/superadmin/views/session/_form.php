<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model app\models\Session */
/* @var $form kartik\form\ActiveForm */
?>

<div class="session-form">

    <div class="card shadow">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

        <div class="card-body">
                <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'expire')->textInput() ?>
    <?= $form->field($model, 'data')->textInput() ?>
    <?= $form->field($model, 'user_id')->textInput() ?>
    <?= $form->field($model, 'last_write')->textInput() ?>
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
