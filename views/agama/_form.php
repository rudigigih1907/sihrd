<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model app\models\Agama */
/* @var $form kartik\form\ActiveForm */
?>

<div class="agama-form">

    <div class="card shadow">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

        <div class="card-body">
                <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE). ' Close', ['index'], ['class' => 'btn btn-secondary']) ?>
                <?= Html::submitButton( FAS::icon(FAS::_SAVE). ' Save', ['class' =>'btn btn-primary' ]) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    </div>

</div>
