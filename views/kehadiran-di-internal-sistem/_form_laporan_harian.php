<?php



/* @var $this \yii\web\View */
/* @var $model \app\models\form\LaporanHarianAbsensi */

/* @var $form kartik\form\ActiveForm */

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

$this->title = 'Laporan Harian';
$this->params['breadcrumbs'][] = ['label' => 'Kehadiran Di Internal Sistem', 'url' => ['index', 'page' => Yii::$app->request->getQueryParam('page', null)]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kehadiran-di-internal-sistem-form">


    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="card shadow">

                <?php $form = ActiveForm::begin([
                    'type' => ActiveForm::TYPE_HORIZONTAL,
                    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
                ]); ?>

                <div class="card-body">
                    <?= $form->field($model, 'tanggal')
                        ->widget(\kartik\date\DatePicker::class);
                    ?>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['index'], ['class' => 'btn btn-secondary']) ?>
                        <?= Html::submitButton(FAS::icon(FAS::_SEARCH) . ' Cari', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
