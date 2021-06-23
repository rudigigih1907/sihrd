<?php

/* @var $this yii\web\View */
/* @var $model app\models\KategoriIzin */
/* @var $modelsDetail app\models\JenisIzin */

$this->title = 'Update Kategori Izin: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Kategori Izin', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kategori-izin-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetail' => $modelsDetail,
    ]) ?>

</div>
