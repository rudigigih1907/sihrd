<?php

use rmrevin\yii\fontawesome\FAS;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\FormPerubahanDataKaryawanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Form Perubahan Data Karyawan';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="form-perubahan-data-karyawan-index">
    <div class="card shadow" id="crud">

        <div class="card-header p-3">
            <?= Html::a(FAS::icon(FAS::_FILE) . ' Laporan Periode', ['laporan-periode'], ['class' => 'btn btn-success']) ?>
        </div>
        <?php try {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => require(__DIR__ . '/_columns.php'),
                'tableOptions' => [
                    'class' => 'card-table table table-striped table-fixes-last-column'
                ],
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        } ?>
    </div>
</div>