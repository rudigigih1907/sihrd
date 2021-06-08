<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="auth-item-form">
    <div class="card shadow">
        <?php $form = ActiveForm::begin(); ?>


        <div class="card-body">

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?php $form->field($model, 'type')->textInput() ?>

            <?php $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?php $form->field($model, 'rule_name')->textInput(['maxlength' => true]) ?>

            <?php $form->field($model, 'data')->textarea(['rows' => 6]) ?>

            <?php $form->field($model, 'created_at')->textInput() ?>

            <?php $form->field($model, 'updated_at')->textInput() ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <?= Html::submitButton(FAS::icon(FAS::_SAVE) . ' Save', ['class' => 'btn btn-primary']) ?>

            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
