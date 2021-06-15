<?php
/* @var $this yii\web\View */
/* @var $model app\models\StrukturOrganisasi */
use yii\helpers\Html;

$this->title = 'Tambah Struktur Organisasi';
$this->params['breadcrumbs'][] = ['label' => 'Struktur Organisasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="struktur-organisasi-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
