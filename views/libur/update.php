<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Libur */

$this->title = 'Update Libur: ' . $model->tanggal;
$this->params['breadcrumbs'][] = ['label' => 'Libur', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tanggal, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="libur-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
