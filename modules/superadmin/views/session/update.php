<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Session */

$this->title = 'Update Session: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Session', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="session-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
