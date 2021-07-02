<?php

use app\models\form\ChangePassword;
use rmrevin\yii\fontawesome\FAS;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model ChangePassword */

$this->title = "Ganti Password";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-change-password">

    <div class="row">
        <div class="col-md-4 col-sm-12">
            <?php $form = ActiveForm::begin(); ?>

            <div class="card shadow">

                <div class="card-header border-bottom">
                    <?= FAS::icon(FAS::_POLL) ?> Silahkan isi form berikut.
                </div>

                <div class="card-body">
                    <?= $form->field($model, 'new_password')->passwordInput() ?>
                    <?= $form->field($model, 'repeat_password')->passwordInput() ?>
                </div>

                <div class="card-footer">
                    <div class="d-flex">
                        <?= Html::submitButton('Ganti', [
                            'class' => 'btn btn-primary ml-auto',
                        ]) ?>
                    </div>
                </div>

            </div>

            <div class="mt-3">
                <p class="text-muted mt-4 text-justify">
                    Setelah Anda berhasil mengganti Password, Anda Akan otomatis logout.<br/>
                    Pastikan anda mengingat password Anda yang baru.
                </p>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
