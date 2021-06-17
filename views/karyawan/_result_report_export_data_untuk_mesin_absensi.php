<?php

/* @var $this \yii\web\View */

/* @var $data */

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;

$this->title = 'Hasil Data Untuk Mesin Absensi';
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="karyawan-view">

    <div class="card shadow">
        <div class="card-header p-3">

            <?=
            Html::a(FAS::icon(FAS::_ARROW_LEFT) . ' Kembali',
                Yii::$app->request->referrer,
                ['class' => 'btn btn-secondary'])
            ?>

            <?=
            Html::a(FAS::icon(FAS::_FILE_EXCEL) . ' Excel',
                ['create'],
                ['class' => 'btn btn-success'])
            ?>
        </div>

        <?php try {
            echo yii\grid\GridView::widget([
                'dataProvider' => new yii\data\ArrayDataProvider([
                    'models' => $data,
                    'pagination' => false
                ]),
                'tableOptions' => [
                    'class' => 'card-table table'
                ],
                'columns' => []
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        } ?>

    </div>

</div>
