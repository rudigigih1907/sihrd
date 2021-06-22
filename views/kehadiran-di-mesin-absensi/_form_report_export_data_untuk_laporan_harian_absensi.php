<?php


/* @var $this \yii\web\View */
/* @var $model \app\models\form\ReportExportDataUntukLaporanHarianAbsensi */

use kartik\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

$this->title = 'Buat Laporan Harian';
$this->params['breadcrumbs'][] = ['label' => 'KehadiranDiMesinAbsensi', 'url' => ['index', 'page' => Yii::$app->request->getQueryParam('page', null)]];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="absensi-form">
    <div class="row">
        <div class="col">

            <?php $form = ActiveForm::begin([
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
            ]) ?>
            <div class="card ">
                <div class="card-header">
                    <?= FAS::icon(FAS::_FILE_EXCEL) ?> Form Export Data
                </div>
                <div class="card-body">

                    <?= Html::tag('div', $form->errorSummary($model), [
                        'class' => 'text-danger'
                    ]) ?>

                    <?= $form->field($model, 'tanggal')->widget(kartik\date\DatePicker::class); ?>

                </div>


                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['index'], ['class' => 'btn btn-secondary']) ?>
                        <?= Html::submitButton(FAS::icon(FAS::_SEARCH) . ' Search', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
