<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Card */

$this->title = 'Update Card: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
