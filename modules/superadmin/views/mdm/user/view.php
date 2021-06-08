<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$controllerId = $this->context->uniqueId . '/';
?>
<div class="user-view">
    <div class="card shadow" id="crud">
        <div class="card-header p-3">
            <div class="d-flex">
                <?= Html::a(FAS::icon(FAS::_LIST) . ' Index', ['index'], ['class' => 'btn btn-outline-primary mr-auto']) ?>
                <?php
                if ($model->status == 0 && Helper::checkRoute($controllerId . 'activate')) {
                    echo Html::a(Yii::t('rbac-admin', 'Activate'), ['activate', 'id' => $model->id], [
                        'class' => 'btn btn-primary',
                        'data' => [
                            'confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'method' => 'post',
                        ],
                    ]);
                }
                ?>

                <?php
                if (Helper::checkRoute($controllerId . 'delete')) {
                    echo Html::a(Yii::t('rbac-admin', 'Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger ml-auto',
                        'data' => [
                            'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]);
                }
                ?>
            </div>
        </div>
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'username',
                'email:email',
                'created_at:date',
                'status',
            ],
        ])
        ?>

        <div class="card-footer"></div>
    </div>
</div>
