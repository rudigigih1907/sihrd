<?php

use app\models\KehadiranDiInternalSistem;
use yii\helpers\Html;

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
        'attribute' => 'aktual_masuk',
        'format' => 'datetime'
    ],

    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'status_masuk_kerja_pada_pagi_hari',
        'label' => 'Status Masuk',
        'format' => 'raw',
        'value' => function ($model) {

            $label = $model['status_masuk_kerja_pada_pagi_hari'];
            switch ($label):
                case KehadiranDiInternalSistem::STATUS_TERLAMBAT:
                case  KehadiranDiInternalSistem::STATUS_BELUM_ADA_KABAR:
                    $label = Html::tag('span', $label, ['class' => 'text-danger']);
                    break;
                case  KehadiranDiInternalSistem::STATUS_IZIN_TIDAK_MASUK:
                case  KehadiranDiInternalSistem::STATUS_CUTI:
                    $label = Html::tag('span', $label, ['class' => 'text-success']);
                    break;
                default:
                    break;
            endswitch;

            return $label;
        }
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