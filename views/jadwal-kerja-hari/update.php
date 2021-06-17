<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JadwalKerjaHari */

$this->title = 'Update Jadwal Kerja Hari: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Kerja Hari', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jadwal-kerja-hari-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
