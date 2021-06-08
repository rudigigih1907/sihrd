<?php

use kartik\widgets\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \app\models\User */
/* @var $authAssignment \hscstudio\mimin\models\AuthAssignment */
/* @var $authItems [ \hscstudio\mimin\models\AuthItem ] */

$this->title = $model->id . '. ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col">
            <?php $form = ActiveForm::begin([]); ?>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Assign Role</h4>
                </div>
                <div class="card-body">
                    <?php echo $form->errorSummary($model) ?>
                    <?php
                    echo $form->field($authAssignment, 'item_name')->widget(Select2::classname(), [
                        'data' => $authItems,
                        'options' => [
                            'placeholder' => 'Select role ...',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'multiple' => true,
                        ],
                    ])->label('Role');
                    ?>
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <?= Html::submitButton('Update Role', [
                            'class' => $authAssignment->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                            //'data-confirm'=>"Apakah anda yakin akan menyimpan data ini?",
                        ]) ?>
                    </div>

                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-8">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data User</h4>
                </div>
                <?php try {
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'username',
                            'auth_key',
                            'password_hash',
                            'password_reset_token',
                            'email:email',
                            'status',
                            'created_at',
                            'updated_at',
                        ],
                    ]);
                } catch (Exception $e) {
                    echo $e->getMessage();
                } ?>

                <div class="card-footer">

                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger float-right',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>

                </div>
            </div>


        </div>

    </div>


</div>
