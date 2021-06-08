<?php

use kartik\widgets\SwitchInput;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\administrator\models\Route */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="route-form">
    <div class="card shadow">
        <?php $form = ActiveForm::begin(); ?>
        <div class="card-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                    'onText' => 'On',
                    'offText' => 'Off',
                ]
            ]) ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <?= Html::submitButton(FAS::icon(FAS::_SAVE) . ' Save', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
