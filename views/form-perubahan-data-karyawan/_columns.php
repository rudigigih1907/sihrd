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
        'attribute'=>'judul',
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'deskripsi_umum',
        'format' => 'nText',
        'value' => function($model){
            return yii\helpers\StringHelper::truncate($model->deskripsi_umum, 25);
        }
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'status',
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'aksi_yang_dilakukan',
        'format' => 'nText',
        'value' => function($model){
            return yii\helpers\StringHelper::truncate($model->aksi_yang_dilakukan, 25);
        }
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'urlCreator' => function($action, $model, $key, $index) {
            return \yii\helpers\Url::to([
                $action,
                'id' => $model->id,
                'page' => Yii::$app->request->getQueryParam('page', null)
            ]);
        },
    ],

];   