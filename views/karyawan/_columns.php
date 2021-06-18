<?php

use app\models\Karyawan;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html;
use yii\helpers\Url;

return [

    [
        'class' => 'yii\grid\SerialColumn',
    ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'nomor_induk_karyawan',
    ],
    [
        'class' => '\yii\grid\DataColumn',
        'attribute' => 'nama',
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'nama_panggilan',
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'tempat_lahir',
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'tanggal_lahir',
        'format' => 'date'
    ],
    [
        'class'=>'\yii\grid\DataColumn',
        'attribute'=>'jadwal_kerja_id',
        'format' => 'raw',
        'value' => function ($model) {
            /** @var Karyawan $model */
            return
                Html::a($model->jadwalKerja->kode,
                    ['jadwal-kerja/view', 'id' => $model->jadwalKerja->id],
                    ['class' => 'text-primary']);
        }

    ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'status_kewarganegaraan',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'nomor_kartu_tanda_penduduk',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'nomor_kartu_keluarga',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'nomor_pokok_wajib_pajak',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'nomor_kitas_atau_sejenisnya',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'jenis_kelamin',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'agama_id',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'status_perkawinan_id',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'nama_ayah',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'nama_ibu',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'pendidikan_terakhir',
    // ],
    // [
        // 'class'=>'\yii\grid\DataColumn',
        // 'attribute'=>'tanggal_mulai_bekerja',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'tanggal_berhenti_bekerja',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'alasan_berhenti_bekerja',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'created_at',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'updated_at',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'created_by',
    // ],
    // [
    // 'class'=>'\yii\grid\DataColumn',
    // 'attribute'=>'updated_by',
    // ],

    [
        'class' => '\yii\grid\DataColumn',
        'label' => 'Total Jabatan',
        'headerOptions' => [
            'class' => 'text-right'
        ],
        'contentOptions' => [
            'class' => 'text-right'
        ],
        'format' => 'raw',
        'value' => function ($model) {
            /** @var Karyawan $model */
            return empty($model->countKaryawanStrukturOrganisasis)
                ? Html::tag('span', FAS::icon(FAS::_SAD_CRY), ['class' => 'text-danger'])
                : Html::tag('span', $model->countKaryawanStrukturOrganisasis, ['class' => 'text-primary font-weight-bold']);
        }
    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([
                $action,
                'id' => $model->id,
                'page' => Yii::$app->request->getQueryParam('page', null)
            ]);
        },
    ],

];   