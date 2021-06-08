<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\administrator\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index">
    <div class="card shadow" id="crud">

        <div class="card-header p-3">
            <?= Html::a(FAS::icon(FAS::_PLUS_CIRCLE).' Create Role', ['create'], ['class' => 'btn btn-primary']) ?>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                /*
                'type',
                'description:ntext',
                'rule_name',
                'data:ntext',
                // 'created_at',
                // 'updated_at',
                */
                [
                    'options' => ['width' => '80px',],
                    'contentOptions' => [
                        'class' => 'text-nowrap'
                    ],
                    'template' => '{permission} {view} {update} {delete}',  // the default buttons + your custom button,
                    'header' => 'Actions',
                    'class' => 'yii\grid\ActionColumn',
                ],
            ],
        ]); ?>
    </div>

</div>
