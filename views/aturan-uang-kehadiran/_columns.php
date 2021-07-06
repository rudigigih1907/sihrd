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
        'attribute'=>'keterangan',
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'is_dapat_uang_kehadiran',
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'is_aktif',
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