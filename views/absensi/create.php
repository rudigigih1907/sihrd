<?php
/* @var $this yii\web\View */
/* @var $model app\models\Absensi */
use yii\helpers\Html;

$this->title = 'Tambah Absensi';
$this->params['breadcrumbs'][] = ['label' => 'Absensi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="absensi-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
