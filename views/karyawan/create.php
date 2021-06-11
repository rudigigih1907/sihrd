<?php
/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */
use yii\helpers\Html;

$this->title = 'Tambah Karyawan';
$this->params['breadcrumbs'][] = ['label' => 'Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="karyawan-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
