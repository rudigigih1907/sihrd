<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Agama */

$this->title = 'Update Agama: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Agama', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agama-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
