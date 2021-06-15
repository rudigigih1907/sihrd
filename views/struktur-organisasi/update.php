<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StrukturOrganisasi */

$this->title = 'Update Struktur Organisasi: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Struktur Organisasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="struktur-organisasi-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
