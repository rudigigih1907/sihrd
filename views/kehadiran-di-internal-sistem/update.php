<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KehadiranDiInternalSistem */

$this->title = 'Update Kehadiran Di Internal Sistem: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kehadiran Di Internal Sistem', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kehadiran-di-internal-sistem-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
