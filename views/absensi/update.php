<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Absensi */

$this->title = 'Update Absensi: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Absensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="absensi-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
