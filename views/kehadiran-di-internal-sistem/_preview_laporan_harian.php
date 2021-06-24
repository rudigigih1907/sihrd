<?php


/* @var $this \yii\web\View */
/* @var $records \app\models\KehadiranDiInternalSistem[]|array */

/* @var $model \app\models\form\LaporanHarianAbsensi */

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

$this->title = 'Laporan Harian ' . Yii::$app->formatter->asDate($model->tanggal);
$this->params['breadcrumbs'][] = ['label' => 'Kehadiran Di Internal Absensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="kehadiran-di-internal-sistem-index">

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
                        ['kehadiran-di-mesin-absensi/export-laporan-harian-ke-pdf', 'tanggal' => $model->tanggal],
                        ['class' => 'btn btn-success', 'target' => '_blank'])
                    ?>
                </div>

                <?php
                echo yii\grid\GridView::widget([
                    'dataProvider' => new yii\data\ArrayDataProvider([
                        'models' => $records,
                        'pagination' => false
                    ]),
                    'tableOptions' => [
                        'class' => 'card-table table table-sm small'
                    ],
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                        ],
                        [
                            'class' => '\yii\grid\DataColumn',
                            'attribute' => 'nama',
                        ],
                        [
                            'class' => '\yii\grid\DataColumn',
                            'attribute' => 'nik',
                        ],
                        [
                            'class' => '\yii\grid\DataColumn',
                            'attribute' => 'menjabat',
                            'format' => 'raw',
                            'value' => function ($model) {
                                $temp = "";
                                if (!empty($model['menjabat'])) {
                                    $tempArray = explode(",", $model['menjabat']);
                                    $temp = array_map(function ($element) {
                                        $breakingChain = explode("->", $element);
                                        return $breakingChain[1] . ' : ' . end($breakingChain);
                                    }, $tempArray);
                                    $temp = implode('<br/>', $temp);
                                }
                                return $temp;
                            }
                        ],
                        [
                            'class' => '\yii\grid\DataColumn',
                            'attribute' => 'aktual_masuk',
                            'format' => 'datetime'
                        ],
                        [
                            'class' => '\yii\grid\DataColumn',
                            'attribute' => 'aktual_pulang',
                            'format' => 'datetime'
                        ],
                        [
                            'class' => '\yii\grid\DataColumn',
                            'attribute' => 'lama_waktu_bekerja',
                            'format' => 'time'
                        ],
                        [
                            'class' => '\yii\grid\DataColumn',
                            'attribute' => 'status_masuk_kerja',
                        ],
                        [
                            'class' => '\yii\grid\DataColumn',
                            'attribute' => 'jenis_izin',
                        ],
                        [
                            'class' => '\yii\grid\DataColumn',
                            'attribute' => 'status_kehadiran',
                        ],
                        [
                            'class' => '\yii\grid\DataColumn',
                            'attribute' => 'keterangan',
                        ],
                    ]
                ]);
                ?>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['kehadiran-di-mesin-absensi/buat-laporan-harian'], ['class' => 'btn btn-secondary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
