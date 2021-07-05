<?php



/* @var $this \yii\web\View */
/* @var $records array */
/* @var $tanggal  */

use yii\grid\GridView; ?>

<div class="kehadiran-di-internal-sistem-index">

    <h2 class="text-primary">Rekapan Masuk Kerja Per Hari Group By Jam Kerja</h2>
    <p>Absensi Per Tanggal : <b><?= Yii::$app->formatter->asDate($tanggal) ?></b></p>

    <?php
    $batas = 1;
    $totalRecords = count($records)
    ?>
    <?php foreach ($records as $key => $record): ?>
        <?php echo yii\helpers\Html::tag('h2', $batas . '. ' . $key) ?>
        <br/>
        <?php try {
            echo GridView::widget([
                'tableOptions' => [
                    'class' => 'table table-gridview'
                ],
                'dataProvider' => new yii\data\ArrayDataProvider([
                    'models' => $record,
                    'pagination' => false
                ]),
                'layout' => '{items}',
                'columns' => require(__DIR__ . '/_columns_laporan_per_hari.php'),
            ]);


            if (($batas) < $totalRecords) {
                echo "<pagebreak>";
            }

            $batas++;
        } catch (Exception $e) {
            echo $e->getMessage();
        } ?>

    <?php endforeach; ?>


</div>
