<?php

use kartik\grid\GridView;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\ButtonToolbar;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\KehadiranDiInternalSistemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kehadiran Di Internal Sistem';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="kehadiran-di-internal-sistem-index">

    <div class="card shadow" id="crud">

        <div class="card-header p-3">

            <div class="d-flex justify-content-between">
                <?php echo
                ButtonToolbar::widget([
                    'options' => [
                        'class' => 'btn-toolbar',
                    ],
                    'buttonGroups' => [
                        [
                            'buttons' => [
                                ButtonDropdown::widget([
                                    'label' => FAS::icon(FAS::_PLUS_CIRCLE) . ' Tambah',
                                    'buttonOptions' => [
                                        'class' => ['btn btn-primary'],
                                        'type' => 'button',
                                    ],
                                    'encodeLabel' => false,
                                    'dropdown' => [
                                        'items' => [
                                            [
                                                'label' => FAS::icon(FAS::_CALENDAR_PLUS) . ' Secara Manual',
                                                'url' => ['create'],
                                            ],
                                            [
                                                'label' => FAS::icon(FAS::_CALENDAR_PLUS) . ' Import Kehadiran Masuk',
                                                'url' => ['import-kehadiran-masuk'],
                                            ],
                                            [
                                                'label' => FAS::icon(FAS::_CALENDAR_PLUS) . ' Import Kehadiran Pulang',
                                                'url' => ['import-kehadiran-pulang'],
                                            ],

                                        ],
                                        'encodeLabels' => false,
                                    ],
                                ]),
                                ButtonDropdown::widget([
                                    'label' => FAS::icon(FAS::_SWIMMER) . ' Kehadiran',
                                    'buttonOptions' => [
                                        'class' => ['btn btn-info'],
                                        'type' => 'button',
                                    ],
                                    'encodeLabel' => false,
                                    'dropdown' => [
                                        'items' => [

                                            [
                                                'label' => FAS::icon(FAS::_CALENDAR_PLUS) . ' Update Uang Kehadiran Per Hari',
                                                'url' => ['form-batch-update-uang-kehadiran'],
                                            ],

                                            [
                                                'label' => FAS::icon(FAS::_CALENDAR_PLUS) . ' Update Uang Kehadiran Per Karyawan',
                                                'url' => ['form-update-uang-kehadiran-per-karyawan'],
                                            ],

                                        ],
                                        'encodeLabels' => false,
                                    ],
                                ]),
                                ButtonDropdown::widget([
                                    'label' => FAS::icon(FAS::_FILE) . ' Laporan',
                                    'buttonOptions' => [
                                        'class' => ['btn btn-success'],
                                        'type' => 'button',
                                    ],
                                    'encodeLabel' => false,
                                    'dropdown' => [
                                        'items' => [

                                            [
                                                'label' => FAS::icon(FAS::_CALENDAR_PLUS) . ' Laporan Harian',
                                                'url' => ['create-laporan-harian'],
                                            ],
                                            [
                                                'label' => FAS::icon(FAS::_CALENDAR_PLUS) . ' Laporan Uang Kehadiran',
                                                'url' => ['create-laporan-uang-kehadiran'],
                                            ],
                                        ],
                                        'encodeLabels' => false,
                                    ],
                                ]),
                                ButtonDropdown::widget([
                                    'label' => FAS::icon(FAS::_FILE) . ' Utilitas',
                                    'buttonOptions' => [
                                        'class' => ['btn btn-warning'],
                                        'type' => 'button',
                                    ],
                                    'encodeLabel' => false,
                                    'dropdown' => [
                                        'items' => [

                                            [
                                                'label' => FAS::icon(FAS::_CALENDAR_PLUS) . ' Batalkan Data Per Tanggal',
                                                'url' => ['form-cancel-kehadiran'],
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

                <?= \yii\helpers\Html::a(FAS::icon(FAS::_REDO) . ' Reload', ['index'], [
                    'class' => 'btn btn-outline-dark'
                ]) ?>
            </div>


        </div>

        <?php try {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => require(__DIR__ . '/_columns.php'),
                'tableOptions' => [
                    'class' => 'card-table table table-striped small table-fixes-last-column'
                ],
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        } ?>

    </div>

</div>

