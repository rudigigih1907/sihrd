<?php


/* @var $this View */
/* @var $records KehadiranDiInternalSistem[]|array */

/* @var $model LaporanHarianAbsensi */

use app\models\form\LaporanHarianAbsensi;
use app\models\KehadiranDiInternalSistem;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\ButtonToolbar;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Laporan Harian ' . Yii::$app->formatter->asDate($model->tanggal);
$this->params['breadcrumbs'][] = ['label' => 'Kehadiran Di Internal Absensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="kehadiran-di-internal-sistem-index">

    <div class="row">

        <div class="col">
            <div class="card shadow">

                <div class="card-header p-3">

                    <?php echo
                    ButtonToolbar::widget([
                        'options' => [
                            'class' => 'btn-toolbar',
                        ],
                        'buttonGroups' => [
                            [
                                'buttons' => [

                                    Html::a(FAS::icon(FAS::_ARROW_LEFT) . ' Kembali',
                                        Yii::$app->request->referrer,
                                        ['class' => 'btn btn-secondary']),

                                    ButtonDropdown::widget([
                                        'label' => FAS::icon(FAS::_FILE) . ' Laporan',
                                        'buttonOptions' => [
                                            'class' => ['btn btn-success'],
                                            'type' => 'button',
                                        ],
                                        'encodeLabel' => false,
                                        'dropdown' => [
                                            'items' => [
                                                ' <h6 class="dropdown-header">Laporan Pagi</h6>',
                                                [
                                                    'label' => FAS::icon(FAS::_CALENDAR_PLUS) . ' Kehadiran Pagi',
                                                    'url' => ['kehadiran-di-internal-sistem/export-laporan-harian-pagi-dengan-format-pdf', 'tanggal' => $model->tanggal],
                                                    'linkOptions' => [
                                                        'target' => '_blank'
                                                    ]
                                                ],
                                                [
                                                    'label' => FAS::icon(FAS::_CALENDAR_PLUS) . ' Kehadiran Pagi Di Grouping By Jadwal Kerja',
                                                    'url' => ['kehadiran-di-internal-sistem/export-laporan-harian-pagi-dengan-format-pdf',
                                                        'tanggal' => $model->tanggal,
                                                        'laporanGroupBy' => KehadiranDiInternalSistem::LAPORAN_PAGI_GROUPING_BY_JADWAL_KERJA
                                                    ],
                                                    'linkOptions' => [
                                                        'target' => '_blank'
                                                    ]
                                                ],
                                                '<div class="dropdown-divider"></div>',
                                                ' <h6 class="dropdown-header">Laporan Harian</h6>',
                                                [
                                                    'label' => FAS::icon(FAS::_CALENDAR_PLUS) . ' Kehadiran Per Hari',
                                                    'url' => ['kehadiran-di-internal-sistem/export-laporan-harian-per-hari-dengan-format-pdf', 'tanggal' => $model->tanggal],
                                                    'linkOptions' => [
                                                        'target' => '_blank'
                                                    ]
                                                ],
                                                [
                                                    'label' => FAS::icon(FAS::_CALENDAR_PLUS) . ' Kehadiran Per Hari Di Grouping By Jadwal Kerja',
                                                    'url' => ['kehadiran-di-internal-sistem/export-laporan-harian-per-hari-dengan-format-pdf',
                                                        'tanggal' => $model->tanggal,
                                                        'laporanGroupBy' => KehadiranDiInternalSistem::LAPORAN_HARIAN_GROUPING_BY_JADWAL_KERJA
                                                    ],
                                                    'linkOptions' => [
                                                        'target' => '_blank'
                                                    ]
                                                ],
                                            ],
                                            'encodeLabels' => false,
                                        ],
                                    ]),
                                ],
                            ]
                        ],
                    ])
                    ?>
                </div>

                <?php
                echo yii\grid\GridView::widget([
                    'dataProvider' => new yii\data\ArrayDataProvider([
                        'models' => $records,
                        'pagination' => false
                    ]),
                    'tableOptions' => [
                        'class' => 'card-table table table-striped table-responsive'
                    ],
                    'columns' => require(__DIR__ . '/_columns_laporan_harian.php'),
                ]);
                ?>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['buat-laporan-harian'], ['class' => 'btn btn-secondary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
