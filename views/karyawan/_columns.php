<?php

use mdm\admin\components\Helper;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ButtonDropdown;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;

$page = Yii::$app->request->getQueryParam('page', null);

return [
    [
        'class' => 'yii\grid\SerialColumn',
    ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'nomor_induk_karyawan',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'nama',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'nama_panggilan',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'tempat_lahir',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'tanggal_lahir',
    ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'status_kewarganegaraan',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'nomor_kartu_tanda_penduduk',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'nomor_kartu_keluarga',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'nomor_pokok_wajib_pajak',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'nomor_kitas_atau_sejenisnya',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'jenis_kelamin',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'agama_id',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'status_perkawinan_id',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'nama_ayah',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'nama_ibu',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'pendidikan_terakhir',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'tanggal_mulai_bekerja',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'tanggal_berhenti_bekerja',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'alasan_berhenti_bekerja',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'created_at',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'updated_at',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'created_by',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'updated_by',
    // ],
    [
        'class' => ActionColumn::class,
        'urlCreator' => function ($action, $model, $key, $index) use ($page){
            return Url::to([
                $action,
                'id' => $model->id,
                'page' => $page
            ]);
        },
        'header' => 'Aksi',
        'template' => '{dropdown}',
        'buttons' => [
            'dropdown' => function ($url, $model, $key) use ($page){
                $items = [
                    Html::tag('div', $model->nomor_induk_karyawan . " | " . $model->nama_panggilan, ['class' => 'dropdown-header']),
                    Html::tag('div', "", ['class' => 'dropdown-divider']),
                    [
                        'label' => FAS::icon(FAS::_EYE) . ' View',
                        'url' => ['view', 'id' => $key, 'page' => $page],
                        'linkOptions' => [
                            'class' => 'text-primary',
                        ]
                    ],
                    [
                        'label' => FAS::icon(FAS::_PEN) . " Update",
                        'url' => ['update', 'id' => $key, 'page' => $page],
                        'linkOptions' => [
                            'class' => 'text-primary',
                        ]
                    ],
                ];
                if (Helper::checkRoute('delete')) :
                    array_push($items, [
                        'label' => FAS::icon(FAS::_TRASH) . " Delete",
                        'url' => ['delete', 'id' => $key, 'page' => $page],
                        'linkOptions' => [
                            'class' => 'text-danger',
                            'data' => [
                                'method' => 'post',
                                'confirm' => "Apakah anda yakin akan menghapus data ini ?",
                            ],
                        ],
                    ]);
                endif;
                return ButtonDropdown::widget([
                    'buttonOptions' => [
                        'class' => 'btn btn-sm btn-light border border-primary'
                    ],
                    'direction' => ButtonDropdown::DIRECTION_LEFT,
                    'encodeLabel' => false,
                    'label' => ' Aksi',
                    'dropdown' => [
                        'encodeLabels' => false,
                        'items' => $items,
                        'options' => [
                            'class' => 'dropdown-menu dropdown-menu-right border border-secondary ',
                        ],
                    ],
                ]);
            },
        ],
    ],
];   