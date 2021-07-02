<?php

/* @var $this yii\web\View */
/* @var $model app\models\FormPerubahanDataKaryawan */
/* @var $modelsDetail app\models\FormPerubahanDataKaryawanDetail */

$this->title = 'Tambah Form Perubahan Data Karyawan';
$this->params['breadcrumbs'][] = ['label' => 'Form Perubahan Data Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="form-perubahan-data-karyawan-create">
    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetail' => $modelsDetail,
    ]) ?>
</div>
