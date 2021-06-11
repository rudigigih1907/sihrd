<?php
/* @var $this yii\web\View */
/* @var $model app\models\StatusPerkawinan */
use yii\helpers\Html;

$this->title = 'Create Status Perkawinan';
$this->params['breadcrumbs'][] = ['label' => 'Status Perkawinans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="status-perkawinan-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
