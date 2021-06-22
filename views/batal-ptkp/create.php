<?php
/* @var $this yii\web\View */
/* @var $model app\models\BatalPtkp */
use yii\helpers\Html;

$this->title = 'Tambah Batal Ptkp';
$this->params['breadcrumbs'][] = ['label' => 'Batal Ptkp', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="batal-ptkp-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
