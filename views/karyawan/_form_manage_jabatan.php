<?php


/* @var $this View */

use app\models\Karyawan;
use app\models\KaryawanStrukturOrganisasi;
use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;
use wbraganca\dynamicform\DynamicFormWidget;
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
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]);
        ?>

        <div class="table-responsive">
            <?php
            DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper',
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 100, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $models[0],
                'formId' => 'tabular-form',
                'formFields' => ['id', 'karyawan_id', 'jenis_jabatan', 'struktur_organisasi_id', 'nomor_surat_pengangkatan', 'tanggal_aktif', 'tanggal_berakhir', 'alasan_berakhir'],
            ]); ?>
            <div class="card-body">
                <table class="card-table table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Attribute</th>
                        <th scope="col" style="width: 2px">Aksi</th>
                    </tr>
                    </thead>

                    <tbody class="container-items ">

                    <?php foreach ($models as $i => $modelDetail): ?>
                        <tr class="item">
                            <td style="width: 2px;">

                                <?php if (!$modelDetail->isNewRecord) {
                                    echo Html::activeHiddenInput($modelDetail, "[{$i}]id");
                                } ?>

                                <i class="fa fa-adjust"></i>
                            </td>

                            <td>
                                <?php echo $form->field($modelDetail, "[{$i}]jenis_jabatan")->widget(\kartik\select2\Select2::class, [
                                    'data' => KaryawanStrukturOrganisasi::optsJenisJabatan(),
                                    'pluginOptions' => [
                                        'dropdownAutoWidth' => true,
                                    ]
                                ]); ?>
                                <?php echo $form->field($modelDetail, "[{$i}]struktur_organisasi_id")->widget(\kartik\select2\Select2::class, [
                                    'data' => app\models\StrukturOrganisasi::mapIDToNamaKhususJabatanSaja(),
                                    'options' => [
                                        'style' => [
                                            'width' => '120px'
                                        ]
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        //'dropdownAutoWidth' => true,
                                        'placeholder' => "= Pilih Jabatan =",
                                    ]
                                ]); ?>
                                <?php echo $form->field($modelDetail, "[{$i}]nomor_surat_pengangkatan"); ?>
                                <?php echo $form->field($modelDetail, "[{$i}]tanggal_aktif")->widget(\kartik\datecontrol\DateControl::class,[
                                        'type' => \kartik\datecontrol\DateControl::FORMAT_DATE
                                ]) ?>
                                <?php echo $form->field($modelDetail, "[{$i}]tanggal_berakhir")->widget(\kartik\datecontrol\DateControl::class,[
                                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATE
                                ]) ?>
                                <?php echo $form->field($modelDetail, "[{$i}]alasan_berakhir"); ?>

                            </td>


                            <td>
                                <button type="button" class="remove-item btn btn-danger btn-xs">
                                    <i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="3">
                            <?php echo Html::button('<span class="fa fa-plus"></span> Tambah', [
                                'class' => 'add-item btn btn-success float-right',
                            ]); ?>

                            <div class="clearfix"></div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <?php DynamicFormWidget::end(); ?>

            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <?= Html::submitButton(FAS::icon(FAS::_SAVE) . ' Save', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
