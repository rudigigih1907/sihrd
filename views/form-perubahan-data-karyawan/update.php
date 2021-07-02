<?php

/* @var $this yii\web\View */
/* @var $model app\models\FormPerubahanDataKaryawan */
/* @var $modelsDetail app\models\FormPerubahanDataKaryawanDetail */

$this->title = 'Update Form Perubahan Data Karyawan: ' . $model->judul;
$this->params['breadcrumbs'][] = ['label' => 'Form Perubahan Data Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->judul, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="form-perubahan-data-karyawan-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetail' => $modelsDetail,
    ]) ?>

</div>
