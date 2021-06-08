<?php

use mdm\admin\components\Helper;
use rmrevin\yii\fontawesome\FAS;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel mdm\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="card shadow" id="crud">

        <div class="card-header p-3">
            <?= Html::a(FAS::icon(FAS::_PLUS_CIRCLE) . ' Signup User', ['user/signup'], ['class' => 'btn btn-primary']) ?>
        </div>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [['class' => 'yii\grid\SerialColumn'],
                'username',
                'email:email',
                ['attribute' => 'status',
                    'value' => function ($model) {
                        return $model->status == 0 ? 'Inactive' : 'Active';
                    },
                    'filter' => [0 => 'Inactive',
                        10 => 'Active']],
                [
                    'class' => yii\grid\ActionColumn::class,
                    //'template' => Helper::filterActionColumn(['view', 'activate', 'change-password', 'delete']),
                    'template' => "{view} {activate} {change-password} {delete}",
                    'buttons' => [
                        'activate' => function ($url, $model) {
                            if ($model->status == 10) {
                                return '';
                            }
                            $options = ['title' => Yii::t('rbac-admin', 'Activate'),
                                'aria-label' => Yii::t('rbac-admin', 'Activate'),
                                'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                                'data-method' => 'post',
                                'data-pjax' => '0',];
                            return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, $options);
                        },
                        'change-password' => function ($url, $model) {
                            return Html::a(FAS::icon(FAS::_REDO), $url,[]);
                        }
                    ]
                ],
            ],
        ]);
        ?>

    </div>


</div>
