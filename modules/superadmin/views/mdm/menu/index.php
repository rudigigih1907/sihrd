<?php

use rmrevin\yii\fontawesome\FAS;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Menu */

$this->title = Yii::t('rbac-admin', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <div class="card shadow" id="crud">

        <div class="card-header p-3">
            <?= Html::a( FAS::icon(FAS::_PLUS_CIRCLE). ' Create Menu', ['create'], [
                'class' => 'btn btn-primary'
            ]) ?>
        </div>

        <?php Pjax::begin(); ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                [
                    'attribute' => 'menuParent.name',
                    'filter' => Html::activeTextInput($searchModel, 'parent_name', [
                        'class' => 'form-control', 'id' => null
                    ]),
                    'label' => Yii::t('rbac-admin', 'Parent'),
                ],
                'route',
                'order',
                ['class' => \app\components\grid\ActionColumn::class,],
            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>
</div>
