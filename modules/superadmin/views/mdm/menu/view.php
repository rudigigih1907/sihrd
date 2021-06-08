<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\Menu */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-view">

    <div class="card shadow" id="crud">
        <div class="card-header p-3">
            <?= Html::a(FAS::icon(FAS::_PLUS_CIRCLE). ' Create More', ['create'], ['class' => 'btn btn-outline-primary']) ?>
            <?= Html::a(FAS::icon(FAS::_LIST). ' Index', ['index'], ['class' => 'btn btn-outline-primary ']) ?>
            <?= Html::a(FAS::icon(FAS::_PEN). ' Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(FAS::icon(FAS::_TRASH). ' Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'menuParent.name:text:Parent',
                'name',
                'route',
                'order',
            ],
        ])
        ?>

        <div class="card-footer"></div>
    </div>

</div>
