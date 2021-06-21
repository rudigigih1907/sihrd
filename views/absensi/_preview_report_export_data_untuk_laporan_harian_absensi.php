<?php


/* @var $this View */
/* @var $days Absensi[]|array */

/* @var $model ReportExportDataUntukLaporanHarianAbsensi */

use app\models\Absensi;
use app\models\form\ReportExportDataUntukLaporanHarianAbsensi;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Laporan Harian ' . $model->tanggal;
$this->params['breadcrumbs'][] = ['label' => 'Absensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="absensi-preview">

    <div class="row">

        <div class="col">
            <div class="card shadow">

                <div class="card-header p-3">

                    <?=
                    Html::a(FAS::icon(FAS::_ARROW_LEFT) . ' Kembali',
                        Yii::$app->request->referrer,
                        ['class' => 'btn btn-secondary'])
                    ?>

                    <?=
                    Html::a(FAS::icon(FAS::_FILE_EXCEL) . ' Excel',
                        ['karyawan/absensi/export-data-untuk-report-per-hari', 'tanggal' => $model->tanggal ],
                        ['class' => 'btn btn-success', 'target' => '_blank'])
                    ?>
                </div>

                <?php
                echo yii\grid\GridView::widget([
                    'dataProvider' => new yii\data\ArrayDataProvider([
                        'models' => $days,
                        'pagination' => false
                    ]),
                    'tableOptions' => [
                        'class' => 'card-table table'
                    ],
                    'columns' => []
                ]);
                ?>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['absensi/find-data-untuk-report-per-hari'], ['class' => 'btn btn-secondary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
