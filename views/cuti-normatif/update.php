<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CutiNormatif */

$this->title = 'Update Cuti Normatif: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Cuti Normatif', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cuti-normatif-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
