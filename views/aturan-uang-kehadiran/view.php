<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FAS;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\AturanUangKehadiran */


$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Aturan Uang Kehadiran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aturan-uang-kehadiran-view">
    <div class="card shadow">
        <div class="card-header p-3">
            <div class="d-flex justify-content-start">

                <div class="mr-auto">
                    <?= Html::a(FAS::icon(FAS::_ARROW_LEFT). ' Kembali',
                    Yii::$app->request->referrer, ['class' => 'btn btn-secondary']) ?>
                </div>

                <div class="mx-1">
                    <?= Html::a(FAS::icon(FAS::_PLUS). ' Buat Lagi',
                    ['create'], ['class' => 'btn btn-primary']) ?>
                </div>

                <div class="mr-1">
                    <?= Html::a(FAS::icon(FAS::_LIST). ' Index', ['index'],
                    ['class' => 'btn btn-primary']) ?>
                </div>

                <div class="mr-1">
                    <?= Html::a(FAS::icon(FAS::_PEN). ' Update',
                    ['update', 'id' => $model->id, 'page' => Yii::$app->request->getQueryParam('page', null)], ['class'
                    => 'btn btn-primary']) ?>
                </div>

                <?php                 if(Helper::checkRoute('delete')) :
                echo Html::a(FAS::icon(FAS::_TRASH). ' Hapus',
                ['delete', 'id' => $model->id, 'page' => Yii::$app->request->getQueryParam('page', null)], [
                'class' => 'btn btn-danger',
                'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
                ],
                ]);
                endif;
                ?>
            </div>
        </div>

                        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
                   'nama',
           'keterangan:ntext',
           'is_dapat_uang_kehadiran',
           'is_aktif',
        ],
        ]) ?>


        <div class="card-footer"></div>
    </div>
</div>