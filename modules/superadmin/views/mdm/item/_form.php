<?php

use mdm\admin\AutocompleteAsset;
use mdm\admin\components\Configs;
use mdm\admin\components\RouteRule;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$rules = Configs::authManager()->getRules();
unset($rules[RouteRule::RULE_NAME]);
$source = Json::htmlEncode(array_keys($rules));

$js = <<<JS
    $('#rule_name').autocomplete({
        source: $source,
    })
JS;
AutocompleteAsset::register($this);
$this->registerJs($js);
?>

<div class="auth-item-form">

    <div class="card shadow">

        <?php $form = ActiveForm::begin(['id' => 'item-form']); ?>

        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'ruleName')->textInput(['id' => 'rule_name']) ?>

                    <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <?php
            echo Html::submitButton(
                FAS::icon(FAS::_PLUS_CIRCLE) . " Save", [
                'class' => 'btn btn-primary',
                'name' => 'submit-button']
            )
            ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>


</div>
