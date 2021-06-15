<?php

/* @var $this yii\web\View */
/* @var $model app\models\StrukturOrganisasi */
/* @var $parent app\models\StrukturOrganisasi */

$this->title = 'Tambah Child untuk : ' . $parent->nama;
$this->params['breadcrumbs'][] = ['label' => 'Struktur Organisasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="struktur-organisasi-create">
    <?= $this->render('_form_child_from_diagram', [
        'model' => $model,
    ]) ?>
</div>
