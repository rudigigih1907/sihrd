<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KehadiranDiMesinAbsensi */

$this->title = 'Update Kehadiran: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'KehadiranDiMesinAbsensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="absensi-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
