<?php

use mdm\admin\components\Helper;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */


$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Karyawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="karyawan-view">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="card shadow">

                <div class="card-header border-bottom">
                    <?= FAS::icon(FAS::_USER_CIRCLE) ?> Detail Karyawan
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-start">

                        <div class="mr-auto">
                            <?= Html::a(FAS::icon(FAS::_ARROW_LEFT) . ' Back', Yii::$app->request->referrer, ['class' => 'btn btn-secondary']) ?>
                        </div>

                        <div class="mx-1">
                            <?= Html::a(FAS::icon(FAS::_PLUS) . ' Create More', ['create'], ['class' => 'btn btn-primary']) ?>
                        </div>

                        <div class="mr-1">
                            <?= Html::a(FAS::icon(FAS::_LIST) . ' Index', ['index'], ['class' => 'btn btn-primary']) ?>
                        </div>

                        <div class="mr-1">
                            <?= Html::a(FAS::icon(FAS::_PEN) . ' Update', ['update', 'id' => $model->id, 'page' => Yii::$app->request->getQueryParam('page', null)], ['class' => 'btn btn-primary']) ?>
                        </div>

                        <?php if (Helper::checkRoute('delete')) :
                            echo Html::a(FAS::icon(FAS::_TRASH) . ' Delete', ['delete', 'id' => $model->id, 'page' => Yii::$app->request->getQueryParam('page', null)], [
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
                    'options' => [
                        'class' => 'table table-bordered'
                    ],
                    'model' => $model,
                    'attributes' => [
                        'nomor_induk_karyawan',
                        'nama',
                        'nama_panggilan',
                        'tempat_lahir',
                        'tanggal_lahir',
                        'status_kewarganegaraan',
                        'nomor_kartu_tanda_penduduk',
                        'nomor_kartu_keluarga',
                        'nomor_pokok_wajib_pajak',
                        'nomor_kitas_atau_sejenisnya',
                        'jenis_kelamin',
                        'agama_id',
                        'status_perkawinan_id',
                        'nama_ayah',
                        'nama_ibu',
                        'pendidikan_terakhir',
                        'tanggal_mulai_bekerja',
                        'tanggal_berhenti_bekerja',
                        'alasan_berhenti_bekerja',
                        [
                            'attribute' => 'created_at',
                            'format' => 'datetime',
                        ],
                        [
                            'attribute' => 'updated_at',
                            'format' => 'datetime',
                        ],
                        [
                            'attribute' => 'created_by',
                            'value' => function ($model) {
                                return app\models\User::findOne($model->created_by)->username;
                            }
                        ],
                        [
                            'attribute' => 'updated_by',
                            'value' => function ($model) {
                                return app\models\User::findOne($model->updated_by)->username;
                            }
                        ],
                    ],
                ]) ?>

            </div>
        </div>

        <div class="col-sm-12 col-md-6">

            <div class="card shadow mb-3">
                <div class="card-header border-bottom">
                    <?= FAS::icon(FAS::_PHOTO_VIDEO) ?> Photo
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header border-bottom">
                    <?= FAS::icon(FAS::_MAP_MARKER) ?> Alamat
                </div>
            </div>
        </div>

    </div>

</div>