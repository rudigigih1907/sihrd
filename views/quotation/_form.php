<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model app\models\Quotation */
/* @var $form kartik\form\ActiveForm */
?>

<div class="quotation-form">

    <div class="card shadow">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

        <div class="card-body">
                <?= $form->field($model, 'card_pic_and_address_id')->textInput() ?>
    <?= $form->field($model, 'goods_type_id')->textInput() ?>
    <?= $form->field($model, 'issue_date')->widget(\kartik\datecontrol\DateControl::class,[ 'type'=>kartik\datecontrol\DateControl::FORMAT_DATE, ]) ?>
    <?= $form->field($model, 'reference_number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList([ 'Draft' => 'Draft', 'Deal' => 'Deal', ], ['prompt' => '']) ?>
    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'validity')->widget(\kartik\datecontrol\DateControl::class,[ 'type'=>kartik\datecontrol\DateControl::FORMAT_DATE, ]) ?>
    <?= $form->field($model, 'log')->textInput() ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <?= Html::submitButton( FAS::icon(FAS::_SAVE). ' Save', ['class' =>'btn btn-primary' ]) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    </div>

</div>
