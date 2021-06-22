<?php


/* @var $this View */
/* @var $sheets array|string */
/* @var $model ImportDataDariMesinAbsensiMenggunakanExcelFile */
/* @var $direktori string */

use app\models\form\ImportDataDariMesinAbsensiMenggunakanExcelFile;
use rmrevin\yii\fontawesome\FAS;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\web\View;


$file = $model->attach_file->baseName . '.' . $model->attach_file->extension;

$this->title = 'Tambah Kehadiran Menggunakan Excel';
$this->params['breadcrumbs'][] = ['label' => 'KehadiranDiMesinAbsensi', 'url' => ['index', 'page' => Yii::$app->request->getQueryParam('page', null)]];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="absensi-preview">

    <!--
        Karena sheets berupa array yang terdiri dari element-element sheet excel,
        Lakukan perulangan manual
    -->

    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <?= FAS::icon(FAS::_INFO) ?> (Info) Template Format
                </div>
                <div class="card-body">

                    <ol type="A">
                        <?php foreach ($model->getColumnKey() as $item): ?>
                            <li><?= $item ?></li>
                        <?php endforeach; ?>
                    </ol>

                    <hr/>
                    <?= Html::tag('p', 'Berikut adalah hasil upload file Anda:'); ?>
                    <?= Html::tag('p', 'Jumlah Sheet: ' . count($sheets)); ?>

                </div>
            </div>
        </div>

        <div class="col-md-8 col-sm-12">
            <div class="card shadow">

                <div class="card-header">

                    <?= Html::tag('p', 'File: ' . $file); ?>
                </div>

                <div class="card-body">

                    <?php
                    foreach ($sheets as $key => $sheet) {

                        echo Html::tag('p', "Nama sheet: " . $key);
                        echo Html::beginTag('div', ['class' => 'table-responsive']);

                        echo yii\grid\GridView::widget([
                            'dataProvider' => new ArrayDataProvider([
                                'models' => $sheet,
                                'pagination' => false
                            ]),
                            'layout' => '{items}',
                            'columns' => [
                                [
                                    'class' => 'yii\grid\SerialColumn',
                                ],
                                'A',
                                'B',
                                'C',
                                'D',
                                'E',
                                'F',
                                'G',
                                'H',
                                'I',
                                'J',
                                'K',
                                'L',
                                'M',
                                'N',
                            ],
                        ]);
                        echo Html::endTag('div');
                    }
                    ?>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['import-data-dari-mesin-absensi-menggunakan-excel-file'], ['class' => 'btn btn-secondary']) ?>
                        <?= Html::a(FAS::icon(FAS::_SAVE) . ' Simpan', ['kehadiran-di-mesin-absensi/import-data-dari-mesin-kehadiran-di-mesin-absensi-menggunakan-excel-file-ke-database',
                            'file' => $file,
                            'startColumn' => $model->startColumn,
                            'startRow' => $model->startRow,
                        ], [
                            'class' => 'btn btn-primary',
                            'data' => [
                                'confirm' => "Anda akan mengimport semuda data dari: " . $file
                            ]
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
