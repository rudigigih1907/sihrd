<?php

use mdm\admin\components\Helper;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\JadwalKerja */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Kerjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwal-kerja-view">

    <div class="card shadow">
        <div class="card-header p-3">
            <div class="d-flex justify-content-start">

                <div class="mr-auto">
                    <?= Html::a(FAS::icon(FAS::_ARROW_LEFT) . ' Kembali', Yii::$app->request->referrer, ['class' => 'btn btn-secondary']) ?>
                </div>

                <div class="mx-1">
                    <?= Html::a(FAS::icon(FAS::_PLUS) . ' Buat Lagi', ['create'], ['class' => 'btn btn-primary']) ?>
                </div>

                <div class="mr-1">
                    <?= Html::a(FAS::icon(FAS::_LIST) . ' Index', ['index'], ['class' => 'btn btn-primary']) ?>
                </div>

                <div class="mr-1">
                    <?= Html::a(FAS::icon(FAS::_PEN) . ' Update', ['update', 'id' => $model->id, 'page' => Yii::$app->request->getQueryParam('page', null)], ['class' => 'btn btn-primary']) ?>
                </div>

                <div class="mr-1">
                    <?= Html::a(FAS::icon(FAS::_CLONE) . ' Clone', ['clone', 'id' => $model->id, 'page' => Yii::$app->request->getQueryParam('page', null)], [
                        'class' => 'btn btn-warning',
                        'data' => [
                            'confirm' => "Anda akan meng-clone " . $model->nama . " menjadi record baru  ?",
                        ],
                    ]) ?>
                </div>

                <?php if (Helper::checkRoute('delete')) :
                    echo Html::a(FAS::icon(FAS::_TRASH) . ' Hapus', ['delete', 'id' => $model->id, 'page' => Yii::$app->request->getQueryParam('page', null)], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]);
                endif;
                ?>
            </div>
        </div>


        <?php try {
            echo Tabs::widget([
                'encodeLabels' => false,
                'navType' => 'nav-tabs justify-content-start border-0',
                'tabContentOptions' => [
                    'class' => 'p-0'
                ],
                'items' => [
                    [
                        'active' => true,
                        'headerOptions' => [
                            'class' => 'pl-3'
                        ],
                        'label' => FAS::icon(FAS::_YIN_YANG) . ' Jadwal Kerja',
                        'content' =>
                            DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'nama',
                                    'kode',
                                    'keterangan:ntext',
                                    'mulai_tanggal',
                                    'status',
                                    [
                                        'attribute' => 'created_at',
                                        'format' => 'datetime',
                                    ],
                                    [
                                        'attribute' => 'updated_at',
                                        'format' => 'datetime',
                                    ],
                                    [
                                        'attribute' => 'created_by',
                                        'value' => function ($model) {
                                            return \app\models\User::findOne($model->created_by)->username ?? null;
                                        }
                                    ],
                                    [
                                        'attribute' => 'updated_by',
                                        'value' => function ($model) {
                                            return \app\models\User::findOne($model->updated_by)->username ?? null;
                                        }
                                    ],
                                ],
                            ]),

                    ],
                    [
                        'label' => 'Jadwal Kerja Detail',
                        'content' =>

                            !empty($model->jadwalKerjaDetails) ?
                                \yii\grid\GridView::widget([
                                    'dataProvider' => new \yii\data\ActiveDataProvider([
                                        'models' => $model->jadwalKerjaDetails,
                                        'pagination' => false
                                    ]),
                                    'columns' => [

                                        ['attribute' => 'jadwal_kerja_hari_id', 'value' => 'jadwalKerjaHari.nama'],
                                        ['attribute' => 'libur'],
                                        ['attribute' => 'jam_kerja_id', 'value' => function ($model) {
                                            /** @var \app\models\JadwalKerjaDetail $model */
                                            return !empty($model->jamKerja)
                                                ?
                                                $model->jamKerja->nama . ", " .
                                                $model->jamKerja->jam_masuk . " => " . $model->jamKerja->jam_pulang
                                                : "";
                                        }]
                                    ]
                                ])
                                :

                                Html::tag("p", 'Jadwal Kerja Detail tidak tersedia', [
                                    'class' => 'text-warning font-weight-bold p-3'
                                ])
                        ,
                    ],
                ],
            ]);
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
        ?>

    </div>
</div>