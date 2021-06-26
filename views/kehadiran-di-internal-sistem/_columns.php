<?php

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
        'attribute' => 'jadwal_kerja_id',
        'value' => 'jadwalKerja.kode'
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'jadwal_kerja_hari_id',
        'value' => 'jadwalKerjaHari.nama'
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
        'value' => 'karyawan.nama'
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
        'value' => 'jenisIzin.nama'
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'cuti_normatif_id',
        'value' => 'cutiNormatif.nama'
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'urlCreator' => function ($action, $model, $key, $index) {
            return \yii\helpers\Url::to([
                $action,
                'id' => $model->id,
                'page' => Yii::$app->request->getQueryParam('page', null)
            ]);
        },
    ],

];   