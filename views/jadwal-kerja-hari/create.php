<?php
/* @var $this yii\web\View */
/* @var $model app\models\JadwalKerjaHari */
use yii\helpers\Html;

$this->title = 'Tambah Jadwal Kerja Hari';
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Kerja Hari', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="jadwal-kerja-hari-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
