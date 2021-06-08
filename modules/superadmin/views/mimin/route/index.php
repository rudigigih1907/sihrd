<?php

use rmrevin\yii\fontawesome\FAS;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \hscstudio\mimin\models\RouteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Routes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="route-index">

    <div class="card shadow" id="crud">

        <div class="card-header p-3">
            <?= Html::a(FAS::icon(FAS::_PLUS_CIRCLE) . ' Create Route', ['create'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(FAS::icon(FAS::_COG) . ' Generate Route', ['generate'], ['class' => 'btn btn-primary']) ?>
        </div>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?php try {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'type',
                    'alias',
                    'name',
                    [
                        'attribute' => 'status',
                        'filter' => [0 => 'off', 1 => 'on'],
                        'format' => 'raw',
                        'options' => [
                            'width' => '80px',
                        ],
                        'value' => function ($data) {
                            if ($data->status == 1)
                                return "<span class='label label-primary'>" . 'On' . "</span>";
                            else
                                return "<span class='label label-danger'>" . 'Off' . "</span>";
                        }
                    ],
                    [
                        'options' => ['width' => '80px',],
                        'contentOptions' => [
                            'class' => 'text-nowrap'
                        ],
                        'header' => 'Actions',
                        'class' => 'yii\grid\ActionColumn',
                    ],
                ],
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        } ?>
    </div>

</div>
