<?php
use yii\helpers\Url;

return [
/*    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
*/
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
        'mergeHeader' => false
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'card_pic_and_address_id',
        'headerOptions'=>['class' => 'text-nowrap'],
        'contentOptions'=>['class' => 'text-nowrap'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'goods_type_id',
        'headerOptions'=>['class' => 'text-nowrap'],
        'contentOptions'=>['class' => 'text-nowrap'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'issue_date',
        'headerOptions'=>['class' => 'text-nowrap'],
        'contentOptions'=>['class' => 'text-nowrap'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'reference_number',
        'headerOptions'=>['class' => 'text-nowrap'],
        'contentOptions'=>['class' => 'text-nowrap'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'status',
        'headerOptions'=>['class' => 'text-nowrap'],
        'contentOptions'=>['class' => 'text-nowrap'],
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'remarks',
        // 'headerOptions'=>['class' => 'text-nowrap'],
        // 'contentOptions'=>['class' => 'text-nowrap'],
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_by',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_by',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'validity',
        // 'headerOptions'=>['class' => 'text-nowrap'],
        // 'contentOptions'=>['class' => 'text-nowrap'],
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'log',
        // 'headerOptions'=>['class' => 'text-nowrap'],
        // 'contentOptions'=>['class' => 'text-nowrap'],
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
    ],

];   