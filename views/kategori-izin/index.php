<?php
use yii\helpers\Html;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\KategoriIzinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori Izin';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="kategori-izin-index">
    <div class="card shadow" id="crud">

        <div class="card-header p-3">
            <?= Html::a(FAS::icon(FAS::_PLUS_CIRCLE).' Tambah Kategori Izin', ['create'], ['class' => 'btn btn-primary']) ?>
        </div>
    <?php try { 
            echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => require(__DIR__.'/_columns.php'),
                        'headerRowOptions' => [
                            'class' => 'text-nowrap'
                        ]
                    ]);
            }catch(Exception $e){
                echo $e->getMessage();
            }?>
    </div>
</div>