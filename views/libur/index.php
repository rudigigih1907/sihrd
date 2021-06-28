<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\LiburSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Libur';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="libur-index">

    <div class="card shadow" id="crud">

        <div class="card-header p-3">
            <?= Html::a(FAS::icon(FAS::_PLUS_CIRCLE).' Tambah Libur', ['create'], ['class' => 'btn btn-primary']) ?>
        </div>

        <?php try { 
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => require(__DIR__.'/_columns.php'),
            ]);
        } catch(Exception $e){
            echo $e->getMessage();
        }?>

    </div>

</div>

