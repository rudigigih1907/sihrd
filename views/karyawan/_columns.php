<?php

use app\models\Karyawan;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ButtonDropdown;
use yii\helpers\Html;
use yii\helpers\Url;

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
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'nama_panggilan',
        'format' => 'raw',
        'value' => function($model){
            /** @var Karyawan $model */
            return $model->nama !== $model->nama_panggilan
                ? Html::tag('span',$model->nama_panggilan , [])
                : Html::tag('span', 'Sama' , [ 'class' => 'badge badge-info'])
                ;
        }
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'tempat_lahir',
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'tanggal_lahir',
        'format' => 'date'
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'jadwal_kerja_id',
        'format' => 'raw',
        'value' => function ($model) {
            /** @var Karyawan $model */
            return
                Html::a($model->jadwalKerja->kode,
                    ['jadwal-kerja/view', 'id' => $model->jadwalKerja->id],
                    ['class' => 'text-primary']);
        }
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
    [
        'class' => '\yii\grid\DataColumn',
        'label' => 'Aktif ?',
        'format' => 'raw',
        'contentOptions' => [
            'class' => 'text-right'
        ],
        'value' => function ($model) {
            /** @var Karyawan $model */
            return $model->statusAktifKaryawan !== Karyawan::TIDAK_AKTIF
                ? Html::tag('span', Karyawan::AKTIF, ['class' => 'badge badge-primary'])
                : Html::tag('span', Karyawan::TIDAK_AKTIF, ['class' => 'badge badge-warning']);
        }
    ],
//    [
//        'class' => '\yii\grid\DataColumn',
//        'attribute' => 'alasan_berhenti_bekerja',
//    ],
//     [
//     'class'=>'\yii\grid\DataColumn',
//     'attribute'=>'created_at',
//     ],
//     [
//     'class'=>'\yii\grid\DataColumn',
//     'attribute'=>'updated_at',
//     ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'created_by',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'updated_by',
    // ],
    [
        'class' => '\yii\grid\DataColumn',
        'label' => 'Jabatan',
        'headerOptions' => [
            'class' => 'text-right'
        ],
        'contentOptions' => [
            'class' => 'text-right'
        ],
        'format' => 'raw',
        'value' => function ($model) {
            /** @var Karyawan $model */
            return empty($model->countKaryawanStrukturOrganisasis)
                ? Html::tag('span', FAS::icon(FAS::_SAD_CRY), ['class' => 'text-secondary'])
                : Html::tag('span', $model->countKaryawanStrukturOrganisasis, ['class' => 'text-primary font-weight-bold']);
        }
    ],
    /*[
        'class' => 'yii\grid\ActionColumn',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([
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
                            '<h6 class="dropdown-header">'.$model->nama_panggilan.'</h6>',
                            [
                                'label' => FAS::icon(FAS::_LIFE_RING) .' PTKP',
                                'url' => ['manage-ptkp', 'id' => $key,'page' => Yii::$app->request->getQueryParam('page', null)],
                            ],
                            [
                                'label' => FAS::icon(FAS::_HANDSHAKE) .' Jabatan',
                                'url' => ['manage-jabatan', 'id' => $key,'page' => Yii::$app->request->getQueryParam('page', null)],
                            ],
                            '<div class="dropdown-divider"></div>',
                            [
                                'label' => FAS::icon(FAS::_UPLOAD) .' Photo Identintas',
                                'url' => ['upload-photo-identintas-diri', 'id' => $key,'page' => Yii::$app->request->getQueryParam('page', null)],
                            ],
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