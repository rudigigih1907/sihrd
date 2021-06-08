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
        'attribute'=>'name',
        'headerOptions'=>['class' => 'text-nowrap'],
        'contentOptions'=>['class' => 'text-nowrap'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'code',
        'headerOptions'=>['class' => 'text-nowrap'],
        'contentOptions'=>['class' => 'text-nowrap'],
    ],
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
[
'class' => 'kartik\grid\ActionColumn',
],

];   