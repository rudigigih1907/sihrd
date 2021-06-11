<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
echo "<?php\n";
?>
use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">
    <div class="card shadow" id="crud">

        <div class="card-header p-3">
            <?= "<?= " ?>Html::a(FAS::icon(FAS::_PLUS_CIRCLE).<?= $generator->generateString( ' Create ' .
                Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, ['create'], ['class' => 'btn btn-primary']) ?>
        </div>
    <?="<?php try { 
            echo "?>GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => require(__DIR__.'/_columns.php'),
                        'headerRowOptions' => [
                            'class' => 'text-nowrap'
                        ]
                    ]);
            }catch(Exception $e){
                echo $e->getMessage();
            }<?="?>\n"?>
    </div>
</div>