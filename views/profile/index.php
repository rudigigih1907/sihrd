<?php

use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this \yii\web\View */
/* @var $model \app\models\Karyawan|array|null */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Profile Anda', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="profile-index">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">

                <div class="card-header p-3">
                    <?= FAS::icon(FAS::_USER_COG) ?> Biodata Anda
                </div>
                <div class="table-responsive" style=" max-height: 358px ">
                    <?=
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
                        ],
                    ])
                ?>
                </div>
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

    <div class="row mt-3">
        <div class="col">
            <div class="card shadow">
                <div class="card-header p-3">
                    <?= FAS::icon(FAS::_MAP_MARKER) ?> Alamat Anda
                </div>
                <?=
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

                ?>
            </div>

        </div>
    </div>


    <div class="row mt-3">
        <div class="col">
            <div class="card shadow">
                <div class="card-header p-3">
                    <?= FAS::icon(FAS::_CHART_LINE) ?> Struktur Organisasi
                </div>

                <?=
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
                ?>

            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="card shadow">
                <div class="card-header p-3">
                    <?= FAS::icon(FAS::_TAXI) ?> PTKP / Kerabat ditanggung karyawan
                </div>

                <?=
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
                ?>

            </div>
        </div>
    </div>
</div>
