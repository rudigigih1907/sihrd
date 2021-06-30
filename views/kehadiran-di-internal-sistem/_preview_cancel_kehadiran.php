<?php


use rmrevin\yii\fontawesome\FAS;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $data  array */
/* @var $tanggal */

$this->title = 'Preview Data Pembatalan ' . Yii::$app->formatter->asDate($tanggal);
$this->params['breadcrumbs'][] = ['label' => 'Kehadiran Di Internal Absensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('.table-responsive{ max-height: 488px }')
?>
<div class="card shadow" id="crud">


    <?php try {
        echo GridView::widget([
            'dataProvider' => new ArrayDataProvider([
                'models' => $data,
                'pagination' => false
            ]),
            'columns' => [],
            'layout' =>

                '<div class="card-body p-0">' .
                '<div class="table-responsive">' .
                "{items}" .
                '</div>' .
                '</div>' .
                '<div class="card-footer pt-4 pb-2">' .
                '<div class="d-flex justify-content-between">' . "{summary}" .
                Html::a(FAS::icon(FAS::_TRASH) . ' Hapus ', ['kehadiran-di-internal-sistem/cancel-kehadiran', 'tanggal' => $tanggal], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'method' => 'post',
                        'confirm' => 'Seluruh data pada tanggal: ' . Yii::$app->formatter->asDate($tanggal) . " dihapus, yakin ?"
                    ]
                ])
                . '</div>' .
                '</div>'
        ]);
    } catch (Exception $e) {
        echo $e->getMessage();
    } ?>

</div>
