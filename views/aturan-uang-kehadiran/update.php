<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AturanUangKehadiran */

$this->title = 'Update Aturan Uang Kehadiran: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Aturan Uang Kehadiran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aturan-uang-kehadiran-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
