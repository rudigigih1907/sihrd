<?php

use yii\base\InvalidConfigException;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$labelID = empty($generator->labelID) ? $generator->getNameAttribute() : $generator->labelID;

echo "<?php\n";
?>
use yii\bootstrap4\Tabs;
use yii\widgets\DetailView;
use app\widgets\Table;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?= $labelID ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $modelsDetail = StringHelper::basename($generator->modelsClassDetail); ?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">

    <div class="card shadow">
        <div class="card-header p-3">
            <div class="d-flex justify-content-start">

                <div class="mr-auto">
                    <?= "<?= " ?>Html::a(FAS::icon(FAS::_ARROW_LEFT). <?= $generator->generateString(' Kembali') ?>, Yii::$app->request->referrer, ['class' => 'btn btn-secondary']) ?>
                </div>

                <div class="mx-1">
                    <?= "<?= " ?>Html::a(FAS::icon(FAS::_PLUS). <?= $generator->generateString(' Buat Lagi') ?>, ['create'], ['class' => 'btn btn-primary']) ?>
                </div>

                <div class="mr-1">
                    <?= "<?= " ?>Html::a(FAS::icon(FAS::_LIST). <?= $generator->generateString(' Index') ?>, ['index'], ['class' => 'btn btn-primary']) ?>
                </div>

                <div class="mr-1">
                    <?= "<?= " ?>Html::a(FAS::icon(FAS::_PEN). <?= $generator->generateString(' Update') ?>, ['update', <?= $urlParams ?>, 'page' => Yii::$app->request->getQueryParam('page', null)], ['class' => 'btn btn-primary']) ?>
                </div>

                <?= "<?php " ?>
                if(Helper::checkRoute('delete')) :
                echo Html::a(FAS::icon(FAS::_TRASH). <?= $generator->generateString(' Hapus') ?>, ['delete', <?= $urlParams ?>, 'page' => Yii::$app->request->getQueryParam('page', null)], [
                'class' => 'btn btn-danger',
                'data' => [
                'confirm' => <?= $generator->generateString('Are you sure you want to delete this item?') ?>,
                'method' => 'post',
                ],
                ]);
                endif;
                ?>
            </div>
        </div>

    <?php $timestamp = ['created_at', 'updated_at',] ?>
    <?php $blameable = ['created_by', 'updated_by',] ?>
    <?php $details = lcfirst(Inflector::camelize(Inflector::pluralize(StringHelper::basename($modelsDetail))));  ?>


    <?= "<?php try { echo "?>Tabs::widget([
                'encodeLabels' => false,
                'navType' => 'nav-tabs justify-content-start border-0',
                'tabContentOptions' => [
                    'class' => 'p-0'
                ],
                'items' => [
                    [
                        'active' => true,
                        'headerOptions' => [
                            'class' => 'pl-3'
                        ],
                        'label' => FAS::icon(FAS::_YIN_YANG) . ' <?= Inflector::camel2words(StringHelper::basename($generator->modelClass)) ?>',
                        'content' =>
                            DetailView::widget([
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
                                                    "                    'value' => function(\$model){ return \app\models\User::findOne(\$model->$column->name)->username ?? null; }" .
                                                    "            \n           ],\n";
                                                continue;
                                            }

                                            echo "'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                        }
                                    } ?>
                                ],
                            ]) ,

                        ],
                        [
                            'label' => '<?= Inflector::camel2words(StringHelper::basename($modelsDetail)) ?>',
                            'content' =>

                                !empty( $model-><?= $details?>) ?
                                    Table::widget([
                                        'data' => $model-><?= $details . "\n"?>
                                    ])
                                :

                                    Html::tag("p", '<?= Inflector::camel2words(StringHelper::basename($modelsDetail)) ?> tidak tersedia', [
                                        'class' => 'text-warning font-weight-bold p-3'
                                    ])
                            ,
                        ],
                    ],
                ]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
    ?>

    </div>
</div>