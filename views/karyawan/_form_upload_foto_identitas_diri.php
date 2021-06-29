<?php


/* @var $this \yii\web\View */

use kartik\file\FileInput;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model \app\models\Karyawan */

$this->title = 'Photo ' . ucwords(strtolower( $model->nama));
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="karyawan-form">

    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card shadow">
                <div class="card-body">

                    <?php
                    try {
                        echo FileInput::widget([
                            'id' => 'file_data',
                            'name' => 'file_data',
                            'options' => [
                                //'accept' => 'image/*',
                                //'multiple' => false
                            ],
                            'pluginOptions' => [
                                'uploadClass' => 'btn btn-success',
                                'uploadUrl' => Url::to(['handle-upload-photo-identintas-diri']),
                                'uploadExtraData' => [
                                    'id' => $model->id,
                                    'nik' => $model->nomor_induk_karyawan,
                                    'nama' => $model->nama
                                ],
                            ]
                        ]);
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    } ?>

                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-start">
                        <?= Html::a(FAS::icon(FAS::_USER) . ' Lihat Profil',
                            ['karyawan/view', 'id' => $model->id],
                            ['class' => 'btn btn-secondary'])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
