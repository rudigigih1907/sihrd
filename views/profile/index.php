<?php

use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\Tabs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this \yii\web\View */
/* @var $model \app\models\Karyawan|array|null */
?>

<div class="profile-index">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header p-3">
                    <?= FAS::icon(FAS::_USER_COG) ?> Biodata Anda
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
                                            'tanggal_lahir:date',
                                            'status_kewarganegaraan',
                                            'nomor_kartu_tanda_penduduk',
                                            'nomor_kartu_keluarga',
                                            'nomor_pokok_wajib_pajak',
                                            'nomor_kitas_atau_sejenisnya',
                                            'jenis_kelamin',
                                            [
                                                'attribute' => 'agama_id',
                                                'value' => function ($model) {
                                                    return $model->agama->nama;
                                                }
                                            ],
                                            [
                                                'attribute' => 'status_perkawinan_id',
                                                'value' => function ($model) {
                                                    return $model->statusPerkawinan->nama;
                                                }
                                            ],

                                            'nama_ayah',
                                            'nama_ibu',
                                            'pendidikan_terakhir',
                                            [
                                                'attribute' => 'jadwal_kerja_id',
                                                'format' => 'raw',
                                                'value' => function ($model) {
                                                    return
                                                        Html::a($model->jadwalKerja->nama . ' ' . FAS::icon(FAS::_NEWSPAPER),
                                                            ['jadwal-kerja/view', 'id' => $model->jadwalKerja->id],
                                                            []);
                                                }
                                            ],
                                            'tanggal_mulai_bekerja:date',
                                            'tanggal_berhenti_bekerja:date',
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
                                    ]),

                            ],
                            [
                                'label' => 'Alamat',
                                'content' =>

                                    !empty($model->alamatKaryawans) ?
                                        Html::beginTag('div', ['class' => 'table-responsive']) .
                                        \yii\grid\GridView::widget([
                                            'layout' => "{items}",
                                            'dataProvider' =>
                                                new \yii\data\ActiveDataProvider([
                                                    'models' => $model->alamatKaryawans,
                                                    'pagination' => false
                                                ]),
                                            'headerRowOptions' => [
                                                'class' => 'text-center text-nowrap'
                                            ],
                                            'columns' => [
                                                [
                                                    'class' => 'yii\grid\SerialColumn',
                                                ],
                                                /* [
                                                 'class'=>'\yii\grid\DataColumn',
                                                 'attribute'=>'id',
                                                 ],*/
                                                /*[
                                                    'class'=>'\yii\grid\DataColumn',
                                                    'attribute'=>'karyawan_id',
                                                ],*/
                                                [
                                                    'class' => '\yii\grid\DataColumn',
                                                    'attribute' => 'type',
                                                ],
                                                [
                                                    'class' => '\yii\grid\DataColumn',
                                                    'attribute' => 'atas_nama',
                                                ],
                                                [
                                                    'class' => '\yii\grid\DataColumn',
                                                    'attribute' => 'jalan',
                                                ],
                                                [
                                                    'class' => '\yii\grid\DataColumn',
                                                    'attribute' => 'block',
                                                ],
                                                [
                                                    'class' => '\yii\grid\DataColumn',
                                                    'attribute' => 'nomor',
                                                ],
                                                [
                                                    'class' => '\yii\grid\DataColumn',
                                                    'attribute' => 'rt',
                                                ],
                                                [
                                                    'class' => '\yii\grid\DataColumn',
                                                    'attribute' => 'rw',
                                                ],
                                                [
                                                    'class' => '\yii\grid\DataColumn',
                                                    'attribute' => 'kecamatan',
                                                ],
                                                [
                                                    'class' => '\yii\grid\DataColumn',
                                                    'attribute' => 'kelurahan',
                                                ],
                                                [
                                                    'class' => '\yii\grid\DataColumn',
                                                    'attribute' => 'kabupaten',
                                                ],
                                                [
                                                    'class' => '\yii\grid\DataColumn',
                                                    'attribute' => 'propinsi',
                                                ],
                                                [
                                                    'class' => '\yii\grid\DataColumn',
                                                    'attribute' => 'kode_pos',
                                                ],
                                                [
                                                    'class' => '\yii\grid\DataColumn',
                                                    'attribute' => 'nomor_telepon',
                                                ],
                                                [
                                                    'class' => '\yii\grid\DataColumn',
                                                    'attribute' => 'email',
                                                ],
                                                [
                                                    'class' => '\yii\grid\DataColumn',
                                                    'attribute' => 'keterangan',
                                                ],

                                            ]
                                        ])
                                        . Html::endTag('div')
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

                                        Html::beginTag('div', ['class' => 'table-responsive'])
                                        . \yii\grid\GridView::widget([
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
                                                    'value' => 'jenis_jabatan'
                                                ],
                                                [
                                                    'attribute' => 'struktur_organisasi_id',
                                                    'format' => 'raw',
                                                    'value' => function ($model) {
                                                        /** @var \app\models\KaryawanStrukturOrganisasi $model */
                                                        return Html::a($model->strukturOrganisasi->nama, ['/struktur-organisasi/view', 'id' => $model->struktur_organisasi_id], [
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
                                        . Html::endTag('div')

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

                                        Html::beginTag('div', ['class' => 'table-responsive']) .
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
                                        . Html::endTag('div')
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
        <div class="col-md-4 text-center mt-3 mt-md-0 mt-lg-0">
            <div class="card shadow p-4 ">
                <?= Html::img(
                    $model->photo_identitas_diri, [
                    'alt' => 'Photo identitas belum tersedia',
                ]) ?>
            </div>
        </div>
    </div>
</div>
