<?php

return [
    [
        'class' => 'yii\grid\SerialColumn',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'id',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'nama',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'alias',
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