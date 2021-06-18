<?php

use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JadwalKerja */
/* @var $modelsDetail app\models\JadwalKerjaDetail */
/* @var $modelsDetailDetail app\models\JadwalKerjaDetailDetail */
/* @var $form kartik\form\ActiveForm */

$template = ['template' => '{input}{error}'];
?>

<div class="jadwal-kerja-form">

    <div class="card shadow">

        <?php $form = ActiveForm::begin([
            'id' => 'dynamic-form',
            /*'type' => ActiveForm::TYPE_HORIZONTAL,
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]*/
        ]); ?>
        <div class="table-responsive">
            <div class="card-body">

                <div class="row">
                    <div class="col col-sm-6">
                        <?= $form->field($model, 'nama')->textInput([
                            'maxlength' => true,
                            'autofocus' => 'autofocus'
                        ]) ?>
                    </div>
                    <div class="col col-sm-6">
                        <?php echo $form->field($model, 'kode')->textInput(['maxlength' => true]); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-sm-6">
                        <?php echo $form->field($model, 'mulai_tanggal')->widget(\kartik\datecontrol\DateControl::class, ['type' => kartik\datecontrol\DateControl::FORMAT_DATE,]); ?>

                    </div>
                    <div class="col col-sm-6">
                        <?php echo $form->field($model, 'status')->dropDownList(['Aktif' => 'Aktif', 'Tidak Aktif' => 'Tidak Aktif',]); ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col col-sm-6">
                        <?php echo $form->field($model, 'keterangan')->textarea(['rows' => 3]); ?>

                    </div>
                    <div class="col col-sm-6">

                    </div>
                </div>




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
                    'formFields' => ['id', 'jadwal_kerja_id', 'jadwal_kerja_hari_id', 'libur',],
                ]); ?>
                <hr/>
                <h5>Jadwal Kerja Details </h5>

                <table class="card-table table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Libur ?</th>
                        <th scope="col">Jam Kerja</th>
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

                            <td>
                                <?php echo $form->field($modelDetail, "[{$i}]jadwal_kerja_hari_id", $template)
                                    ->dropDownList(\app\models\JadwalKerjaHari::mapIDToNamaOrderById())

                                ; ?>
                            </td>

                            <td>
                                <?php echo $form->field($modelDetail, "[{$i}]libur", $template)
                                    ->dropDownList(array_reverse(\app\models\JadwalKerjaDetail::optsLibur()))
                                ; ?>
                            </td>
                            <td class="p-0">
                                <?php echo $this->render('_form-detail-detail', [
                                    'form' => $form,
                                    'i' => $i,
                                    'modelsDetailDetail' => $modelsDetailDetail[$i],
                                    'template' => $template
                                ]) ?>
                            </td>

                            <td>
                                <button type="button" class="remove-item btn btn-danger btn-sm"><i
                                            class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="5">
                            <?php echo Html::button('<span class="fa fa-plus"></span> Tambah Hari', [
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
                    <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['index', 'page' => Yii::$app->request->getQueryParam('page', null)], ['class' => 'btn btn-secondary']) ?>
                    <?= Html::submitButton(FAS::icon(FAS::_SAVE) . ' Simpan', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
