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
        'attribute'=>'nama',
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'kode',
        'contentOptions' => [
            'class' => 'small'
        ],
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'jam_masuk',
        'format' => 'time'
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'jam_mulai_istrahat',
        'format' => 'time',
        'label' => 'Mulai Istrht'
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'jam_selesai_istrahat',
        'format' => 'time',
        'label' => 'Selesai Istrht'
    ],
     [
         'class'=>'\yii\grid\DataColumn',
         'attribute'=>'jam_pulang',
         'format' => 'time'
     ],
     /*[
         'class'=>'\yii\grid\DataColumn',
         'attribute'=>'durasi',
     ],*/
     /*[
         'class'=>'\yii\grid\DataColumn',
         'attribute'=>'dihitung',
     ],*/
     [
         'class'=>'\yii\grid\DataColumn',
         'attribute'=>'toleransi_terlambat',
         'label' => 'Toler. Telat'
     ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'pindah_hari',
        'label' => 'Pdh Hari'
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
        'urlCreator' => function ($action, $model, $key, $index) {
            return \yii\helpers\Url::to([
                    $action,
                    'id' => $model->id,
                    'page' => Yii::$app->request->getQueryParam('page', null)
            ]);
        },
    ],

];   