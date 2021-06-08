<?php
/**
 * @link http://phe.me
 * @copyright Copyright (c) 2014 Pheme
 * @license MIT http://opensource.org/licenses/MIT
 */

use pheme\settings\Module;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/**
 * @var yii\web\View $this
 * @var pheme\settings\models\Setting $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="setting-form">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

    <div class="card">

        <div class="card-body">

            <?= $form->field($model, 'section')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'key')->textInput(['maxlength' => 255]) ?>

            <?= $form->field($model, 'value')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'active')->checkbox(['value' => 1]) ?>

            <?=
            $form->field($model, 'type')->dropDownList(
                $model->getTypes()
            )->hint(Module::t('settings', 'Change at your own risk')) ?>
        </div>
        <div class="card-footer text-muted">

            <?=
            Html::submitButton(
                $model->isNewRecord ? Module::t('settings', 'Create') :
                    Module::t('settings', 'Update'),
                [
                    'class' => $model->isNewRecord ?
                        'btn btn-success' : 'btn btn-primary'
                ]
            ) ?>

        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
