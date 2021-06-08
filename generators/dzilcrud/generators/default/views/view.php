<?php

use yii\base\InvalidConfigException;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */


$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">
    <div class="card shadow">
        <div class="card-header p-3">

                <?= "<?= " ?>Html::a(FAS::icon(FAS::_ARROW_LEFT). <?= $generator->generateString(' Back') ?>, Yii::$app->request->referrer, ['class' => 'btn btn-outline-secondary']) ?>
                <?= "<?= " ?>Html::a(FAS::icon(FAS::_PLUS). <?= $generator->generateString(' Create More') ?>, ['create'], ['class' => 'btn btn-outline-primary']) ?>
                <?= "<?= " ?>Html::a(FAS::icon(FAS::_LIST). <?= $generator->generateString(' Index') ?>, ['index'], ['class' => 'btn btn-outline-primary']) ?>
                <?= "<?= " ?>Html::a(FAS::icon(FAS::_PEN). <?= $generator->generateString(' Update') ?>, ['update', <?= $urlParams ?>], ['class' => 'btn btn-primary']) ?>
                <?= "<?= " ?>Html::a(FAS::icon(FAS::_TRASH). <?= $generator->generateString(' Delete') ?>, ['delete', <?= $urlParams ?>], [
                'class' => 'btn btn-danger',
                'data' => [
                'confirm' => <?= $generator->generateString('Are you sure you want to delete this item?') ?>,
                'method' => 'post',
                ],
                ]) ?>

        </div>

    <?php $timestamp = ['created_at', 'updated_at',] ?>
    <?php $blameable = ['created_by', 'updated_by',] ?>
<?= "<?= " ?>DetailView::widget([
        'model' => $model,
        'attributes' => [
    <?php
    if (($tableSchema = $generator->getTableSchema()) === false) {
        foreach ($generator->getColumnNames() as $name) {

            if ($name == 'id') {
                continue;
            }
            echo "'" . $name . "',\n";
        }
    } else {
        foreach ($generator->getTableSchema()->columns as $column) {

            if( $column->name == 'id'){
                continue;
            }

            $format = $generator->generateColumnFormat($column);

            if(in_array($column->name, $timestamp)){
                echo "           [
                    'attribute' => '" . $column->name . "',\n" .
                    "                    'format' => 'datetime'," .
                    "            \n           ],\n";
                continue;
            }


            if(in_array($column->name, $blameable)){
                echo "           [
                    'attribute' => '" . $column->name . "',\n" .
                    "                    'value' => function(\$model){ return app\models\User::findOne(\$model->$column->name)->username; }" .
                    "            \n           ],\n";
                continue;
            }

            echo "           '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    } ?>
        ],
    ]) ?>


    <div class="card-footer"></div>
</div>