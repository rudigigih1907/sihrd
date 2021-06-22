<?php
/* @var $this yii\web\View */
/* @var $model app\models\KehadiranDiMesinAbsensi */
use yii\helpers\Html;

$this->title = 'Tambah Manual';
$this->params['breadcrumbs'][] = ['label' => 'Kehadiran Di Mesin Absensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="absensi-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
