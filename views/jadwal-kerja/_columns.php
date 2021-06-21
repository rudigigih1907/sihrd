<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\helpers\Url;

$page = Yii::$app->request->getQueryParam('page', null);
return [
    [
        'class' => 'yii\grid\SerialColumn',
    ],
    [
        'class' => 'yii\grid\DataColumn',
        'attribute' => 'id',
    ],
    [
        'class' => 'yii\grid\DataColumn',
        'attribute' => 'nama',
        'headerOptions' => ['class' => 'text-nowrap'],
        'contentOptions' => ['class' => 'text-nowrap'],
    ],
    [
        'class' => 'yii\grid\DataColumn',
        'attribute' => 'kode',
        'headerOptions' => ['class' => 'text-nowrap'],
        'contentOptions'=>['class' => 'text-nowrap'],
    ],
    [
        'class'=>'yii\grid\DataColumn',
        'attribute'=>'keterangan',
        'headerOptions'=>['class' => 'text-nowrap'],
        'contentOptions'=>['class' => 'text-nowrap'],
    ],
    [
        'class'=>'yii\grid\DataColumn',
        'attribute'=>'mulai_tanggal',
        'headerOptions'=>['class' => 'text-nowrap'],
        'contentOptions'=>['class' => 'text-nowrap'],
    ],
    [
        'class'=>'yii\grid\DataColumn',
        'attribute'=>'status',
        'headerOptions'=>['class' => 'text-nowrap'],
        'contentOptions'=>['class' => 'text-nowrap'],
    ],
    // [
        // 'class'=>'yii\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'yii\grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    // [
        // 'class'=>'yii\grid\DataColumn',
        // 'attribute'=>'created_by',
    // ],
    // [
        // 'class'=>'yii\grid\DataColumn',
        // 'attribute'=>'updated_by',
    // ],
    [
        'class' => 'yii\grid\ActionColumn',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([
                $action,
                'id' => $model->id,
                'page' => Yii::$app->request->getQueryParam('page', null)
            ]);
        },
        'template' => "{clone} {view} {update} {delete}",
        'buttons' => [
            'clone' => function ($url, $model, $key){
                return Html::a(FAS::icon(FAS::_CLONE), $url, [
                    'class' => 'text-primary',
                    'title' => 'Clone',
                    'data' => [
                        'confirm' => 'Anda akan clone / copy data '. $model->nama .' ?',
                    ],
                ]);
            }
        ]
    ],

];   