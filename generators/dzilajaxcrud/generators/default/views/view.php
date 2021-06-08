<?php

use yii\base\InvalidConfigException;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">

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



            echo "            '" . $name . "',\n";
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

</div>