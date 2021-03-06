<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ButtonDropdown;
use yii\bootstrap4\ButtonToolbar;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\KaryawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Karyawan';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('.table-responsive{ min-height: 320px }')

?>
<div class="karyawan-index">
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
                            Html::a(FAS::icon(FAS::_PLUS_CIRCLE) . ' Tambah', ['create'], ['class' => 'btn btn-primary']),
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
                                            'label' => FAS::icon(FAS::_FILE) . ' Seluruh Data Karyawan',
                                            'url' => [
                                                'laporan-biodata-seluruh-karyawan', 'page' => Yii::$app->request->getQueryParam('page', null)
                                            ],
                                        ],

                                        [
                                            'label' => FAS::icon(FAS::_FILE) . ' Seluruh Data Karyawan Untuk Mesin Absen',
                                            'url' => [
                                                'find-data-untuk-mesin-absensi', 'page' => Yii::$app->request->getQueryParam('page', null)
                                            ],
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
                'id' => 'crudTable',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => require(__DIR__ . '/_columns.php'),
                'tableOptions' => [
                    'class' => 'card-table table table-sm small table-striped table-fixes-last-column'
                ],
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        } ?>

    </div>
</div>
