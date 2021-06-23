<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model app\models\KategoriIzin */
/* @var $modelsDetail app\models\JenisIzin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kategori-izin-form">


    <div class="card shadow">
        <?php $form = ActiveForm::begin([
        'id' => 'dynamic-form',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
        ]); ?>

        <div class="table-responsive">
            <div class="card-body">
                    <?= $form->field($model, 'nama')->textInput([
                    'maxlength' => true,
                    'autofocus'=> 'autofocus'
                ]) ?>

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
                    'formFields' => [ 'id',  'kategori_izin_id',  'nama', ],
                ]); ?>

                <hr/>

                <h5>Jenis izin</h5>

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

                                                             <?php echo $form->field($modelDetail, "[{$i}]nama"); ?>
                                                    </td>

                        <td>
                            <button type="button" class="remove-item btn btn-danger btn-xs">
                                <i class="fas fa-trash-alt"></i>                            </button>
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
                    <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE). ' Tutup', ['index'], ['class' => 'btn btn-secondary']) ?>
                    <?= Html::submitButton( FAS::icon(FAS::_SAVE). ' Simpan', ['class' =>'btn btn-primary' ]) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end();  ?>     </div>

</div>
