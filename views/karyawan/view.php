<?php

use app\widgets\Table;
use mdm\admin\components\Helper;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Karyawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="karyawan-view">

    <div class="card shadow">
        <div class="card-header p-3">
            <div class="d-flex justify-content-start">

                <div class="mr-auto">
                    <?= Html::a(FAS::icon(FAS::_ARROW_LEFT) . ' Kembali', Yii::$app->request->referrer, ['class' => 'btn btn-secondary']) ?>
                </div>

                <div class="mx-1">
                    <?= Html::a(FAS::icon(FAS::_PLUS) . ' Buat Lagi', ['create'], ['class' => 'btn btn-primary']) ?>
                </div>

                <div class="mr-1">
                    <?= Html::a(FAS::icon(FAS::_LIST) . ' Index', ['index'], ['class' => 'btn btn-primary']) ?>
                </div>

                <div class="mr-1">
                    <?= Html::a(FAS::icon(FAS::_PEN) . ' Update', ['update', 'id' => $model->id, 'page' => Yii::$app->request->getQueryParam('page', null)], ['class' => 'btn btn-primary']) ?>
                </div>

                <div class="mr-1">
                    <?= Html::a(FAS::icon(FAS::_CHAIR) . ' Manage PTKP', ['manage-ptkp', 'id' => $model->id, 'page' => Yii::$app->request->getQueryParam('page', null)], ['class' => 'btn btn-success']) ?>
                </div>


                <div class="mr-1">
                    <?= Html::a(FAS::icon(FAS::_CHAIR) . ' Manage Jabatan', ['manage-jabatan', 'id' => $model->id, 'page' => Yii::$app->request->getQueryParam('page', null)], ['class' => 'btn btn-success']) ?>
                </div>

                <?php if (Helper::checkRoute('delete')) :
                    echo Html::a(FAS::icon(FAS::_TRASH) . ' Hapus', ['delete', 'id' => $model->id, 'page' => Yii::$app->request->getQueryParam('page', null)], [
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


        <?php try {
            echo Tabs::widget([
                'encodeLabels' => false,
                'navType' => 'nav-tabs justify-content-start border-0',
                'tabContentOptions' => [
                    'class' => 'p-0'
                ],
                'items' => [
                    [
                        'active' => true,
                        'headerOptions' => [
                            'class' => 'pl-3'
                        ],
                        'label' => FAS::icon(FAS::_YIN_YANG) . ' Karyawan',
                        'content' =>
                            DetailView::widget([
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
                                    [
                                        'attribute' => 'jadwal_kerja_id',
                                        'format' => 'raw',
                                        'value' => function ($model) {
                                            return
                                                Html::a($model->jadwalKerja->nama,
                                                    ['jadwal-kerja/view', 'id' => $model->jadwalKerja->id],
                                                    ['class' => 'btn btn-link']);
                                        }
                                    ],
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
                                            return \app\models\User::findOne($model->created_by)->username ?? null;
                                        }
                                    ],
                                    [
                                        'attribute' => 'updated_by',
                                        'value' => function ($model) {
                                            return \app\models\User::findOne($model->updated_by)->username ?? null;
                                        }
                                    ],
                                ],
                            ]) ,

                        ],
                    [
                        'label' => 'Alamat',
                        'content' =>

                            !empty($model->alamatKaryawans) ?
                                Table::widget([
                                    'data' => $model->alamatKaryawans,
                                    'skippedColumns' => [
                                        'karyawan_id'
                                    ]
                                ])
                                :

                                Html::tag("p", 'Alamat Karyawan tidak tersedia', [
                                    'class' => 'text-warning font-weight-bold p-3'
                                ])
                        ,
                    ],
                    [
                        'label' => 'Jabatan',
                        'content' =>

                            !empty($model->karyawanStrukturOrganisasis) ?
                                \yii\grid\GridView::widget([
                                    'layout' => "{items}",
                                    'dataProvider' =>
                                        new \yii\data\ActiveDataProvider([
                                            'models' => $model->karyawanStrukturOrganisasis,
                                            'pagination' => false
                                        ]),
                                    'headerRowOptions' => [
                                        'class' => 'text-center'
                                    ],
                                    'columns' => [
                                        [
                                            'attribute' => 'karyawan_id',
                                            'value' => 'karyawan.nama'
                                        ],
                                        [
                                            'attribute' => 'struktur_organisasi_id',
                                            'format' => 'raw',
                                            'value' => function($model){
                                                /** @var \app\models\KaryawanStrukturOrganisasi $model */
                                                return Html::a($model->strukturOrganisasi->nama, ['/struktur-organisasi/view', 'id'=> $model->struktur_organisasi_id],[
                                                        'class' => 'btn btn-link'
                                                ]);
                                            }
                                        ],
                                        'nomor_surat_pengangkatan',
                                        'tanggal_aktif:date',
                                        'tanggal_berakhir:date',
                                        'alasan_berakhir'
                                    ]
                                ])
                                :
                                Html::tag("p", 'Jabatan Karyawan tidak tersedia', [
                                    'class' => 'text-danger font-weight-bold p-3'
                                ])
                        ,
                    ],
                    [
                        'label' => 'PTKP',
                        'content' =>

                            !empty($model->karyawanPtkps) ?
                                \yii\grid\GridView::widget([
                                    'layout' => "{items}",
                                    'dataProvider' =>
                                        new \yii\data\ActiveDataProvider([
                                            'models' => $model->karyawanPtkps,
                                            'pagination' => false
                                        ]),
                                    'headerRowOptions' => [
                                        'class' => 'text-center'
                                    ],
                                    'columns' => [
                                        [
                                            'class' => 'yii\grid\SerialColumn',
                                        ],
                                        [
                                            'class' => '\yii\grid\DataColumn',
                                            'attribute' => 'hubungan_ptkp_id',
                                            'value' => 'hubunganPtkp.nama',
                                        ],
                                        [
                                            'class' => '\yii\grid\DataColumn',
                                            'attribute' => 'nama_tanggungan',
                                        ],
                                        [
                                            'class' => '\yii\grid\DataColumn',
                                            'attribute' => 'tempat_lahir',
                                        ],
                                        [
                                            'class' => '\yii\grid\DataColumn',
                                            'attribute' => 'tanggal_lahir',
                                            'format' => 'date'
                                        ],
                                        [
                                            'class' => '\yii\grid\DataColumn',
                                            'attribute' => 'terhitung_sebagai_ptkp',
                                        ],
                                        [
                                            'class' => '\yii\grid\DataColumn',
                                            'attribute' => 'batal_ptkp_id',
                                            'value' => 'batalPtkp.nama'
                                        ],
                                    ]
                                ])
                                :
                                Html::tag("p", 'PTKP tidak tersedia', [
                                    'class' => 'text-danger font-weight-bold p-3'
                                ])
                        ,
                    ],
                ],
                ]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
    ?>

    </div>
</div>