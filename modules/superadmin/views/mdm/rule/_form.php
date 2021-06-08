<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this  yii\web\View */
/* @var $model mdm\admin\models\BizRule */
/* @var $form ActiveForm */
?>

<div class="auth-item-form">

    <div class="card shadow">
        <?php $form = ActiveForm::begin(); ?>

        <div class="card-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

            <?= $form->field($model, 'className')->textInput() ?>
        </div>

        <div class="card-footer">
            <?php
            echo Html::submitButton(
                FAS::icon(FAS::_SAVE) . ' Save', [
                'class' => 'btn btn-primary'])
            ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
