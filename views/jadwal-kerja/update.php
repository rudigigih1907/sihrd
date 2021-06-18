<?php

/* @var $this yii\web\View */
/* @var $model app\models\JadwalKerja */
/* @var $modelsDetail app\models\JadwalKerjaDetail */
/* @var $modelsDetailDetail app\models\JadwalKerjaDetailDetail */

$this->title = 'Update Jadwal Kerja: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Kerja', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jadwal-kerja-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetail' => $modelsDetail,
        'modelsDetailDetail' => $modelsDetailDetail,
    ]) ?>

</div>
