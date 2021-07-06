<?php
/* @var $this yii\web\View */
/* @var $model app\models\AturanUangKehadiran */
use yii\helpers\Html;

$this->title = 'Tambah Aturan Uang Kehadiran';
$this->params['breadcrumbs'][] = ['label' => 'Aturan Uang Kehadiran', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="aturan-uang-kehadiran-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
