<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Card */
?>
<div class="card-view">

        
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
               'name',
           'code',
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

</div>