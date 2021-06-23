<?php
/* @var $this yii\web\View */
/* @var $model app\models\KehadiranDiInternalSistem */
use yii\helpers\Html;

$this->title = 'Tambah Kehadiran Di Internal Sistem';
$this->params['breadcrumbs'][] = ['label' => 'Kehadiran Di Internal Sistem', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="kehadiran-di-internal-sistem-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
