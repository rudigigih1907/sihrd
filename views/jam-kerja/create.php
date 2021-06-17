<?php
/* @var $this yii\web\View */
/* @var $model app\models\JamKerja */
use yii\helpers\Html;

$this->title = 'Tambah Jam Kerja';
$this->params['breadcrumbs'][] = ['label' => 'Jam Kerja', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="jam-kerja-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
