<?php
/* @var $this yii\web\View */
/* @var $model app\models\Karyawan */
use yii\helpers\Html;

$this->title = 'Create Karyawan';
$this->params['breadcrumbs'][] = ['label' => 'Karyawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="karyawan-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
