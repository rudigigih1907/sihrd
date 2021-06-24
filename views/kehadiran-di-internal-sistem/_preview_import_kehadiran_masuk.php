<?php


/* @var $this \yii\web\View */

/* @var $models array */
/* @var $jadwalKerja array */
/* @var $jadwalKerjaHari array */
/* @var $jamKerja array */

/* @var $karyawan array */

use rmrevin\yii\fontawesome\FAS;
use unclead\multipleinput\TabularColumn;
use unclead\multipleinput\TabularInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Preview Kehadiran Masuk';
$this->params['breadcrumbs'][] = ['label' => 'Kehadiran Di Internal Sistem', 'url' => ['index', 'page' => Yii::$app->request->getQueryParam('page', null)]];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss(".readonly { cursor: not-allowed; } ")
?>


<div class="kehadiran-di-internal-sistem-index">
    <div class="card shadow">

        <div class="table-responsive pt-1">
            <?php
            $form = ActiveForm::begin([
                'id' => 'tabular-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => false,
                'validateOnChange' => false,
                'validateOnSubmit' => true,
                'validateOnBlur' => false,
            ]);
            ?>
            <?php
            try {
                echo TabularInput::widget([
                    'id' => 'some-id',
                    'models' => $models,
                    'rendererClass' => \app\components\renderers\TableRenderer::class,
                    'removeButtonOptions' => [
                        'class' => 'btn btn-block btn-danger',
                        'label' => '<i class="fas fa-trash"></i>'
                    ],
                    'allowEmptyList' => true,
                    'attributeOptions' => [
                        'enableAjaxValidation' => true,
                        'enableClientValidation' => false,
                        'validateOnChange' => false,
                        'validateOnSubmit' => true,
                        'validateOnBlur' => false,
                    ],
                    'columns' => [
                        [
                            'name' => 'id',
                            'title' => 'ID',
                            'enableError' => true,
                            'type' => TabularColumn::TYPE_HIDDEN_INPUT,
                        ],
                        [
                            'name' => 'jadwal_kerja_id',
                            'title' => 'Jadwal Kerja',
                            'type' => TabularColumn::TYPE_HIDDEN_INPUT,

                        ],
                        [
                            'title' => 'Jadwal Kerja',
                            'name' => 'readonlyJadwalKerja',
                            'options' => [
                                'readonly' => true,
                                'class' => 'readonly'
                            ]
                        ],

                        [
                            'name' => 'jadwal_kerja_hari_id',
                            'title' => 'Hari',
                            'enableError' => true,
                            'type' => TabularColumn::TYPE_HIDDEN_INPUT,
                        ],

                        [
                            'title' => 'Hari',
                            'name' => 'readonlyJadwalKerjaHari',
                            'options' => [
                                'readonly' => true,
                                'class' => 'readonly'
                            ],
                            'columnOptions' => [
                                'style' => 'width: 85px;',
                            ],
                        ],


                        [
                            'name' => 'jam_kerja_id',
                            'title' => 'Jam Kerja',
                            'enableError' => true,
                            'type' => TabularColumn::TYPE_HIDDEN_INPUT,
                        ],

                        [
                            'name' => 'readonlyJamKerja',
                            'title' => 'Jam Kerja',
                            'options' => [
                                'readonly' => true,
                                'class' => 'readonly'
                            ]
                        ],
                        [
                            'name' => 'ketentuan_masuk',
                            'title' => 'Ketentuan Masuk',
                            'enableError' => true,
                            'type' => TabularColumn::TYPE_HIDDEN_INPUT,
                        ],
                        [
                            'name' => 'readonlyKetentuanMasuk',
                            'title' => 'Ketentuan Masuk',
                            'enableError' => true,
                            'options' => [
                                'readonly' => true,
                                'class' => 'readonly'
                            ],
                            'columnOptions' => [
                                'style' => 'width: 162px;',
                            ],
                        ],
                        [
                            'name' => 'ketentuan_pulang',
                            'title' => 'Ketentuan Pulang',
                            'enableError' => true,
                            'type' => TabularColumn::TYPE_HIDDEN_INPUT,
                        ],
                        [
                            'name' => 'readonlyKetentuanPulang',
                            'title' => 'Ketentuan Pulang',
                            'enableError' => true,
                            'options' => [
                                'readonly' => true,
                                'class' => 'readonly'
                            ],
                            'columnOptions' => [
                                'style' => 'width: 162px;',
                            ],
                        ],
                        [
                            'name' => 'karyawan_id',
                            'title' => 'Karyawan',
                            'enableError' => true,
                            'options' => [
                                'readonly' => true,
                                'class' => 'readonly'
                            ],
                            'type' => TabularColumn::TYPE_HIDDEN_INPUT,
                        ],
                        [
                            'name' => 'readonlyKaryawan',
                            'title' => 'Karyawan',
                            'enableError' => true,
                            'options' => [
                                'readonly' => true,
                                'class' => 'readonly'
                            ],
                            'columnOptions' => [
                                'style' => 'width: 244px;',
                            ],
                        ],
                        [
                            'name' => 'aktual_masuk',
                            'title' => 'Aktual Masuk',
                            'enableError' => true,
                            'errorOptions' => ['class' => 'help-block invalid-feedback'],
                            'columnOptions' => [
                                'style' => 'width: 162px;',
                            ],
                            'type' => kartik\widgets\DateTimePicker::class,
                        ],
                    ],
                ]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['index'], ['class' => 'btn btn-secondary']) ?>
                <?= Html::submitButton(FAS::icon(FAS::_SAVE) . ' Simpan', [
                    'class' => 'btn btn-primary',
//                    'data' => [
//                        'confirm' => 'Anda akan mengupload data karyawan masuk hari ini ? '
//                    ]
                ]) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
