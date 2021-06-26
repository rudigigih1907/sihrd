<?php



/* @var $this \yii\web\View */
/* @var $model \app\models\Karyawan */
/* @var $models \app\models\KaryawanPtkp[]|array */


use app\components\renderers\ListRenderer;
use rmrevin\yii\fontawesome\FAS;
use unclead\multipleinput\TabularColumn;
use unclead\multipleinput\TabularInput;
use kartik\widgets\ActiveForm;
use yii\bootstrap4\Html;
use yii\web\View;

$this->title = 'Manage PTKP: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="karyawan-form">


    <div class="card shadow">
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

        <?= $form->errorSummary($model) ?>
        <div class="table-responsive">

            <div class="card-body">
                <?php
                echo TabularInput::widget([
                    'options' => [
                        'class' => 'card-table table'
                    ],
                    'id' => 'some-id',
                    'rendererClass' => ListRenderer::class,
                    'models' => $models,
                    'layoutConfig' => [
                        'offsetClass' => 'offset-3',
                        'labelClass' => 'col-sm-4 col-form-label',
                        'wrapperClass' => 'col-sm-8',
                        'errorClass' => 'offset-2 text-danger',
                        'buttonActionClass' => '',
                    ],

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
                            'name' => 'hubungan_ptkp_id',
                            'title' => 'Hubungan PTKP',
                            'type' => kartik\select2\Select2::class,
                            'enableError' => true,
                            'options' => [
                                'data' => app\models\HubunganPtkp::mapIDToNama(),
                                'options' => [
                                    'prompt' => '-'
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'dropdownAutoWidth' => true,
                                    'placeholder' => " = "
                                ]
                            ],
                            'errorOptions' => ['class' => 'help-block invalid-feedback']
                        ],
                        [
                            'name' => 'nama_tanggungan',
                            'title' => 'Nama Tanggungan',
                            'enableError' => true,
                            'errorOptions' => ['class' => 'help-block invalid-feedback']
                        ],
                        [
                            'name' => 'tempat_lahir',
                            'title' => 'Tempat Lahir',
                            'enableError' => true,
                            'errorOptions' => ['class' => 'help-block invalid-feedback']
                        ],
                        [
                            'name' => 'tanggal_lahir',
                            'type' => \kartik\date\DatePicker::class,
                            'title' => 'Tanggal Lahir',
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
                            'name' => 'terhitung_sebagai_ptkp',
                            'title' => 'Terhitung PTKP',
                            'type'  => 'dropDownList',
                            'items' => \app\models\KaryawanPtkp::optsTerhitungSebagaiPtkp(),
                            'errorOptions' => ['class' => 'help-block invalid-feedback']
                        ],
                        [
                            'name' => 'batal_ptkp_id',
                            'title' => 'Alasan Tidak Terhitung',
                            'enableError' => true,
                            'type' => kartik\select2\Select2::class,
                            'options' => [
                                'data' => app\models\BatalPtkp::mapIDToNama(),
                                'options' => [
                                    'prompt' => '-'
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'dropdownAutoWidth' => true,
                                    'placeholder' => " = "
                                ]
                            ],
                            'errorOptions' => ['class' => 'help-block invalid-feedback']
                        ],
                    ],
                ]);
                ?>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <?= Html::submitButton(FAS::icon(FAS::_SAVE) . ' Save', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
