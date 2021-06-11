<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StatusPerkawinan */

$this->title = 'Update Status Perkawinan: ' . $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Status Perkawinan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="status-perkawinan-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
