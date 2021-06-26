<?php


/* @var $this View */

use app\components\renderers\ListRenderer;
use app\models\Karyawan;
use app\models\KaryawanStrukturOrganisasi;
use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;
use unclead\multipleinput\TabularColumn;
use unclead\multipleinput\TabularInput;
use yii\bootstrap4\Html;
use yii\web\View;

/* @var $model Karyawan */
/* @var $models KaryawanStrukturOrganisasi[]|array */

$this->title = 'Update Jabatan: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$template = ['template' => '{input}{error}'];
?>

<div class="karyawan-form">


    <div class="card shadow">
        <?php
        $form = ActiveForm::begin([
            'id' => 'tabular-form',
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL],
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
            'validateOnChange' => false,
            'validateOnSubmit' => true,
            'validateOnBlur' => false,
        ]);
        ?>

        <div class="table-responsive">

            <?php
            echo TabularInput::widget([
                'options' => [
                    'class' => 'card-table table'
                ],
                'id' => 'some-id',
                'rendererClass' => \app\components\renderers\TableRenderer::class,
                'models' => $models,
                /*'layoutConfig' => [
                    'offsetClass' => 'offset-3',
                    'labelClass' => 'col-sm-4 col-form-label',
                    'wrapperClass' => 'col-sm-8',
                    'errorClass' => 'offset-4 text-danger',
                ],*/
                'addButtonPosition' => TabularInput::POS_FOOTER,
                'addButtonOptions' => [
                    'class' => 'btn btn-block btn-success',
                    'label' => '<i class="fas fa-plus"></i>'
                ],
                'removeButtonOptions' => [
                    'class' => 'btn btn-block btn-danger',
                    'label' => '<i class="fas fa-trash"></i>'
                ],
                'cloneButtonOptions' => [
                    'class' => 'btn btn-block btn-secondary',
                    'label' => '<i class="fas fa-copy"></i>'
                ],
                'allowEmptyList' => false,
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
                        'name' => 'karyawan_id',
                        'title' => 'Karyawan',
                        'enableError' => true,
                        'defaultValue' => $model->id,
                        'type' => TabularColumn::TYPE_HIDDEN_INPUT,
                    ],
                    [
                        'name' => 'jenis_jabatan',
                        'title' => 'Jenis Jabatan',
                        'type' => kartik\select2\Select2::class,
                        'options' => [
                            'data' => KaryawanStrukturOrganisasi::optsJenisJabatan(),
                            'pluginOptions' => [
                                'dropdownAutoWidth' => true,
                            ]
                        ],
                        'enableError' => true,
                        'errorOptions' => ['class' => 'help-block invalid-feedback']
                    ],
                    [
                        'name' => 'struktur_organisasi_id',
                        'title' => 'Struktur',
                        'type' => kartik\select2\Select2::class,
                        'enableError' => true,
                        'options' => [
                            'data' => app\models\StrukturOrganisasi::mapIDToNamaKhususJabatanSaja(),
                            'options' => [
                                'prompt' => '-',
                                'style' => [
                                    'width' => '2px'
                                ],

                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'dropdownAutoWidth' => true,
                                'placeholder' => "= Pilih Jabatan =",
                                'style' => [
                                    'width' => '2px'
                                ],
                            ]
                        ],
                        'errorOptions' => ['class' => 'help-block invalid-feedback'],
                        'columnOptions' => [
                            'style' => [
                                'width' => '2px'
                            ],
                        ],
                    ],
                    [
                        'name' => 'nomor_surat_pengangkatan',
                        'title' => 'Surat Pengangkatan',
                        'enableError' => true,
                        'errorOptions' => ['class' => 'help-block invalid-feedback']
                    ],
                    [
                        'name' => 'tanggal_aktif',
                        'type' => \kartik\date\DatePicker::class,
                        'title' => 'Tanggal Aktif',
                        'enableError' => true,
                        'options' => [
                            'type' => \kartik\date\DatePicker::TYPE_INPUT,
                            'pluginOptions' => [
                                'format' => 'dd-mm-yyyy',
                                'todayHighlight' => true
                            ]
                        ],
                        'errorOptions' => ['class' => 'help-block invalid-feedback']
                    ],
                    [
                        'name' => 'tanggal_berakhir',
                        'type' => \kartik\date\DatePicker::class,
                        'title' => 'Tanggal Berakhir',
                        'enableError' => true,
                        'options' => [
                            'type' => \kartik\date\DatePicker::TYPE_INPUT,
                            'pluginOptions' => [
                                'format' => 'dd-mm-yyyy',
                                'todayHighlight' => true
                            ]
                        ],
                        'errorOptions' => ['class' => 'help-block invalid-feedback']
                    ],
                    [
                        'name' => 'alasan_berakhir',
                        'title' => 'Alasan Berakhir',
                        'enableError' => true,
                        'errorOptions' => ['class' => 'help-block invalid-feedback']
                    ],
                ],
            ]);
            ?>

            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <?= Html::submitButton(FAS::icon(FAS::_SAVE) . ' Save', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
