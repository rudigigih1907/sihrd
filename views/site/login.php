<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <!--    <h1>--><?php //echo Html::encode($this->title) ?><!--</h1>-->


    <div class="row">
        <div class="col-md-4 col-sm-12">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
            ]); ?>

            <div class="card shadow">
                <div class="card-header border-bottom">
                    Please fill out the following fields to login:
                </div>

                <div class="card-body">
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox([]) ?>

                </div>

                <div class="card-footer">
                    <div class="d-flex">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary ml-auto', 'name' => 'login-button']) ?>
                    </div>
                </div>

            </div>


            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>
