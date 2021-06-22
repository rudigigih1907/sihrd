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
                    Html::a(FAS::icon(FAS::_FILE_PDF) . ' PDF',
                        ['absensi/export-laporan-harian-ke-pdf', 'tanggal' => $model->tanggal ],
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
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                        ],
                        [
                            'class' => '\yii\grid\DataColumn',
                            'attribute' => 'nama',
                            'label' => 'Nama Karyawan (Sistem)'
                        ],
                        [
                            'class'=>'\yii\grid\DataColumn',
                            'attribute'=>'tanggal_scan',
                            'format' => 'datetime'
                        ],
                        [
                            'class'=>'\yii\grid\DataColumn',
                            'attribute'=>'masuk',
                            'format' => 'date'
                        ],
                        [
                            'class'=>'\yii\grid\DataColumn',
                            'attribute'=>'pulang',
                            'format' => 'date'
                        ],
                        [
                            'class'=>'\yii\grid\DataColumn',
                            'attribute'=>'jml_menit',
                        ],
                        [
                            'class'=>'\yii\grid\DataColumn',
                            'attribute'=>'keterangan',
                        ],
                        [
                            'class' => '\yii\grid\DataColumn',
                            'attribute' => 'status',
                        ],
                        [
                            'class' => '\yii\grid\DataColumn',
                            'attribute' => 'temperatur_masuk',
                            'label' => "&#8451; Masuk",
                            'encodeLabel' => false
                        ],
                        [
                            'class' => '\yii\grid\DataColumn',
                            'attribute' => 'temperatur_pulang',
                            'label' => "&#8451; Pulang",
                            'encodeLabel' => false
                        ],
                    ]
                ]);
                ?>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['absensi/buat-laporan-harian'], ['class' => 'btn btn-secondary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
