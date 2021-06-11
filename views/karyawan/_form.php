<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;
use rmrevin\yii\fontawesome\FAS;

/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */
/* @var $form kartik\form\ActiveForm */
?>

<div class="karyawan-form">

    <div class="card shadow">

    <?php $form = ActiveForm::begin([
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

        <div class="card-body">
                <?= $form->field($model, 'nomor_induk_karyawan')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nama_panggilan')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tempat_lahir')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tanggal_lahir')->widget(\kartik\datecontrol\DateControl::class,[ 'type'=>kartik\datecontrol\DateControl::FORMAT_DATE, ]) ?>
    <?= $form->field($model, 'status_kewarganegaraan')->dropDownList([ 'WNI' => 'WNI', 'WNA' => 'WNA', ], ['prompt' => '']) ?>
    <?= $form->field($model, 'nomor_kartu_tanda_penduduk')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nomor_kartu_keluarga')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nomor_pokok_wajib_pajak')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nomor_kitas_atau_sejenisnya')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'jenis_kelamin')->dropDownList([ 'Laki - Laki' => 'Laki - Laki', 'Perempuan' => 'Perempuan', ], ['prompt' => '']) ?>
    <?= $form->field($model, 'agama_id')->textInput() ?>
    <?= $form->field($model, 'status_perkawinan_id')->textInput() ?>
    <?= $form->field($model, 'nama_ayah')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nama_ibu')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'pendidikan_terakhir')->dropDownList([ 'SD' => 'SD', 'SMP' => 'SMP', 'SMA' => 'SMA', 'S1' => 'S1', 'S2' => 'S2', 'S3' => 'S3', ], ['prompt' => '']) ?>
    <?= $form->field($model, 'tanggal_mulai_bekerja')->widget(\kartik\datecontrol\DateControl::class,[ 'type'=>kartik\datecontrol\DateControl::FORMAT_DATE, ]) ?>
    <?= $form->field($model, 'tanggal_berhenti_bekerja')->widget(\kartik\datecontrol\DateControl::class,[ 'type'=>kartik\datecontrol\DateControl::FORMAT_DATE, ]) ?>
    <?= $form->field($model, 'alasan_berhenti_bekerja')->textInput() ?>
        </div>

        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <?= Html::a(FAS::icon(FAS::_WINDOW_CLOSE). ' Close', ['index'], ['class' => 'btn btn-secondary']) ?>
                <?= Html::submitButton( FAS::icon(FAS::_SAVE). ' Save', ['class' =>'btn btn-primary' ]) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    </div>

</div>
