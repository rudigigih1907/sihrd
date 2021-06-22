<?php
/* @var $this yii\web\View */
/* @var $model app\models\HubunganPtkp */
use yii\helpers\Html;

$this->title = 'Tambah Hubungan Ptkp';
$this->params['breadcrumbs'][] = ['label' => 'Hubungan Ptkp', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="hubungan-ptkp-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
