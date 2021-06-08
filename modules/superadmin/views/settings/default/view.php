<?php
/**
 * @link http://phe.me
 * @copyright Copyright (c) 2014 Pheme
 * @license MIT http://opensource.org/licenses/MIT
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use pheme\settings\Module;

/**
 * @var yii\web\View $this
 * @var pheme\settings\models\Setting $model
 */

$this->title = $model->section. '.' . $model->key;
$this->params['breadcrumbs'][] = ['label' => Module::t('settings', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-view">

    <div class="card">
        <div class="card-header">
            <?= Html::a(Module::t('settings', 'Index'), ['index'], ['class' => 'btn  bg-black']) ?>
            <?= Html::a(Module::t('settings', 'Create More'), ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a(Module::t('settings', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a(
                Module::t('settings', 'Delete'),
                ['delete', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Module::t('settings', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]
            ) ?>
        </div>
        <div class="card-body">
            <?=
            DetailView::widget(
                [
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'type',
                        'section',
                        'active:boolean',
                        'key',
                        'value:ntext',
                        'created:datetime',
                        'modified:datetime',
                    ],
                ]
            ) ?>
        </div>
        <div class="card-footer text-muted">
            Yii2 Settings By <?= Html::a('Phemel', Url::to('https://github.com/phemellc/yii2-settings'),[
                'target' => '_blank'
            ]) ?>
        </div>
    </div>




</div>
