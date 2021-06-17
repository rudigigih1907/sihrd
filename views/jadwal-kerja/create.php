<?php

/* @var $this yii\web\View */
/* @var $model app\models\JadwalKerja */
/* @var $modelsDetail app\models\JadwalKerjaDetail */

$this->title = 'Tambah Jadwal Kerja';
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Kerja', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="jadwal-kerja-create">
    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetail' => $modelsDetail,
    ]) ?>
</div>
