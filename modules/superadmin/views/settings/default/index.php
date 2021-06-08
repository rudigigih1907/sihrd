<?php
/**
 * @link http://phe.me
 * @copyright Copyright (c) 2014 Pheme
 * @license MIT http://opensource.org/licenses/MIT
 */

use pheme\settings\models\Setting;
use pheme\settings\Module;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var pheme\settings\models\SettingSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Module::t('settings', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-index">


    <?php //echo $this->render('_search', ['model' => $searchModel]);?>



    <?php Pjax::begin(); ?>
    <div class="card">
        <div class="card-header p-2">
            <?= Html::a(
                Module::t(
                    'settings',
                    'Create {modelClass}',
                    [
                        'modelClass' => Module::t('settings', 'Setting'),
                    ]
                ),
                ['create'],
                ['class' => 'btn btn-success']
            ) ?>
        </div>
        <div class="card-body p-2">
            <?=
            GridView::widget(
                [
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        // 'id',
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => 'No.',
                            'contentOptions' => [
                                'class' => 'text-right'
                            ]
                        ],
                        [
                            'attribute' => 'section',
                            'filter' => ArrayHelper::map(
                                Setting::find()->select('section')->distinct()->where(['<>', 'section', ''])->all(),
                                'section',
                                'section'
                            ),
                        ],
                        'key',
                        'value:ntext',
                        [
                            'attribute' => 'active',
                            'format' => 'raw',
                            'filter' => [1 => 'Yes', 0 => 'No'],
                            'value' => function ($model) {
                                return $model->active == 1 ?
                                    '<span class="badge badge-primary">Active</span>' :
                                    '<span class="badge badge-warning">Not Active</span>';

                            }
                        ],
                        'type',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'contentOptions' => [
                                'class' => 'text-nowrap'
                            ]
                        ],
                    ],
                ]
            ); ?>
        </div>
        <div class="card-footer text-muted">
            Yii2 Settings By <?= Html::a('Phemel', \yii\helpers\Url::to('https://github.com/phemellc/yii2-settings'),[
                    'target' => '_blank'
            ]) ?>
        </div>
    </div>



    <?php Pjax::end(); ?>
</div>
