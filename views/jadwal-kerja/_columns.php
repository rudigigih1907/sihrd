<?php

use mdm\admin\components\Helper;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ButtonDropdown;
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
        'attribute' => 'nama',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'kode',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'keterangan',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'mulai_tanggal',
        'format' => 'date'
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'status',
    ],
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
        'class' => 'yii\grid\ActionColumn',
        'urlCreator' => function ($action, $model, $key, $index) use ($page) {
            return Url::to([
                $action,
                'id' => $model->id,
                'page' => $page
            ]);
        },
        'header' => 'Aksi',
        'template' => '{dropdown}',
        'buttons' => [
            'dropdown' => function ($url, $model, $key) use ($page) {

                /** @var \app\models\JadwalKerja $model */
                $items = [
                    Html::tag('div', $model->nama, ['class' => 'dropdown-header']),
                    Html::tag('div', "", ['class' => 'dropdown-divider']),
                    [
                        'label' => FAS::icon(FAS::_CLONE) . ' Clone',
                        'url' => ['clone', 'id' => $key, 'page' => $page, ],
                        'linkOptions' => [
                            'class' => 'text-primary',
                            'data' => [
                                'confirm' => "Anda akan meng-clone " . $model->nama . " menjadi record baru ?",
                            ],
                        ]
                    ],
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
                    'label' => ' ',
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