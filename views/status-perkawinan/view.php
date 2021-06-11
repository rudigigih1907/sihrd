<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FAS;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\StatusPerkawinan */


$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Status Perkawinans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-perkawinan-view">
    <div class="card shadow">
        <div class="card-header p-3">
            <div class="d-flex justify-content-start">

                <div class="mr-auto">
                    <?= Html::a(FAS::icon(FAS::_ARROW_LEFT). ' Back',
                    Yii::$app->request->referrer, ['class' => 'btn btn-secondary']) ?>
                </div>

                <div class="mx-1">
                    <?= Html::a(FAS::icon(FAS::_PLUS). ' Create More',
                    ['create'], ['class' => 'btn btn-primary']) ?>
                </div>

                <div class="mr-1">
                    <?= Html::a(FAS::icon(FAS::_LIST). ' Index', ['index'],
                    ['class' => 'btn btn-primary']) ?>
                </div>

                <div class="mr-1">
                    <?= Html::a(FAS::icon(FAS::_PEN). ' Update',
                    ['update', 'id' => $model->id, 'page' => Yii::$app->request->getQueryParam('page', null)], ['class'
                    => 'btn btn-primary']) ?>
                </div>

                <?php                 if(Helper::checkRoute('delete')) :
                echo Html::a(FAS::icon(FAS::_TRASH). ' Delete',
                ['delete', 'id' => $model->id, 'page' => Yii::$app->request->getQueryParam('page', null)], [
                'class' => 'btn btn-danger',
                'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
                ],
                ]);
                endif;
                ?>
            </div>
        </div>

                        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
                   'tipe',
           'kode',
           'nama',
           'keterangan:ntext',
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
        ],
        ]) ?>


        <div class="card-footer"></div>
    </div>
</div>