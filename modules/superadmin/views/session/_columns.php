<?php

use app\models\User;
use yii\helpers\StringHelper;
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
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'expire',
        'format' => 'datetime'
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'data',
        'value' => function ($model) {
            return StringHelper::truncate($model->data, 25);
        }
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'user_id',
        'value' => function ($model) {
            $user = User::findOne($model->user_id);
            return empty($user) ? "Guest" : $user->username;
        }
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'last_write',
        'format' => 'datetime'
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([
                $action,
                'id' => $model->id,
                'page' => Yii::$app->request->getQueryParam('page', null)
            ]);
        },
    ],

];   