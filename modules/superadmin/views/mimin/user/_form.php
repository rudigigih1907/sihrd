<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\User */
/* @var $additionalModel app\models\MiminAdditionalModel */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="card shadow">

        <div class="card-body">

            <div class="row">

                <div class="col-sm-12 col-md-4">
                    <?php echo $form->field($additionalModel, 'karyawan')->widget(\kartik\select2\Select2::class,[
                            'data' => \app\models\Karyawan::mapIDToNamaOrderById()
                    ]) ?>
                </div>

                <div class="col-sm-12 col-md-4">
                    <?php echo $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col">
                    <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                </div>
            </div>


            <?php echo $form->field($model, 'status')->radioList([
                10 => 'Active',
                0 => 'Banned'
            ], [

            ]) ?>

            <?php if (!$model->isNewRecord) { ?>
                <p class="text-info"> Leave blank if not change password</p>
                <div class="ui divider"></div>
                <?php echo $form->field($model, 'new_password') ?>
                <?php echo $form->field($model, 'repeat_password') ?>
                <?php echo $form->field($model, 'old_password')->hiddenInput([
                    'value' => $model->auth_key
                ])->label(false) ?>
            <?php } else {
                echo $form->field($additionalModel, 'generate_password', [
                    'inputTemplate' => '<div class="input-group">
                                        <div class="input-group-prepend">
                                             <button class="btn btn-outline-secondary" type="button" onclick="generateRandomString(6)">Generate</button>
                                        </div>
                                        {input}
                                    </div>',
                    'inputOptions' => [
                        'placeholder' => 'Default = 123456',
                    ],
                ]);
            }
            ?>
        </div>

        <div class="card-footer">

            <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', [
                'class' => $model->isNewRecord ? 'btn btn-success' :
                    'btn btn-primary'
            ]) ?>

        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php
$js = <<<JS
function generateRandomString(length) {
    
   let result           = '';
   let characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   let charactersLength = characters.length;
   
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   
   document.getElementById("miminadditionalmodel-generate_password").value = document.getElementById('user-username').value + result;
   
}
JS;

$this->registerJs($js, \yii\web\View::POS_HEAD);
