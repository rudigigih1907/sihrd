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
            $data = app\components\helpers\KaryawanHelper::generatePathJabatanUtama($model['dept']);
            return $data['perusahaan'] . ' ' . $data['cabang'] . ' ' . $data['departemen'];
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
        'attribute' => 'ketentuan_pulang',
        'format' => 'datetime'
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
        'attribute' => 'lama_waktu_bekerja',
        'label' => 'Lama Bekerja',
        'format' => 'time'
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
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'status_kehadiran',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'keterangan',
    ],
];