<?php

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FormPerubahanDataKaryawan */
/* @var $modelsDetail app\models\FormPerubahanDataKaryawanDetail */
/* @var $form yii\widgets\ActiveForm */
$template = ['template' => '{input}{error}'];
?>

<div class="form-perubahan-data-karyawan-form">


    <div class="card shadow">
        <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]); ?>

        <div class="table-responsive">
            <div class="card-body">
                <?= $form->field($model, 'judul')->textInput([
                    'maxlength' => true,
                    'autofocus' => 'autofocus'
                ]) ?>
                <?= $form->field($model, 'deskripsi_umum')->textarea(['rows' => 6]) ?>

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
                    'formFields' => ['id', 'form_perubahan_data_karyawan_id', 'nama_data', 'nilai_lama', 'nilai_baru', 'aksi', 'keterangan',],
                ]); ?>

                <hr/>

                <h5>Detail Perubahan</h5>

                <table class="card-table table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Data</th>
                        <th scope="col">Nilai Lama</th>
                        <th scope="col">Nilai Baru</th>
                        <th scope="col">Aksi</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col" style="width: 2px">Aksi</th>
                    </tr>
                    </thead>

                    <tbody class="container-items container-items-horizontal">

                    <?php foreach ($modelsDetail as $i => $modelDetail): ?>
                        <tr class="item">
                            <td style="width: 2px;">

                                <?php if (!$modelDetail->isNewRecord) {
                                    echo Html::activeHiddenInput($modelDetail, "[{$i}]id");
                                } ?>

                                <i class="fa fa-adjust"></i>
                            </td>

                            <td><?php echo $form->field($modelDetail, "[{$i}]nama_data", $template); ?></td>
                            <td><?php echo $form->field($modelDetail, "[{$i}]nilai_lama", $template); ?></td>
                            <td><?php echo $form->field($modelDetail, "[{$i}]nilai_baru", $template); ?></td>
                            <td><?php echo $form->field($modelDetail, "[{$i}]aksi", $template)
                                    ->dropDownList(\app\models\FormPerubahanDataKaryawanDetail::optsAksi()); ?>
                            </td>
                            <td><?php echo $form->field($modelDetail, "[{$i}]keterangan", $template); ?></td>
                            <td>
                                <button type="button" class="remove-item btn btn-danger btn-xs">
                                    <i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="7">

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
        <?php ActiveForm::end(); ?>     </div>

</div>
