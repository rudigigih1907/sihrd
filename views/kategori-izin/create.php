<?php

/* @var $this yii\web\View */
/* @var $model app\models\KategoriIzin */
/* @var $modelsDetail app\models\JenisIzin */

$this->title = 'Tambah Kategori Izin';
$this->params['breadcrumbs'][] = ['label' => 'Kategori Izin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="kategori-izin-create">
    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetail' => $modelsDetail,
    ]) ?>
</div>
