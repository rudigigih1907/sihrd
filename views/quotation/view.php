<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model app\models\Quotation */


$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Quotations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotation-view">
    <div class="card shadow">
        <div class="card-header p-3">

                <?= Html::a(FAS::icon(FAS::_ARROW_LEFT). ' Back', Yii::$app->request->referrer, ['class' => 'btn btn-outline-secondary']) ?>
                <?= Html::a(FAS::icon(FAS::_PLUS). ' Create More', ['create'], ['class' => 'btn btn-outline-primary']) ?>
                <?= Html::a(FAS::icon(FAS::_LIST). ' Index', ['index'], ['class' => 'btn btn-outline-primary']) ?>
                <?= Html::a(FAS::icon(FAS::_PEN). ' Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(FAS::icon(FAS::_TRASH). ' Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
                ],
                ]) ?>

        </div>

        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
               'card_pic_and_address_id',
           'goods_type_id',
           'issue_date',
           'reference_number',
           'status',
           'remarks:ntext',
           [
                    'attribute' => 'created_at',
                    'format' => 'datetime',            
           ],
           [
                    'attribute' => 'updated_at',
                    'format' => 'datetime',            
           ],
           [
                    'attribute' => 'created_by',
                    'value' => function($model){ return app\models\User::findOne($model->created_by)->username; }            
           ],
           [
                    'attribute' => 'updated_by',
                    'value' => function($model){ return app\models\User::findOne($model->updated_by)->username; }            
           ],
           'validity',
           'log',
        ],
    ]) ?>


    <div class="card-footer"></div>
</div>