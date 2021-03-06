<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\StrukturOrganisasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Struktur Organisasi';
$this->params['breadcrumbs'][] = $this->title;
\app\assets\TreeFlexAsset::register($this);
?>
<div class="struktur-organisasi-index">

    <div class="card shadow" id="crud">

        <div class="card-header p-3">
            <?= Html::a(FAS::icon(FAS::_PLUS_CIRCLE).' Tambah', ['create'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(FAS::icon(FAS::_TREE).' Generate Diagram', ['generate-diagram'], ['class' => 'btn btn-primary']) ?>
        </div>

        <?php try { 
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => require(__DIR__.'/_columns.php'),
                'tableOptions' => [
                    'class' => 'card-table table table-sm small table-striped table-fixes-last-column'
                ],

            ]);
        } catch(Exception $e){
            echo $e->getMessage();
        }?>

    </div>

</div>

