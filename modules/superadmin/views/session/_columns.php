<?php

use common\models\User;
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    /*[
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'expire',
        'format' => 'datetime'
    ],*/
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'data',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'user_id',
        'value' => function ($model) {
            $user = User::findOne($model->user_id);
            return empty($user) ? "Guest" : $user->username;
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'last_write',
        'format' => 'datetime'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'template' => '{view} {delete}',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'contentOptions' => [
            'class' => 'text-nowrap'
        ],
        'viewOptions' => [
            'role' => 'modal-remote',
            'title' => 'View',
            'data-toggle' => 'tooltip'
        ],
        'deleteOptions' => [
            'role' => 'modal-remote',
            'title' => 'Delete',
            'data-confirm' => false,
            'data-method' => false,// for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Are you sure?',
            'data-confirm-message' => 'Are you sure want to delete this item'
        ],
    ],

];   