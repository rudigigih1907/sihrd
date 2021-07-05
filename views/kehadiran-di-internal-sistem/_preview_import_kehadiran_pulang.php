<?php


/* @var $this \yii\web\View */
/* @var $models */
/* @var $tanggal */


$this->title = 'Preview Jam Pulang : ' . Yii::$app->formatter->asDate($tanggal) . " + " . $pindahHari . " hari";
$this->params['breadcrumbs'][] = ['label' => 'Kehadiran Di Internal Sistem', 'url' => ['index', 'page' => Yii::$app->request->getQueryParam('page', null)]];
$this->params['breadcrumbs'][] = $this->title;

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

?>

<div class="kehadiran-di-internal-sistem-index">

    <div class="card shadow">

        <div class="table-responsive pt-1">
            <?php
            try {
                echo yii\grid\GridView::widget([
                    'dataProvider' => new yii\data\ArrayDataProvider([
                        'models' => $models,
                        'totalCount' => count($models)
                    ]),
                    'columns' => [
                        'tanggal_scan:date',
                        'nama_karyawan',
                        'nik',
                        'aktual_masuk',
                        'aktual_pulang',
                    ]
                ]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['index'], ['class' => 'btn btn-secondary']) ?>
                <?= Html::a(FAS::icon(FAS::_SAVE) . ' Update Jam Pulang',
                    ['kehadiran-di-internal-sistem/batch-update-jam-pulang-karyawan',
                        'tanggal' => $tanggal,
                        'pindahHari' => $pindahHari
                    ]
                    , [
                        'class' => 'btn btn-primary',
                        'data' => [
                            'method' => 'post',
                            'confirm' => "Apakah Anda yakin akan meng-update jam pulang seluruh karyawan pada tanggal " .Yii::$app->formatter->asDate($tanggal) . " ?"
                        ]
                    ]) ?>
            </div>
        </div>
    </div>
</div>
