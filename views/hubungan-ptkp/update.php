<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HubunganPtkp */

$this->title = 'Update Hubungan Ptkp: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Hubungan Ptkp', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hubungan-ptkp-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
