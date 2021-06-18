<?php

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */
/* @var $modelsDetail app\models\AlamatKaryawan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="karyawan-form">


    <div class="card shadow">
        <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
            /*'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]*/
        ]); ?>

        <div class="table-responsive">
            <div class="card-body">

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'nomor_induk_karyawan')->textInput([
                            'maxlength' => true,
                            'autofocus' => 'autofocus'
                        ]) ?>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'nama_panggilan')->textInput(['maxlength' => true]) ?>

                    </div>
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'tanggal_lahir')->widget(\kartik\datecontrol\DateControl::class, ['type' => kartik\datecontrol\DateControl::FORMAT_DATE,]) ?>

                    </div>
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'status_kewarganegaraan')->dropDownList(['WNI' => 'WNI', 'WNA' => 'WNA',]) ?>

                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'nomor_kartu_tanda_penduduk')->textInput(['maxlength' => true]) ?>

                    </div>
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'nomor_kartu_keluarga')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'nomor_pokok_wajib_pajak')->textInput(['maxlength' => true]) ?>

                    </div>
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'nomor_kitas_atau_sejenisnya')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'jenis_kelamin')->dropDownList(['Laki - Laki' => 'Laki - Laki', 'Perempuan' => 'Perempuan',]) ?>

                    </div>
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'agama_id')->dropDownList(\app\models\Agama::mapIDToNama()) ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'status_perkawinan_id')->dropDownList(\app\models\StatusPerkawinan::mapIDToNama()) ?>

                    </div>
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'nama_ayah')->textInput(['maxlength' => true]) ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'nama_ibu')->textInput(['maxlength' => true]) ?>

                    </div>
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'pendidikan_terakhir')->dropDownList(['SD' => 'SD', 'SMP' => 'SMP', 'SMA' => 'SMA', 'S1' => 'S1', 'S2' => 'S2', 'S3' => 'S3',]) ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'jadwal_kerja_id')->dropDownList(\app\models\JadwalKerja::mapIDToNama(),[
                                'prompt' => '-'
                        ]) ?>

                    </div>
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'tanggal_mulai_bekerja')->widget(\kartik\datecontrol\DateControl::class, ['type' => kartik\datecontrol\DateControl::FORMAT_DATE,]) ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-6">

                        <?= $form->field($model, 'tanggal_berhenti_bekerja')->widget(\kartik\datecontrol\DateControl::class, ['type' => kartik\datecontrol\DateControl::FORMAT_DATE,]) ?>

                    </div>
                    <div class="col-sm-12 col-md-6">
                        <?= $form->field($model, 'alasan_berhenti_bekerja')->textInput() ?>
                    </div>
                </div>



                <?php
                DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper',
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 100, // the maximum times, an element can be cloned (default 999)
                    'min' => 1, // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelsDetail[0],
                    'formId' => 'dynamic-form',
                    'formFields' => ['id', 'karyawan_id', 'type', 'atas_nama', 'jalan', 'block', 'nomor', 'rt', 'rw', 'kecamatan', 'kelurahan', 'kabupaten', 'propinsi', 'kode_pos', 'nomor_telepon', 'email', 'keterangan',],
                ]); ?>

                <hr/>

                <h5>Alamat karyawan</h5>

                <table class="card-table table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Attribute</th>
                        <th scope="col" style="width: 2px">Aksi</th>
                    </tr>
                    </thead>

                    <tbody class="container-items">

                    <?php foreach ($modelsDetail as $i => $modelDetail): ?>
                        <tr class="item">
                            <td style="width: 2px;">

                                <?php if (!$modelDetail->isNewRecord) {
                                    echo Html::activeHiddenInput($modelDetail, "[{$i}]id");
                                } ?>

                                <i class="fa fa-adjust"></i>
                            </td>

                            <td>

                                <div class="row">
                                    <div class="col-sm-12 col-md-6">

                                        <?php echo $form->field($modelDetail, "[{$i}]type")->dropDownList(\app\models\AlamatKaryawan::optsType()); ?>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <?php echo $form->field($modelDetail, "[{$i}]atas_nama"); ?>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <?php echo $form->field($modelDetail, "[{$i}]jalan")->textarea([
                                                'rows'=> '4'
                                        ]); ?>

                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-sm-12 col-md-3">
                                        <?php echo $form->field($modelDetail, "[{$i}]block"); ?>

                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <?php echo $form->field($modelDetail, "[{$i}]nomor"); ?>

                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <?php echo $form->field($modelDetail, "[{$i}]rt"); ?>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <?php echo $form->field($modelDetail, "[{$i}]rw"); ?>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-sm-12 col-md-3">
                                        <?php echo $form->field($modelDetail, "[{$i}]kecamatan"); ?>

                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <?php echo $form->field($modelDetail, "[{$i}]kelurahan"); ?>

                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <?php echo $form->field($modelDetail, "[{$i}]kabupaten"); ?>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <?php echo $form->field($modelDetail, "[{$i}]propinsi"); ?>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-sm-12 col-md-3">
                                        <?php echo $form->field($modelDetail, "[{$i}]kode_pos"); ?>

                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <?php echo $form->field($modelDetail, "[{$i}]nomor_telepon"); ?>

                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <?php echo $form->field($modelDetail, "[{$i}]email"); ?>
                                    </div>

                                    <div class="col-sm-12 col-md-3">
                                        <?php echo $form->field($modelDetail, "[{$i}]keterangan"); ?>
                                    </div>
                                </div>

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

                <?php DynamicFormWidget::end(); ?>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['index'], ['class' => 'btn btn-secondary']) ?>
                    <?= Html::submitButton(FAS::icon(FAS::_SAVE) . ' Simpan', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div>
