<?php

/* @var $this \yii\web\View */

/* @var $data */

/* @var $statusAktif */

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

$this->title = 'Hasil Data Untuk Mesin Absensi';
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$this->registerCss('.table-responsive{ max-height: 488px }')
?>

<div class="karyawan-view">

    <div class="card shadow">
        <div class="card-header p-3">

            <?=
            Html::a(FAS::icon(FAS::_ARROW_LEFT) . ' Kembali',
                Yii::$app->request->referrer,
                ['class' => 'btn btn-secondary'])
            ?>

            <?=
            Html::a(FAS::icon(FAS::_FILE_EXCEL) . ' Excel',
                ['karyawan/export-laporan-biodata-seluruh-karyawan', 'statusAktif' => $statusAktif, 'type' => 'Excel'],
                ['class' => 'btn btn-success', 'target' => '_blank'])
            ?>

            <?=
            Html::a(FAS::icon(FAS::_FILE_PDF) . ' Pdf',
                ['karyawan/export-laporan-biodata-seluruh-karyawan', 'statusAktif' => $statusAktif, 'type' => 'Pdf'],
                ['class' => 'btn btn-success', 'target' => '_blank'])
            ?>
        </div>

        <?php try {
            echo yii\grid\GridView::widget([
                'dataProvider' => new yii\data\ArrayDataProvider([
                    'models' => $data,
                    'pagination' => false
                ]),
                'tableOptions' => [
                    'class' => 'card-table table table-sm small table-striped'
                ],
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                    ],
                    [
                        'class' => '\yii\grid\DataColumn',
                        'attribute' => 'nomor_induk_karyawan',
                        'label' => 'N.I.K'
                    ],
                    'nama',
                    'nama_panggilan',
                    'tempat_lahir',
                    'tanggal_lahir:date',
                    [
                        'class' => '\yii\grid\DataColumn',
                        'attribute' => 'status_kewarganegaraan',
                        'label' => 'WNI / WNA'
                    ],
                    [
                        'class' => '\yii\grid\DataColumn',
                        'attribute' => 'nomor_kartu_tanda_penduduk',
                        'label' => 'KTP'
                    ],
                    [
                        'class' => '\yii\grid\DataColumn',
                        'attribute' => 'nomor_kartu_keluarga',
                        'label' => 'K.K'
                    ],
                    [
                        'class' => '\yii\grid\DataColumn',
                        'attribute' => 'nomor_pokok_wajib_pajak',
                        'label' => 'N.P.W.P'
                    ],

                ]
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        } ?>

    </div>

</div>
