<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StatusPerkawinan */

$this->title = 'Update Status Perkawinan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Status Perkawinans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="status-perkawinan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
