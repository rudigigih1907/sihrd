<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\ButtonToolbar;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AbsensiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Absensi';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="absensi-index">

    <div class="card shadow" id="crud">

        <div class="card-header p-3">

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
                                            'label' => FAS::icon(FAS::_CALENDAR_PLUS) . ' Manual',
                                            'url' => ['create'],
                                        ],
                                        [
                                            'label' => FAS::icon(FAS::_CALENDAR_PLUS) . ' Import By Excel',
                                            'url' => ['import-data-dari-mesin-absensi-menggunakan-excel-file'],
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
                                            'url' => ['buat-laporan-harian'],
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

        <?php try {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => require(__DIR__ . '/_columns.php'),
                'headerRowOptions' => [
                    'class' => 'text-nowrap'
                ]
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        } ?>

    </div>

</div>

