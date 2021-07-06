<?php


/* @var $this \yii\web\View */

/* @var $records array */

use rmrevin\yii\fontawesome\FAS;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;


$this->title = 'Preview Uang Kehadiran ' . Yii::$app->formatter->asDate($tanggal) . ' = ' . count($records);
$this->params['breadcrumbs'][] = ['label' => 'Kehadiran Di Internal Absensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('.table-responsive{ max-height: 485px }')

?>

<div class="card shadow" id="crud">

    <?php
    if ($records) {
        try {
            echo GridView::widget([
                'dataProvider' => new ArrayDataProvider([
                    'models' => $records,
                    'pagination' => false
                ]),
                'tableOptions' => [
                    'class' => 'table table-sm small'
                ],
                'columns' => [
                    [
                        'attribute' => 'id',
                        'format' => 'raw',
                        'label' => 'Mesin',
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'value' => function ($data) {
                            return empty($data['id']) ? "" : Html::tag('span', FAS::icon(FAS::_CHECK_CIRCLE), [
                                'title' => $data['id']
                            ]);
                        }
                    ],
                    'tanggal:date',
                    'nama_karyawan',
                    'aturan_kehadiran',
                    'aturan_umum_uang_kehadiran',
                    'jadwal_kerja',
                    'kode_jam_kerja',
                    'ketentuan_masuk:datetime',
                    'aktual_masuk:datetime',
                    'aktual_pulang_kemarin:datetime',
                    'ketentuan_pulang_kemarin:datetime',
                    'nama_jenis_izin',

                ],
                'layout' =>
                    '<div class="card-body p-0">' .
                    '<div class="table-responsive">' .
                    "{items}" .
                    '</div>' .
                    '</div>' .
                    '<div class="card-footer pb-0">' .

                    '<div class="d-flex justify-content-between">' .
                    Html::a(FAS::icon(FAS::_ARROW_CIRCLE_LEFT) . ' Kembali ', ['kehadiran-di-internal-sistem/form-batch-update-uang-kehadiran'], [
                        'class' => 'btn btn-secondary mb-3',
                    ]) .
                    Html::a(FAS::icon(FAS::_WALKING) . ' Update ', ['kehadiran-di-internal-sistem/batch-update-uang-kehadiran', 'tanggal' => Yii::$app->formatter->asDate($tanggal, 'php:Y-m-d')], [
                        'class' => 'btn btn-primary mb-3',
                        'data' => [
                            'method' => 'post',
                            'confirm' => 'Sistem akan menghitung uang kehadiran pada tanggal: ' . Yii::$app->formatter->asDate($tanggal) . " , yakin ?"
                        ]
                    ])
                    . '</div>' .
                    '</div>'
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    ?>


</div>
