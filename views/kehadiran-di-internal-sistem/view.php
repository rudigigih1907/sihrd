<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use rmrevin\yii\fontawesome\FAS;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\KehadiranDiInternalSistem */


$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kehadiran Di Internal Sistem', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kehadiran-di-internal-sistem-view">
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
                   'jadwal_kerja_id',
           'jadwal_kerja_hari_id',
           'jam_kerja_id',
           'ketentuan_masuk',
           'ketentuan_pulang',
           'karyawan_id',
           'aktual_masuk',
           'aktual_pulang',
           'jenis_izin_id',
        ],
        ]) ?>


        <div class="card-footer"></div>
    </div>
</div>