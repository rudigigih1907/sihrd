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

    <?php $form = ActiveForm::begin([
        'id' => 'dynamic-form',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

    <div class="card shadow">
        <div class="table-responsive">
            <div class="card-body">

                <?= Html::activeHiddenInput($model, 'judul') ?>
                <?= Html::activeHiddenInput($model, 'deskripsi_umum') ?>

                <h5><?= $model->judul ?></h5>
                <?= $model->deskripsi_umum ?>


                <?php DynamicFormWidget::begin([
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
                        <th scope="col">Data Lama</th>
                        <th scope="col">Data Baru</th>
                        <th scope="col">Aksi</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                    </thead>

                    <tbody class="container-items container-items-horizontal">

                    <?php foreach ($modelsDetail as $i => $modelDetail): ?>
                        <tr class="item">
                            <td style="width: 2px;">

                                <?php if (!$modelDetail->isNewRecord) {
                                    echo Html::activeHiddenInput($modelDetail, "[{$i}]id");
                                } ?>

                                <?php
                                echo Html::activeHiddenInput($modelDetail, "[{$i}]nama_data");
                                echo Html::activeHiddenInput($modelDetail, "[{$i}]nilai_lama");
                                echo Html::activeHiddenInput($modelDetail, "[{$i}]nilai_baru");
                                echo Html::activeHiddenInput($modelDetail, "[{$i}]aksi");
                                echo Html::activeHiddenInput($modelDetail, "[{$i}]keterangan");
                                ?>

                                <i class="fa fa-adjust"></i>
                            </td>

                            <td><?= $modelDetail->nama_data ?></td>
                            <td><?= $modelDetail->nilai_lama ?></td>
                            <td><?= $modelDetail->aksi ?></td>
                            <td><?= $modelDetail->nilai_baru ?></td>
                            <td><?= $modelDetail->keterangan ?></td>

                        </tr>

                    <?php endforeach; ?>
                    </tbody>


                </table>

                <?php DynamicFormWidget::end(); ?>

            </div>
        </div>
    </div>

    <div class="card mt-4 shadow">
        <div class="table-responsive">
            <div class="card-body">
                <h5><?= FAS::icon(FAS::_USER_ASTRONAUT) ?> Aksi HRD / Staff</h5>
                <?= $form->field($model, 'status')->dropDownList(\app\models\FormPerubahanDataKaryawan::optsStatus()) ?>
                <?= $form->field($model, 'aksi_yang_dilakukan')->textarea(['rows' => 6]) ?>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['index'], ['class' => 'btn btn-secondary']) ?>
                    <?= Html::submitButton(FAS::icon(FAS::_SAVE) . ' Simpan', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
