<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\ButtonToolbar;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\KehadiranDiInternalSistemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kehadiran Di Internal Sistem';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="kehadiran-di-internal-sistem-index">

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
                'tableOptions' => [
                    'class' => 'card-table table table-striped table-fixes-last-column'
                ],
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        } ?>

    </div>

</div>

