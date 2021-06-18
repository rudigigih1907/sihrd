<?php

/* @var $this yii\web\View */
/* @var $model app\models\JadwalKerja */
/* @var $toBeCloneModel app\models\JadwalKerja */
/* @var $modelsDetail app\models\JadwalKerjaDetail */
/* @var $modelsDetailDetail app\models\JadwalKerjaDetailDetail */

$this->title = 'Clone Jadwal Kerja: ' . $toBeCloneModel->nama;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Kerja', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $toBeCloneModel->nama, 'url' => ['view', 'id' => $toBeCloneModel->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jadwal-kerja-clone">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetail' => $modelsDetail,
        'modelsDetailDetail' => $modelsDetailDetail,
    ]) ?>

</div>
