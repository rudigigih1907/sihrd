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
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tanggal',
        'format' => 'date',
        'filterType' => \kartik\date\DatePicker::class
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'label' => 'Hari',
        'value' => function($model){
            return Yii::$app->formatter->asDate($model->tanggal,"php:l");
        }
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'keterangan',
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'status',
        'filter' => app\models\Libur::optsStatus()
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