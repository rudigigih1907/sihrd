<?php

/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */
/* @var $modelsDetail app\models\AlamatKaryawan */

$this->title = 'Update Karyawan: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="karyawan-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetail' => $modelsDetail,
    ]) ?>

</div>
