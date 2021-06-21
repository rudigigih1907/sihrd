<?php
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
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'tanggal_scan',
        'format' => 'datetime'
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'tanggal',
        'format' => 'date'
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'jam',
        'format' => 'time'
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'pin',
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'nip',
    ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'nama',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'jabatan',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'departemen',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'kantor',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'verifikasi',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'io',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'workcode',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'sn',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'mesin',
    // ],
     [
         'class'=>'\yii\grid\DataColumn',
         'attribute'=>'karyawan.nama_panggilan',
         'label' => 'Nama'
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