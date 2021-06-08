<?php
/* @var $this yii\web\View */
/* @var $model app\models\Card */
use yii\helpers\Html;
?>

<div class="card-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
