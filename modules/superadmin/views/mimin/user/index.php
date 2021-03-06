<?php

use rmrevin\yii\fontawesome\FAS;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \hscstudio\mimin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="card shadow" id="crud">

        <div class="card-header p-3">
            <?= Html::a(FAS::icon(FAS::_PLUS_CIRCLE) . ' Create', ['create'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(FAS::icon(FAS::_PLUS_CIRCLE) . ' Batch Create', ['/superadmin/mini-user/batch-create'], [
                'class' => 'btn btn-warning',
                'data-confirm' => Yii::t('yii', 'Beberapa user akan dibuat dengan format NIk-tanggalLahir?'),
                'data-method' => 'post',
            ]) ?>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                [
                    'attribute' => 'namaKaryawan',
                    'value' => function($model){
                        return $model->karyawan->nama;
                    }
                ],

                'username',
                //'auth_key',
                //'password_hash',
                //'password_reset_token',
                'email:email',
                [
                    'attribute' => 'roles',
                    'format' => 'raw',
                    'contentOptions' => [
                        'class' => 'text-nowrap',
                    ],
                    'value' => function ($data) {
                        $roles = [];
                        foreach ($data->roles as $role) {
                            $roles[] = $role->item_name;
                        }
                        return Html::a(implode(', ', $roles), ['view', 'id' => $data->id]);
                    }
                ],
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'contentOptions' => [
                        'style' => ['width'=>'10px'],
                    ],
                    'value' => function ($data) {
                        if ($data->status == 10)
                            return "<span class='badge badge-primary'>" . 'Active' . "</span>";
                        else
                            return "<span class='badge badge-danger'>" . 'Banned' . "</span>";
                    }
                ],
                /*[
                    'attribute' => 'created_at',
                    'format' => ['date', 'php:d-m-Y, H:i:s'],
                    'contentOptions' => [
                        'class' => 'text-nowrap',
                    ],
                ],
                [
                    'attribute' => 'updated_at',
                    'format' => ['date', 'php:d-m-Y, H:i:s'],
                    'contentOptions' => [
                        'class' => 'text-nowrap',
                    ],
                ],*/
                [
                    'options' => ['width' => '80px',],
                    'contentOptions' => [
                        'class' => 'text-nowrap'
                    ],
                    'header' => 'Actions',
                    'class' => 'yii\grid\ActionColumn',
                ],
            ],
        ]); ?>

    </div>
</div>
