<?php

/* @var $this View */

use app\models\form\ReportExportDataUntukMesinAbsensi;
use kartik\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\web\View;

/* @var $model ReportExportDataUntukMesinAbsensi */
/* @var $page int|string|null */

$this->title = 'Export Data Untuk Mesin Mesin Absensi';
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="karyawan-form">

    <div class="card">

        <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]); ?>

        <div class="card-body">
            <?= $form->field($model, 'statusAktif')->dropDownList( app\models\Karyawan::optsStatusAktif() , [
                'autofocus' => 'autofocus'
            ]) ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['index', 'page' =>$page ], [
                    'class' => 'btn btn-secondary'
                ]) ?>
                <?= Html::submitButton(FAS::icon(FAS::_SEARCH) . ' Search', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end() ?>
    </div>


</div>
