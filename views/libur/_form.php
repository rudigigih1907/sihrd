<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model app\models\Libur */
/* @var $form kartik\form\ActiveForm */
?>

<div class="libur-form">

    <div class="card shadow">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

        <div class="card-body">
                <?= $form->field($model, 'tanggal')->widget(\kartik\datecontrol\DateControl::class,[ 
                'type'=>kartik\datecontrol\DateControl::FORMAT_DATE,
                'options' => [
                    'autofocus'=> 'autofocus'
                ] 
            ]) ?>
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'status')->dropDownList([ 'Hari Libur' => 'Hari Libur', 'Cuti Bersama' => 'Cuti Bersama', ]) ?>
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
