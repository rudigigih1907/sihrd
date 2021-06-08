<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <div class="card shadow">
        <?php $form = ActiveForm::begin(); ?>

        <div class="card-body">
            <?= $form->field($model, 'status')->textInput() ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <?= Html::a(FAS::icon(FAS::_LIST) . ' Index', ['index'], ['class' => 'btn btn-outline-primary']) ?>
                <?= Html::submitButton(FAS::icon(FAS::_SAVE) . ' Save', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>
