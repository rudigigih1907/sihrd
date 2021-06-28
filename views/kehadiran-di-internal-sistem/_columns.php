<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ButtonDropdown;
use yii\helpers\Url;

return [
    [
        'class' => 'yii\grid\SerialColumn',
    ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    /*[
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'jadwal_kerja_id',
        'value' => 'jadwalKerja.kode'
    ],*/

    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'jadwal_kerja_hari_id',
        'value' => 'jadwalKerjaHari.nama',

    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute' => 'tanggal',
        'format' => 'date',
        'filterType' => \kartik\date\DatePicker::class
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'jam_kerja_id',
        'value' => 'jamKerja.kode'
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'ketentuan_masuk',
        'format' => 'datetime'
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'ketentuan_pulang',
        'format' => 'datetime'
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'karyawan_id',
        'value' => 'karyawan.nama',
        'contentOptions' => [
            'class' => 'text-nowrap'
        ]
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'aktual_masuk',
        'format' => 'datetime'
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'aktual_pulang',
        'format' => 'datetime'
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'jenis_izin_id',
        'value' => 'jenisIzin.nama',
        'contentOptions' => [
            'class' => 'small'
        ]
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'cuti_normatif_id',
        'label' => 'Cuti',
        'value' => 'cutiNormatif.nama'
    ],
    /*[
        'class' => 'yii\grid\ActionColumn',
        'urlCreator' => function ($action, $model, $key, $index) {
            return \yii\helpers\Url::to([
                $action,
                'id' => $model->id,
                'page' => Yii::$app->request->getQueryParam('page', null)
            ]);
        },
    ],*/
    [
        'class' => 'yii\grid\ActionColumn',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([
                $action,
                'id' => $model->id,
                'page' => Yii::$app->request->getQueryParam('page', null)
            ]);
        },
        'template' => "{all}",
        'contentOptions' => [
            'style'=> [
                'padding' => '0'
            ],
            'class'=> 'text-center align-middle'
        ],
        'buttons' => [
            'all' => function ($url, $model, $key) {
                return ButtonDropdown::widget([

                    'encodeLabel' => false, // if you're going to use html on the button label
                    'label' => '',
                    'direction' => 'left',
                    'dropdown' => [
                        'encodeLabels' => false, // if you're going to use html on the items' labels
                        'items' => [
                            '<h6 class="dropdown-header">'.$model->karyawan->nama_panggilan.'</h6>',
                            '<div class="dropdown-divider"></div>',
                            [
                                'label' => FAS::icon(FAS::_EYE) . ' ' . Yii::t('yii', 'View'),
                                'url' => ['view', 'id' => $key,'page' => Yii::$app->request->getQueryParam('page', null)],
                            ],
                            [
                                'label' => FAS::icon(FAS::_PEN) . ' ' .Yii::t('yii', 'Update'),
                                'url' => ['update', 'id' => $key,'page' => Yii::$app->request->getQueryParam('page', null)],
                                'visible' => true,  // if you want to hide an item based on a condition, use this
                            ],
                            [
                                'label' => FAS::icon(FAS::_TRASH) . ' ' .Yii::t('yii', 'Delete'),
                                'linkOptions' => [
                                    'data' => [
                                        'method' => 'post',
                                        'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                    ],
                                ],
                                'url' => ['delete', 'id' => $key,'page' => Yii::$app->request->getQueryParam('page', null)],
                                'visible' => true,   // same as above
                            ],
                        ],
                        'options' => [
                            'class' => 'dropdown-menu-right', // right dropdown
                        ],
                    ],
                    'buttonOptions' => [
                        'class' => 'btn-sm btn-outline-primary'
                    ]
                ]);
            }
        ]
    ],

];   