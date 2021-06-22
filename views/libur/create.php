<?php
/* @var $this yii\web\View */
/* @var $model app\models\Libur */
use yii\helpers\Html;

$this->title = 'Tambah Libur';
$this->params['breadcrumbs'][] = ['label' => 'Libur', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="libur-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
