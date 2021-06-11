<?php
/* @var $this yii\web\View */
/* @var $model app\models\StatusPerkawinan */
use yii\helpers\Html;

$this->title = 'Tambah Status Perkawinan';
$this->params['breadcrumbs'][] = ['label' => 'Status Perkawinan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="status-perkawinan-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
