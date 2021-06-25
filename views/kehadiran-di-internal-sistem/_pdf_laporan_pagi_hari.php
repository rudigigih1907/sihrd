<?php



/* @var $this \yii\web\View */
/* @var $records array */
/* @var $tanggal string */
$formatter = Yii::$app->formatter;

use yii\grid\GridView;
use yii\helpers\Html; ?>

<div class="kehadiran-di-internal-sistem-index">

    <p>Rekapan Masuk Kerja (Pagi)</p>
    <p>Absensi Per Tanggal : <b><?= Yii::$app->formatter->asDate($tanggal) ?></b> </p>
    <?php try {
        echo GridView::widget([
            'tableOptions' => [
                'class' => 'table table-gridview'
            ],
            'dataProvider' => new yii\data\ArrayDataProvider([
                'models' => $records,
                'pagination' => false
            ]),
            'layout' => '{items}',
            'columns' => require(__DIR__ . '/_columns_laporan_harian_pagi.php'),
        ]);
    } catch (Exception $e) {
        echo $e->getMessage();
    } ?>
</div>
