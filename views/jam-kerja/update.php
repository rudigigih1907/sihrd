<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JamKerja */

$this->title = 'Update Jam Kerja: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Jam Kerja', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jam-kerja-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
