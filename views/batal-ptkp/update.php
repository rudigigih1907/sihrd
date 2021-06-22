<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BatalPtkp */

$this->title = 'Update Batal Ptkp: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Batal Ptkp', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="batal-ptkp-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
