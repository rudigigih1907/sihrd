<?php

return [
    [
        'class' => 'yii\grid\SerialColumn',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'nama',
        'contentOptions' => [
            'class' => 'text-nowrap'
        ]
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'menjabat',
        'label' => 'Dept.',
        'format' => 'raw',
        'contentOptions' => [
            'class' => 'text-nowrap'
        ],
        'value' => function ($model) {
            $temp = "";

            if (!empty($model['kode_menjabat'])) {
//                $kodeMenjabat = explode(",", $model['kode_menjabat']);
//                $kode = app\components\helpers\KaryawanHelper::getFirstAndLastElement($kodeMenjabat, 1);
                $temp = \yii\helpers\Html::tag($model['menjabat']);
            }
            return $temp;
        }
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'nik',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'ketentuan_masuk',
        'format' => 'datetime'
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'aktual_masuk',
        'format' => 'datetime'
    ],

    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'status_masuk_kerja',
        'label' => 'Status Masuk',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'jenis_izin',
        'contentOptions' => [
            'class' => 'text-nowrap'
        ]
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'cuti_normatif',
        'contentOptions' => [
            'class' => 'text-nowrap'
        ]
    ],
/*    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'status_kehadiran',
    ],*/
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'keterangan',
    ],
];