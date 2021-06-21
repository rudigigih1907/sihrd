<?php



/* @var $this \yii\web\View */
/* @var $model \app\models\form\ImportDataDariMesinAbsensiMenggunakanExcelFile */

use kartik\file\FileInput;
use kartik\widgets\ActiveForm;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Html; ?>
<div class="absensi-form">
    <div class="row">
        <div class="col-md-4 col-sm-12">

            <div class="card">
                <div class="card-header">
                    <?= FAS::icon(FAS::_INFO) ?> (Info) Template Format
                </div>
                <div class="card-body">

                    <ol type="A">
                        <?php foreach ($model->getColumnKey() as $item): ?>
                            <li><?= $item       ?></li>

                        <?php endforeach; ?>
                    </ol>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-sm-12">

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
            <div class="card ">
                <div class="card-header">
                    <?= FAS::icon(FAS::_FILE_EXCEL) ?> Form Upload
                </div>
                <div class="card-body">

                    <?= Html::tag('div' , $form->errorSummary($model) ,[
                        'class' => 'text-danger'
                    ]) ?>

                    <?php
                    echo $form->field($model, 'attach_file')->widget(FileInput::class, [
                        'options' => ['accept' => '.xls, .xlsx , .csv'],
                        'pluginOptions' => [
                            'showPreview' => false,
                            'showCaption' => true,
                            'showRemove' => true,
                            'showUpload' => false
                        ]
                    ]);
                    ?>


                </div>


                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE) . ' Tutup', ['index'], ['class' => 'btn btn-secondary']) ?>
                        <?= Html::submitButton(FAS::icon(FAS::_UPLOAD) . ' Upload', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>