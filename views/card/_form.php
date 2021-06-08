<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model app\models\Card */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="card-form">

    <div class="card shadow">

    <?php $form = ActiveForm::begin(); ?>

        <div class="card-body">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <?= Html::submitButton( FAS::icon(FAS::_SAVE). ' Save', ['class' =>'btn btn-primary' ]) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    </div>

</div>
